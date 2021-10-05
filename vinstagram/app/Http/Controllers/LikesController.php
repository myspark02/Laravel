<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Inertia\Inertia;

class LikesController extends Controller
{
    public function store(Post $post)
    {
        auth()->user()->likes()->toggle($post);

        return 'success';
    }

    public function show(Post $post)
    {
        $like = auth()->user()->likes->contains($post);

        return $like;
    }
}
