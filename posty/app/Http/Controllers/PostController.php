<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth'])->only(['store', 'destroy']);
    }
    public function index()
    {
        // $posts = Post::get();     // Collection
        // $posts = Post::paginate(20);  // LengthAwarePagenator
        // Eager loading으로 N+1 problem 문제를 해결하자
        // $posts = Post::orderBy('created_at', 'desc')->with(['user', 'likes'])->paginate(20);
        $posts = Post::latest()->with(['user', 'likes'])->paginate(20);
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

    public function destroy(Post $post)
    {
        // if (!$post->ownedBy(auth()->user())) {
        //     // dd('no');
        // }
        $this->authorize('delete', $post);
        $post->delete();
        return back();
    }

    public function show(Post $post)
    {
        return view('posts.show', ['post' => $post,]);
    }
}
