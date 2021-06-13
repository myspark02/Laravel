<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Cache;
use Intervention\Image\Facades\Image;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index(User $user)
    {
        // dd($user);
        $follows = auth()->user()->following->contains($user->profile);

        // dd($follows);
        // $postCount = $user->posts->count();
        $postCount = Cache::remember(
            'count.posts.' . $user->id,
            now()->addSeconds(30),
            function () use ($user) {
                return $user->posts->count();
            }
        );
        // $followersCount = $user->profile->followers->count();
        $followersCount = Cache::remember(
            'count.followers.' . $user->id,
            now()->addSeconds(30),
            function () use ($user) {
                return $user->profile->followers->count();
            }
        );
        // $followingCount = $user->following->count();
        $followingCount = Cache::remember(
            'count.following.' . $user->id,
            now()->addSeconds(30),
            function () use ($user) {
                return $user->following->count();
            }
        );
        return view('profile.index', compact('user', 'follows', 'postCount', 'followersCount', 'followingCount'));
    }

    public function edit(User $user)
    {
        $this->authorize('update', $user->profile);
        return view('profile.edit', compact('user'));
    }

    public function update(User $user)
    {
        $this->authorize('update', $user->profile);
        $data = request()->validate([
            'title' => 'required',
            'description' => 'required',
            'url' => 'required|url',
            'image' => ''
        ]);

        if (request('image')) {
            $imagePath = request('image')->store('profile', 'public');
            $image = Image::make(public_path("storage/{$imagePath}"))->fit(1000, 1000);
            $image->save();

            $imageArray = ['image' => $imagePath];
        }
        auth()->user()->profile->update(array_merge($data, $imageArray ?? []));

        return redirect("/profile/{$user->id}");
    }
}
