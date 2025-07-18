<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\StreamedResponse;

class AdminController extends Controller
{
    public function index(Request $request)
{  
    
    
    $query = Contact::query();

    // 名前やメールでのキーワード検索
    if ($request->filled('keyword')) {
    $keyword = trim($request->keyword);

    $query->where(function ($q) use ($keyword) {
        $q->where('first_name', 'like', "%{$keyword}%")
          ->orWhere('last_name', 'like', "%{$keyword}%")
          ->orWhereRaw("REPLACE(CONCAT(last_name, ' ', first_name), ' ', '') LIKE ?", [ '%' . str_replace(' ', '', $keyword) . '%' ])
          ->orWhere('email', 'like', "%{$keyword}%");
    });
    }

    // 性別フィルター（'all' または '' はスキップ）
    $gender = $request->input('gender');

    if (in_array($gender, ['男性', '女性', 'その他'])) {
    $genderMap = ['男性' => 1, '女性' => 2, 'その他' => 3];
    $query->where('gender', $genderMap[$gender]);
    }

    // お問い合わせ種類
    if ($request->filled('contact_type')) {
        $query->where('contact_type', $request->contact_type);
    }

    // 日付検索
    if ($request->filled('date')) {
        $query->whereDate('created_at', $request->date);
    }

    // 結果取得
    $contacts = $query->orderBy('created_at', 'desc')->paginate(7);

    return view('admin.dashboard', compact('contacts'));
   
    }

    public function create()
    {
        return view('admin.register');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'is_admin' => true,
        ]);

        return redirect()->route('admin.dashboard')
                         ->with('success', 'ユーザー登録に成功しました');
    }

    public function show($id)
    {
        $contact = Contact::findOrFail($id);

    return response()->json([
        'last_name' => $contact->last_name,
        'first_name' => $contact->first_name,
        'gender' => $contact->gender,
        'email' => $contact->email,
        'contact_type' => $contact->contact_type,
        'created_at' => $contact->created_at->format('Y-m-d'),
    ]);
}

// Contactを削除する
    public function destroy($id)
    {
    $contact = Contact::findOrFail($id);
    $contact->delete();

    return response()->json(['message' => '削除しました'], 200);
    }

    public function export(Request $request): StreamedResponse
{
    $query = Contact::query();

    // フィルター処理（検索条件と同じものを再利用）
    if ($request->filled('keyword')) {
        $query->where(function ($q) use ($request) {
            $q->where('first_name', 'like', "%{$request->keyword}%")
              ->orWhere('last_name', 'like', "%{$request->keyword}%")
              ->orWhere('email', 'like', "%{$request->keyword}%");
        });
    }

    if ($request->filled('gender') && $request->gender !== 'all') {
        $genderMap = ['男性' => 1, '女性' => 2, 'その他' => 3];
        if (isset($genderMap[$request->gender])) {
            $query->where('gender', $genderMap[$request->gender]);
        }
    }

    if ($request->filled('contact_type')) {
        $query->where('contact_type', $request->contact_type);
    }

    if ($request->filled('date')) {
        $query->whereDate('created_at', $request->date);
    }

    $contacts = $query->get();

    $response = new StreamedResponse(function () use ($contacts) {
        $handle = fopen('php://output', 'w');

        // ヘッダー行
        fputcsv($handle, ['名前', '性別', 'メールアドレス', 'お問い合わせの種類', '日付']);

        foreach ($contacts as $contact) {
            $genderMap = [1 => '男性', 2 => '女性', 3 => 'その他'];
            fputcsv($handle, [
                $contact->last_name . ' ' . $contact->first_name,
                $genderMap[$contact->gender] ?? '不明',
                $contact->email,
                $contact->contact_type,
                $contact->created_at->format('Y-m-d'),
            ]);
        }

        fclose($handle);
    });

    $filename = 'contacts_' . now()->format('Ymd_His') . '.csv';

    $response->headers->set('Content-Type', 'text/csv');
    $response->headers->set('Content-Disposition', "attachment; filename={$filename}");

    return $response;
}
    
}
