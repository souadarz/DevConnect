<?php

namespace App\Http\Controllers;

use App\Models\post;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() { 
        $user = User::where('id',auth()->id())->first();
        $posts = post::all();
        return view('index', compact('posts','user'));
    }
}
