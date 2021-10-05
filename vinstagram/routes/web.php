<?php

use App\Http\Controllers\FollowsController;
use App\Http\Controllers\LikesController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\ProfilesController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

use App\Mail\NewUserWelcomeMail;
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

// Route::get('/', function () {
//     return Inertia::render('Welcome', [
//         'canLogin' => Route::has('login'),
//         'canRegister' => Route::has('register'),
//         'laravelVersion' => Application::VERSION,
//         'phpVersion' => PHP_VERSION,
//     ]);
// });

Route::middleware(['auth:sanctum', 'verified'])->get('/', [PostsController::class, 'index'])->name('home');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return Inertia::render(
        'Dashboard',
        [
            'user' => Auth::user(),
            'posts' => Auth::user()->posts,
            'can' => ['create_update' => true],
            'viewed_user' => fn () => Auth::user(),
            'followers' => Auth::user()->profile->followers->count(),
        ]
    );
})->name('dashboard');


Route::middleware(['auth:sanctum', 'verified'])->get('/profile/{name}', [ProfilesController::class, "index"]);

// Route::middleware(['auth:sanctum', 'verified'])
//         ->get('/post/create', [PostsController::class, "create"])
//         ->name('post.create');


Route::middleware(['auth:sanctum', 'verified'])
    ->post('/post/store', [PostsController::class, "store"])
    ->name('post.store');

Route::middleware(['auth:sanctum', 'verified'])
    ->patch('/profile/update', [ProfilesController::class, "update"])
    ->name('profile.update');

Route::middleware(['auth:sanctum', 'verified'])
    ->post('/follow/{user}', [FollowsController::class, "store"])
    ->name('follow.store');

Route::middleware(['auth:sanctum', 'verified'])
    ->post('/like/{post}', [LikesController::class, "store"])
    ->name('like.store');

Route::middleware(['auth:sanctum', 'verified'])
    ->get('/like/{post}', [LikesController::class, "show"])
    ->name('like.show');


// Just for test
Route::get('/email', function () {
    return new NewUserWelcomeMail();
});
