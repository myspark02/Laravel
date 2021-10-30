<?php

use App\Http\Controllers\ClassesController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->name('dashboard');


Route::middleware(['auth:sanctum', 'verified'])->get('/classes/registered', [ClassesController::class, 'index_cr'])
    ->name('classes.registered'); // 수강신청한 교과목 리스트 보기
Route::middleware(['auth:sanctum', 'verified'])->get('/classes', [ClassesController::class, 'index'])
    ->name('classes'); // 교과목 리스트 보기
Route::middleware(['auth:sanctum', 'verified'])->get('/classes/show/{classId}', [ClassesController::class, 'show'])
    ->name('classes.show'); // 특정 교과목 상세보기
Route::middleware(['auth:sanctum', 'verified'])->get('/classes/create', [ClassesController::class, 'create'])
    ->name('classes.create'); // 교과목 등록 폼
Route::middleware(['auth:sanctum', 'verified'])->post('/classes/store', [ClassesController::class, 'store'])
    ->name('classes.store'); // 교과목 등록
// Route::middleware(['auth:sanctum', 'verified'])->get('/classes/edit/{classId}', [ClassesController::class, 'edit'])
//             ->name('classes.edit');//  교과목 변경 폼
Route::middleware(['auth:sanctum', 'verified'])->patch('/classes/update/{classId}', [ClassesController::class, 'update'])
    ->name('classes.update'); // 교과목 변경
Route::middleware(['auth:sanctum', 'verified'])->delete('/classes/delete/{classId}', [ClassesController::class, 'destroy'])
    ->name('classes.destroy'); // 교과목 삭제

Route::middleware(['auth:sanctum', 'verified'])->post('/classes/register/{classId}', [ClassesController::class, 'register'])
    ->name('classes.register'); // 수강신청 및 수강취소 