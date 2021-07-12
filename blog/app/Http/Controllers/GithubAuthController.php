<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;

class GithubAuthController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('github')->redirect();
    }

    public function callback()
    {
        $user = Socialite::driver('github')->user();

        $user = User::firstOrCreate(
            [
                'email' => $user->email
            ],
            [
                'name' => $user->name,
                'password' => Hash::make(Str::random(24)),
            ]
        );

        Auth::login($user);

        return redirect()->intended('/dashboard');
    }
}
