<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Post;
use App\Providers\NewPostEvent;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return response()->json(Post::all());
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
        $post->update($request->intersect('title', 'desc'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return response(status:204);
    }
}
