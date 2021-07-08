<?php

namespace App\Http\Controllers;

use App\Jobs\ProcessPost;
use App\Mail\NewPostMail;
use App\Models\Post;
use App\Providers\PostCreated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

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
            'body' => 'required',
            'cover_image' => 'nullable|image|max:9999']);

            // Handle File Upload
            $fileNameToStore = null;

            if ($request->hasFile('cover_image')) {
                $fileNameWithExt = $request->file('cover_image')->getClientOriginalName();

                // file name without extension
                $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);

                // file name extension
                $extension = $request->file('cover_image')->getClientOriginalExtension();

                // file name to store
                $fileNameToStore = $fileName.'_'.time().'.'.$extension;

                // upload image
                $path = $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);
            }

            $post = new Post;
            $post->title = $request->input('title');
            $post->body = $request->input('body');
            $post->user_id = auth()->user()->id;
            $post->cover_image = $fileNameToStore;
            $post->save();

            // PostCreated::dispatch(auth()->user());
            // dd(auth()->user());
            // ProcessPost::dispatch(Auth::user());  // job dispatch
            ProcessPost::dispatchIf(Auth::user()->posts->count() == 1, Auth::user());

            // ProcessPost::dispatch(Auth::user())->delay(now()->addMinutes(10));

            // ProcessPost::dispatchAfterResponse(Auth::user());

            // dispatch(function() {
            //     Mail::to(Auth::user()->email)->send(new NewPostMail());
            // })->afterResponse();

            // ProcessPost::dispatchSync(Auth::user());

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
        // $post->count++;
        // $post->save();
        if ($post->users->contains(auth()->user()) == false) {
            $post->users()->attach(auth()->user()->id);
            $post->refresh();
        }
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


        if ($request->user()->cannot('update', $post)) {
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
        'body' => 'required',
        'cover_image' => 'nullable|image|max:9999'
        ]);

        $post =  Post::findOrFail($id);

        if ($request->user()->cannot('update', $post)) {
            return redirect()->route('posts.index')->with('error', 'You are not authorized to update this post');
        }

         // Handle File Upload
         $fileNameToStore = null;

         if ($request->hasFile('cover_image')) {
             $fileNameWithExt = $request->file('cover_image')->getClientOriginalName();

             // file name without extension
             $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);

             // file name extension
             $extension = $request->file('cover_image')->getClientOriginalExtension();

             // file name to store
             $fileNameToStore = $fileName.'_'.time().'.'.$extension;

             // upload image
             $path = $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);

             Storage::delete('public/cover_images/'.$post->cover_image);

             $post->cover_image = $fileNameToStore;
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
        if ($post->cover_image) {
            Storage::delete('public/cover_images/'.$post->cover_image);
        }

        $post->delete();

        return redirect()->route('posts.index')->with('success', 'Post Deleted!');
    }
}
