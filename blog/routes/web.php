<?php

use App\Http\Controllers\CommentsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GithubAuthController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\PostsController;
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
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';


Route::get('/', [PagesController::class, 'index']);

Route::get('/about', [PagesController::class, 'about']);

Route::get('/services', [PagesController::class, 'services']);

Route::resource('/posts', PostsController::class);

Route::post('/posts/{post}/comments', [CommentsController::class, 'store']);
Route::get('/posts/{post}/comments', [CommentsController::class, 'index']);

Route::get('/chart', function () {
    return view('charts.index', ['labels' => ['A', 'B', 'C', 'D'], 'data' => [7, 4, 9, 2]]);
});

Route::get('/vues/index', function () {
    return view('testvue.index');
});

Route::get('/vues/githubprofiles', function () {
    return view('testvue.github_profiles');
});

Route::get('/social/github', [GithubAuthController::class, 'redirect'])->middleware('guest')->name('github.login');

Route::get('/social/github/callback', [GithubAuthController::class, 'callback'])->middleware('guest');

Route::any('/{anyUrl}', function () {
    return view('welcome');
});
