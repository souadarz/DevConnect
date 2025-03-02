<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;

class tagController extends Controller
{
    public function store(Request $request, Post $post){
        
        $tag = $request->validate([
            'content' => 'required|min:3|string'
        ]);
        
        $tag = new Tag($tag);
        // $tag->user_id = auth()->id();
        $tag->post_id = $post->id;
        $tag->save();
        return redirect()->back();
}
}
