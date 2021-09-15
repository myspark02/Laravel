<?php

use App\Http\Controllers\GithubAuthController;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    // $comments = Comment::latest()->paginate(2);
    // return view('welcome', compact('comments'));  // 이렇게 전달한 데이터를 mount 메소드의 인자로 전달된다

    return view('welcome');
})->name('home')->middleware('auth:sanctum');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');


Route::get('/github', [GithubAuthController::class, 'redirect'])->name('github.login')->middleware(['guest']);
Route::get('/github/callback', [GithubAuthController::class, 'callback']);

Route::get('/users', function() {
    return view('users');
})->name('users');


Route::get('/github_users', function() {
    return User::select('name')->get();
});
