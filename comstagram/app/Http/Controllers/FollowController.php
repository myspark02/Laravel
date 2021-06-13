<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class FollowController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }
    public function store(User $user)
    {
        // dd($user);
        return auth()->user()->following()->toggle($user->profile);
    }
}
