<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index()
    {
        // return 'INDEX';
        $title = 'Welcome to Post System!!!';
        // return view('pages.index',  compact('title'));
        // return view('pages.index')->with('title', $title);
        return view('pages.index', ['title' => $title]);
    }

    public function about()
    {
        $title = 'About Us';
        return view('pages.about')->with('title', $title);
    }

    public function services()
    {
        // $data = array(
        //     'title' => 'Services',
        //     'services' => ['Web Design', 'Programming', 'SEO'],
        // );
        $services = ['Web Design', 'Programming', 'SEO'];
        $title = 'Services';
        return view('pages.services', ['title', $title, 'services' => $services]);
    }
}
