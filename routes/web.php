<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ContactController;

// トップページ → ログインにリダイレクト
Route::get('/', function () {
    return redirect()->route('login');
});

// 登録ページ
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register.form');
Route::post('/register', [RegisterController::class, 'store'])->name('register');

// ログイン
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

// ログアウト
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// 管理画面（認証保護）
Route::middleware(['auth'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

    // 管理者ユーザー登録
    Route::get('/admin/register', [AdminController::class, 'create'])->name('admin.user.create');
    Route::post('/admin/register', [AdminController::class, 'store'])->name('admin.user.store');

    // 問い合わせ詳細・削除
    Route::get('/admin/contact/{id}', [AdminController::class, 'show'])->name('admin.contact.show');
    Route::delete('/admin/contact/{id}', [AdminController::class, 'destroy'])->name('admin.contact.destroy');

    // 管理画面のルート補完
    Route::get('/admin', function () {
        return redirect()->route('admin.dashboard');
    });

    // CSVエクスポート
    Route::get('/admin/export', [AdminController::class, 'export'])->name('admin.export');
});

// === お問い合わせ関連 ===

// 入力フォーム（GET） ※ `/contact` に統一
Route::get('/contact', [ContactController::class, 'form'])->name('contact.form');

// 確認画面（POST）
Route::post('/contact/confirm', [ContactController::class, 'confirm'])->name('contact.confirm');

// 送信処理（POST）
Route::post('/contact/send', [ContactController::class, 'send'])->name('contact.send');

// 送信完了画面（GET）
Route::view('/contact/thanks', 'contact.thanks')->name('contact.thanks');

