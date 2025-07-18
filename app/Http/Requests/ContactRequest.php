<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'last_name' => 'required|string|max:255',
            'first_name' => 'required|string|max:255',
            'gender' => 'required|in:男性,女性',
            'email' => 'required|email|max:255',
            'tel1' => 'required|digits:3',
            'tel2' => 'required|digits:4',
            'tel3' => 'required|digits:4',
            'address' => 'nullable|string|max:255',
            'building' => 'nullable|string|max:255',
            'category' => 'required|string|max:255',
            'content' => 'required|string|max:1000',
        ];
    }

    public function messages(): array
    {
        return [
            'last_name.required'  => '姓を入力してください',
            'first_name.required' => '名を入力してください',
            'gender.required'     => '性別を選択してください',
            'gender.in'           => '性別は「男性」または「女性」を選択してください',

            'email.required'      => 'メールアドレスを入力してください',
            'email.email'         => 'メールアドレスの形式で入力してください',
            'email.max'           => 'メールアドレスは255文字以内で入力してください',

            'tel1.required'       => '電話番号（市外局番）を入力してください',
            'tel1.digits'         => '電話番号（市外局番）は3桁で入力してください',

            'tel2.required'       => '電話番号（市内局番）を入力してください',
            'tel2.digits'         => '電話番号（市内局番）は4桁で入力してください',

            'tel3.required'       => '電話番号（加入者番号）を入力してください',
            'tel3.digits'         => '電話番号（加入者番号）は4桁で入力してください',

            'category.required'   => 'お問い合わせの種類を選択してください',

            'content.required'    => 'お問い合わせ内容を入力してください',
            'content.max'         => 'お問い合わせ内容は1000文字以内で入力してください',
        ];
    }
}
