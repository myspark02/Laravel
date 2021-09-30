<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Inertia\Inertia;

class ProfilesController extends Controller
{
    public function index($name)
    {
        $user = Cache::remember(
            'user.' . $name,
            now()->addSeconds(30),
            function () use ($name) {
                return User::where('name', $name)->first();
            }
        );

        if ($user) {
            $posts = Cache::remember(
                'count.posts.' . $user->id,
                now()->addSeconds(30),
                function () use ($user) {
                    return $user->posts;
                }
            );

            $followers = Cache::remember(
                'count.followers.' . $user->id,
                now()->addSeconds(30),
                function () use ($user) {
                    return $user->profile->followers->count();
                }
            );
            return Inertia::render('Dashboard', [
                'user' => Auth::user(),
                'posts' => $posts,
                'can' => ['create_update' => Auth::user()->id == $user->id],
                'viewed_user' => $user,
                'followers' => $followers,
            ]);
        } else
            return Inertia::render('Notfound');
    }

    public function update(Request $request)
    {
        // 본인 프로파일 업데이트
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
                'followers' => Auth::user()->profile->followers->count(),
            ]
        );
    }
}
