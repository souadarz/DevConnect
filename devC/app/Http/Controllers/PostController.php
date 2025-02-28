<?php

namespace App\Http\Controllers;

use App\Models\post;
use App\Http\Requests\StorepostRequest;
use App\Http\Requests\UpdatepostRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request as FacadesRequest;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() {
        return view('index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'content' => ['required'],
            'code' => ['nullable', 'string'],
            'image' => ['nullable', 'image'],
            'link' => ['nullable', 'url'],
            'profile_image' => ['nullable', 'image'],
        ]);

        $imagepath = $request->file('image') ? $request->file('image')->store('posts', 'public') : null;

        $post = Post::create([
            'content' => $request->content,
            'code' => $request->code,
            'image' => $imagepath,
            'link' => $request->link,
            'user_id' => Auth::id(),
        ]);

        return redirect(route('index'));
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $posts = post::where('user_id', Auth::id())->get();
        return view('/mesPost', compact(['posts']));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(post $post)
    {
        return view('editPost', compact(['post']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, post $post)
    {
        $request->validate([
            'content' => ['required'],
        ]);

        $post->update([
            'user_id' => Auth::id(),
            'content' => $request->content,
        ]);

        return redirect(route('post.show'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(post $post)
    {
        $post->delete();
        return redirect(route('post.show'));
    }
}
