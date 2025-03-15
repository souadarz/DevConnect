<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;

class tagController extends Controller
{
    public function store(Request $request, Post $post){
        
        $request->validate([
            'name' => 'required|min:3|string'
        ]);
        
        // $name_tags = trim($_POST['tag_name_input']);
        // $tags = array_map('trim', explode(',', $name_tags));
        // $tag = Tag::firstOrCreate(['name' => $request->name]);
        // $post->tags()->attach($tag->id);

        // $tag = new Tag($tag);
        // $tag->post_id = $post->id;
        // $tag->save();
        return redirect()->back();
}
}
