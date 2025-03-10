<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\ConnexionController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TweetController;
use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\Route;
use Laravel\Reverb\Protocols\Pusher\Http\Controllers\ConnectionsController;

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/index', [HomeController::class, 'index'])->middleware(['auth', 'verified'])->name('index');
Route::get('/userProfile/{user_id}', [HomeController::class, 'showProfile'])->name('profile.user');

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
Route::post('/like/{post}', [LikeController::class, 'store'])->name('like.store');

// Route::get('/tweet', [TweetController::class, 'create'])->name('tweets.create');
Route::post('/tweets', [TweetController::class, 'store'])->name('tweets.store');

Route::view('pusher1', 'pusher1');
Route::view('pusher1', 'layouts/pusher1');
Route::view('tweet', 'tweet');

// connection route 
Route::post('/sendConnection/{receiver_id}', [ConnexionController::class, 'sendConnection'])->name('connection.send');
Route::get('/connections', [ConnexionController::class, 'index'])->name('connections.page');
Route::post('/acceptConnection/{connexion_id}', [ConnexionController::class, 'acceptConnection'])->name('connection.accept');
Route::post('/rejectConnection/{connexion_id}', [ConnexionController::class, 'rejectConnection'])->name('connection.reject');

// Route::view('index', 'index');

  
require __DIR__.'/auth.php';
