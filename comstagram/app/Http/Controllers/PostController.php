<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index()
    {
        $users = auth()->user()->following()->pluck('profiles.user_id');
        // dd($users);
        // $posts = Post::whereIn('user_id', $users)->latest()->get();
        $posts = Post::whereIn('user_id', $users)->latest()->with('user')->paginate(5);
        // dd($posts);

        return view('post.index', compact('posts'));
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

        // dd($request->image->store('uploads'));
        $imagePath = $request->image->store('uploads', 'public');

        // Intervention/image package <= composer require intervention/image 다운로드 받기!
        // 리사이즈가 아닌 컷
        // use Intervention\Image\Facades\Image; <= 잊지 말것!
        $image = Image::make(public_path("storage/$imagePath"))->fit(1200, 1200); // width, height
        $image->save();
        // $request->user()->posts()->create($data);
        $request->user()->posts()->create([
            'caption' => $data['caption'],
            'image' => $imagePath,

        ]);
        // return view('profile.index', ['user' => $request->user()]);
        return redirect('/profile/' . auth()->user()->id);
    }

    public function show(Post $post)
    {
        // dd($post);
        return view('post.show', compact('post'));
    }
}
