<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

    public function index() {
        $user = User::findOrFail(auth()->user()->id);
        $posts = $user->posts;
        return view('dashboard')->with('posts', $posts);
    }
}
