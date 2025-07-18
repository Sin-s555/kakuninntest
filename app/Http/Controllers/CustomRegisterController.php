<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterUserRequest;
use App\Actions\Fortify\CreateNewUser;
use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\Contracts\RegisterResponse;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function store(RegisterUserRequest $request, CreateNewUser $creator, RegisterResponse $response)
    {
        $user = $creator->create($request->validated());

        Auth::login($user);

        return $response;
    }
}
