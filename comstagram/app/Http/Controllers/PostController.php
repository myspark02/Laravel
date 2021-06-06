<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }
    public function create()
    {
        return view('post.create');
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $data = $request->validate([
            'caption' => 'required',
            'image' => 'required|image',
        ]);

        // dd($request->image->store('uploads', 'public'));
        $imagePath = $request->image->store('uploads', 'public');

        // $request->user()->posts()->create($data);
        $request->user()->posts()->create([
            'caption' => $data['caption'],
            'image' => $imagePath,

        ]);
        return view('profile.show', ['user' => $request->user()]);
    }
}
