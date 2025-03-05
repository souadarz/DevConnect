<?php

namespace App\Http\Controllers;

use App\Models\like;
use App\Http\Requests\StorelikeRequest;
use App\Http\Requests\UpdatelikeRequest;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Request;

class LikeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
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
    public function store(Request $request,Post $post)
    {
        // dd('hello');
        $userID = auth()->id();

        $likeExists = $post->likes()->where('user_id', $userID)->exists();
        
        if ($likeExists) {
            $post->likes()->detach($userID);
            return redirect()->back()->with('likeBlue', false);
        } else {
            $post->likes()->attach($userID);
            return redirect()->back()->with('likeBlue', true);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(like $like)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(like $like)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatelikeRequest $request, like $like)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(like $like)
    {
        //
    }
}
