<?php

namespace App\Http\Controllers;

use App\Models\post;
use App\Http\Requests\StorepostRequest;
use App\Http\Requests\UpdatepostRequest;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request as FacadesRequest;
use Illuminate\View\View;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() {
       //
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
        // dd($request);
        $request->validate([
            'content' => ['required','max:255','string'],
            'code' => ['nullable','string'],
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'link' => ['nullable','url'],
            'profile_image' => ['nullable']
        ]);
        $imagepath = $request->file('image') ? $request->file('image')->store('images', 'public') : null;
        
        $post = Post::create([
            'content' => $request->content,
            'code' => $request->code,
            'image' => $imagepath,
            'link' => $request->link,
            'user_id' => Auth::id() ]);

            if ($request->filled('tags')) {
                $tags = explode(',', $request->tags);
                foreach ($tags as $tagg) {
                    $tag = trim(strtolower($tagg));
                    if (!empty($tag)) {
                        if (!str_starts_with($tag, '#')) {
                            $tag = '#' . $tag;
                        }
                        $tag =Tag::firstOrCreate(['name' => $tag]);
                        // dd($tag);
                        $post->tags()->attach($tag->id);
                    }
                }
            }

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
            'content' => ['required','max:255','string'],
            'code' => ['nullable','string'],
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'link' => ['nullable','url'],
            'profile_image' => ['nullable'],
        ]);
        $imagepath = $request->file('image') ? $request->file('image')->store('images', 'public') : null;

        $post->update([
            'user_id' => Auth::id(),
            'content' => $request->content,
            'code' => $request->code,
            'likn' => $request->link,
            'image' => $imagepath,
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
