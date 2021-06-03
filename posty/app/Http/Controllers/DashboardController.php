<?php

namespace App\Http\Controllers;

use App\Mail\PostLiked;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }
    public function index()
    {
        // dd(auth()->user()); 
        // $user = auth()->user();

        // Mail::to($user)->send(new PostLiked("Someone Liked Your Post"));
        return view('dashboard');
    }
}
