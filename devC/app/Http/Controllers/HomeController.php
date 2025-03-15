<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Notification;
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
        $count_notifications = Notification::count();
        return view('index', compact('posts','user','count_notifications'));
    }
    public function showProfile($user_id){
        $user = User::where('id',$user_id)->first();

        // dd($user);
        return view('/profile',compact('user'));
    }
}
