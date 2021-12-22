<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class UserController extends Controller
{
    public function login()
    {
        return view('auth.login-oauth');
    }

    public function google()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        $callback = Socialite::driver('google')->stateless()->user();

        $data = [
            'name'  => $callback->name,
            'email' => $callback->email,
            'avatar' => $callback->avatar,
            'email_verified_at' => date('Y-m-d H:i:s'),
            'created_at' => date('Y-m-d H:i:s')
        ];
        $user = User::firstOrCreate(['email' => $data['email']], $data);

        Auth::login($user, true);
        return redirect(route('home'));
    }
}
