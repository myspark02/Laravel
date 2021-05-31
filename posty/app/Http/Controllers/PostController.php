<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        // $posts = Post::get();     // Collection
        $posts = Post::paginate(20);  // LengthAwarePagenator
        // dd($posts);
        return view('posts.index', ['posts' => $posts]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'body' => 'required',
        ]);

        // Post::create([
        //     'user_id' => auth()->user()->id,  // auth()->id()
        //     'body' => $request->body,
        // ]);

        // $request->user()
        // auth()->user()->posts()->create(['body' => $request->body]);
        auth()->user()->posts()->create($request->only('body'));
        return back();
    }
}
