<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class ProfilesController extends Controller
{
    public function index($name) {

        $user = User::where('name', $name)->first();

        if ($user)
            return Inertia::render('Dashboard', ['user' => $user]);
        else
            return Inertia::render('Notfound');
    }
}
