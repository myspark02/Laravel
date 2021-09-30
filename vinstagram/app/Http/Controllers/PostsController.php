<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Intervention\Image\Facades\Image;

class PostsController extends Controller
{
    public function store(Request $request)
    {
        // dd($request->all());
        $data = $request->validate([
            'caption' => 'required',
            'image' => ['required', 'image'],
        ]);

        // file 이름이 반환된다.
        // dd(request('image')->store('uploads', 'public'));

        // auth()->user()->posts()->create($data);

        $imagePath = request('image')->store('uploads', 'public');

        // 모든 이미지를 1200 X 1200 으로 만듦. 그것보다 더 크면 짜름.
        $image = Image::make(public_path("storage/{$imagePath}"))->fit(1200, 1200);
        $image->save(); // 원본 파일에 덮어쓴다.

        auth()->user()->posts()->create([
            'caption' => $data['caption'],
            'image' => $imagePath
        ]);

        //

        return Inertia::render(
            'Dashboard',
            [
                'user' => auth()->user(),
                'posts' => Auth::user()->posts,
                'can' => ['create_update' => true],
                'viewed_user' => Auth::user(),
                'followers' => auth()->user()->profile->followers->count(),
            ]
        );
    }
}
