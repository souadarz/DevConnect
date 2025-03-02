<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index() { 
        $comments = Comment::all();
        $user = User::where('id',Auth::id())->first();
        $posts = post::all();
        return view('index', compact('posts','user','comments'));
    }
}
