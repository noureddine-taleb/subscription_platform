<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Post;
use App\Providers\NewPostEvent;
use Illuminate\Support\Facades\Cache;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = [];
        if (Cache::has("posts")) {
            $posts = Cache::get("posts");
        } else {
            $posts = Post::all();
            Cache::set("posts", $posts);
        }
        return response()->json($posts);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {
        // input is validated using StorePostRequest::class
        $post = new Post($request->all());
        $post->save();
        NewPostEvent::dispatch($post);
        Cache::delete("posts");
        return response(status: 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        //
        return response()->json($post);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        //
        Cache::delete("posts");
        $post->update($request->only('title', 'desc'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();
        Cache::delete("posts");
        return response(status:204);
    }
}
