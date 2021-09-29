<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class FollowsController extends Controller
{
    public function store(User $user)
    {
        auth()->user()->following()->toggle($user->profile);


        return Inertia::render(
            'Dashboard',
            [
                'user' => fn () => auth()->user(),
                'posts' => fn () =>  $user->posts,
                'can' => ['create_update' => auth()->user()->id == $user->id],
                'viewed_user' => fn () =>  $user,
            ]
        );
    }
}
