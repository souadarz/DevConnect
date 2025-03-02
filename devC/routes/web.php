<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/index', [HomeController::class, 'index'])->middleware(['auth', 'verified'])->name('index');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// post route
Route::post('/storePost', [PostController::class, 'store'])->name('post.store');
Route::get('/mesPost', [PostController::class, 'show'])->name('post.show');
Route::get('/editPost{post}', [PostController::class, 'edit'])->name('post.edit');
Route::post('/updatePost{post}', [PostController::class, 'update'])->name('post.update');
Route::delete('/deletePost{post}', [PostController::class, 'destroy'])->name('post.delete');

// comment route
Route::post('/storeComment/{post}', [CommentController::class, 'store'])->name('comment.store');

require __DIR__.'/auth.php';
