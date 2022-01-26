<?php

namespace App\Http\Controllers;

use App\Mail\User\AfterRegister;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
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
        $callback = Socialite::driver('google')->user();

        $data = [
            'name'  => $callback->name,
            'email' => $callback->email,
            'avatar' => $callback->avatar,
            'email_verified_at' => date('Y-m-d H:i:s'),
            'created_at' => date('Y-m-d H:i:s')
        ];
        // $user = User::firstOrCreate(['email' => $data['email']], $data); //kalo ada data akan di update kalo tidak ada akan membuat baru
        $user = User::whereEmail($data['email'])->first();
        if ($user == null) {
            $user = User::create($data);
            Mail::to($user->email)->send(new AfterRegister($user));
        }
        Auth::login($user, true);
        return redirect(route('home'));
    }
}
