<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Post;
use App\Providers\NewPostEvent;
use Illuminate\Contracts\Cache\Repository as Cache;
class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Cache $cache)
    {
        $page = request()->has('page') ? request()->get('page') : 1;

        $posts = $cache->tags("posts")->remember('page_'.$page, null, function () {
            return Post::paginate();
        });

        return response()->json($posts);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request, Cache $cache)
    {
        // input is validated using StorePostRequest::class
        $post = new Post($request->all());
        $post->save();
        NewPostEvent::dispatch($post);
        $cache->tags("posts")->flush();
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
    public function update(UpdatePostRequest $request, Post $post, Cache $cache)
    {
        //
        $cache->tags("posts")->flush();
        $post->update($request->only('title', 'desc'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post, Cache $cache)
    {
        $post->delete();
        $cache->tags("posts")->flush();
        return response(status:204);
    }
}
