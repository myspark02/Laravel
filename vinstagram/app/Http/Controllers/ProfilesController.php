<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class ProfilesController extends Controller
{
    public function index($name)
    {

        $user = User::where('name', $name)->first();

        if ($user)
            return Inertia::render('Dashboard', [
                'user' => Auth::user(),
                'posts' => $user->posts,
                'can' => ['create_update' => Auth::user()->id == $user->id],
                'viewed_user' => $user,
            ]);
        else
            return Inertia::render('Notfound');
    }

    public function update(Request $request)
    {


        $data = $request->validate(['title' => 'required', 'description' => 'required',]);

        Auth::user()->profile->update($data);

        // dd($request->all());

        return Inertia::render(
            'Dashboard',
            [
                'user' => fn () => Auth::user(),
                'posts' => fn () => Auth::user()->posts,
                'can' => ['create_update' => true],
                'viewed_user' => Auth::user(),
            ]
        );
    }
}
