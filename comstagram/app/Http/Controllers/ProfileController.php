<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function show(User $user)
    {
        dd($user);
        return view('profile.show', ['user' => $user]);
    }
}
