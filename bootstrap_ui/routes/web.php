<?php

use App\Events\Message;
use App\Jobs\SendEmailJob;
use App\Mail\NewMsgNotify;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
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

Route::get('/test', function () {
    return view('test');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('/events', function () {
    // Message::dispatch("Sunday morning event!");
    event(new Message("Sunday morning event!"));
});

Route::get('/events/listen', function () {
    return view('events.listener');
});

Route::get('/sendemail', function () {
    SendEmailJob::dispatch()->delay(now()->addSeconds(5));;
    return "Email is sent succefully!";
});
