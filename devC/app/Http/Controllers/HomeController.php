<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index() { 
        $user = User::where('id',Auth::id())->first();
        $posts = post::with('tags', 'comments')->get();
        // $comments = Comment::all();
        // dd($posts);
        return view('index', compact('posts','user'));
    }
}
