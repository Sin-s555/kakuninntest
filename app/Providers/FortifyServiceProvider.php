<?php

namespace App\Providers;

use Laravel\Fortify\Fortify;
use Illuminate\Support\ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Redirect;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Log;

class FortifyServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // ユーザー登録・プロフィール・パスワード関連のFortifyアクション
        Fortify::createUsersUsing(\App\Actions\Fortify\CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(\App\Actions\Fortify\UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(\App\Actions\Fortify\UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(\App\Actions\Fortify\ResetUserPassword::class);

        // ログインビューの指定
        Fortify::loginView(function () {
            return view('auth.login');
        });

        // ユーザー登録ビューの指定
        Fortify::registerView(function () {
            return view('auth.register');
        });

        // 認証処理のカスタマイズ（バリデーション追加）
        Fortify::authenticateUsing(function (Request $request) {
            $request->validate(
                [
                    'email' => ['required', 'email:rfc'],
                    'password' => ['required'],
                ],
                [
                    'email.required' => 'メールアドレスを入力してください',
                    'email.email' => 'メールアドレスは「ユーザー名@ドメイン」形式で入力してください',
                    'password.required' => 'パスワードを入力してください',
                ]
            );

            $credentials = $request->only('email', 'password');

           

            if (Auth::attempt($credentials, $request->filled('remember'))) {
                Log::info('ログイン成功');
                $request->session()->regenerate();
                return redirect()->intended(RouteServiceProvider::HOME);
            } else {
                Log::warning('ログイン失敗', $credentials);
            }

    throw ValidationException::withMessages([
        'email' => [trans('auth.failed')],
    ]);
});

        
    }
}
