<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ContactRequest;
use App\Models\Contact;

class ContactController extends Controller
{
    public function form()
    {
        return view('contact.form');
    }

    public function confirm(ContactRequest $request)
    {
        $inputs = $request->all();
        return view('contact.confirm', compact('inputs'));
    }

    public function send(Request $request)
    {
        $action = $request->input('action');

        if ($action === 'back') {
            return redirect()->route('contact.form')->withInput();
        }

        Contact::create([
            'last_name' => $request->input('last_name'),
            'first_name' => $request->input('first_name'),
            'gender' => $request->input('gender'),
            'email' => $request->input('email'),
            'tel' => $request->input('tel1') . $request->input('tel2') . $request->input('tel3'),
            'address' => $request->input('address'),
            'building' => $request->input('building'),
            'category' => $request->input('category'),
            'content' => $request->input('content'),
        ]);

        return redirect()->route('contact.thanks');
    }
}
