<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterUserRequest;
use App\Actions\Fortify\CreateNewUser;

class RegisterController extends Controller
{
    // 登録フォーム表示
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    // 登録処理
    public function store(RegisterUserRequest $request, CreateNewUser $creator)
    {
        // バリデーション済みデータを使用してユーザーを作成
        $user = $creator->create($request->validated());

        // 成功メッセージをセッションに保存
        return redirect()->back()->with('success', '登録が完了しました');
    }
}
