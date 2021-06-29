<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostsController extends Controller
{

    public function __construct() {
        $this->middleware(['auth'])->except(['show', 'index']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return "Hello";

        // $posts = Post::all();
        // $posts = Post::orderBy('created_at', 'desc')->get();

        // $posts = Post::latest()->get();

        // $posts = Post::latest()->take(1)->get();

        // $posts = DB::select('select  * from posts order by created_at desc');

        $posts = Post::latest()->paginate(10);

        return view('posts.index')->with('posts', $posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,
            ['title' => 'required',
            'body' => 'required']);

            $post = new Post;
            $post->title = $request->input('title');
            $post->body = $request->input('body');
            $post->user_id = auth()->user()->id;
            $post->save();

            return redirect()->route('posts.index')->with('success', 'Post Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $post = Post::findOrFail($id);
        return view('posts.show')->with('post', $post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {

        $post = Post::findOrFail($id);


        if ($request->user()->cannot('edit', $post)) {
            return redirect()->route('posts.index')->with('error', 'You are not authorized to edit this post');
        }

        // $this->authorize('edit', $post);


        return view('posts.edit')->with('post', $post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,
        ['title' => 'required',
        'body' => 'required']);

        $post =  Post::findOrFail($id);

        if ($request->user()->cannot('update', $post)) {
            return redirect()->route('posts.index')->with('error', 'You are not authorized to update this post');
        }

        $post->title = $request->input('title');
        $post->body = $request->input('body');

        $post->save();

        return redirect()->route('posts.index')->with('success', 'Post Updated!!!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $post = Post::findOrFail($id);

        if ($request->user()->cannot('delete', $post)) {
            return redirect()->route('posts.index')->with('error', 'You are not authorized to delete this post');
        }

        $post->delete();

        return redirect()->route('posts.index')->with('success', 'Post Deleted!');
    }
}
