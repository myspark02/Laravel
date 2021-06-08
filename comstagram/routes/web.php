<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/dashboard', function () {
    return view('dashboard', ['user' => Auth::user()]);
})->middleware(['auth'])->name('dashboard');


Route::get('/profile/{user}', [ProfileController::class, 'index'])
    ->name('profile.index');
Route::get('/profile/{user}/edit', [ProfileController::class, 'edit'])
    ->name('profile.edit');
Route::patch('/profile/{user}', [ProfileController::class, 'update'])
    ->name('profile.update');

Route::get('/p', [PostController::class, 'create'])->name('post.create');
Route::post('/p', [PostController::class, 'store'])->name('post.store');
Route::get('/p/{post}', [PostController::class, 'show'])->name('post.show');
require __DIR__ . '/auth.php';
