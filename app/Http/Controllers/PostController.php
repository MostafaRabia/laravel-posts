<?php

namespace App\Http\Controllers;

use App\Enums\HttpCode;
use App\Http\Requests\PostRequest;
use App\Models\Post;

class PostController extends Controller
{
    public function __construct(
        public Post $post
    ) {}

    /**
     * Display a listing of the resource.
     */
    public function index(): \Illuminate\Http\JsonResponse
    {
        return $this->prepareResponse(
            HttpCode::OK,
            $this->post->getUserPosts()
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostRequest $request): \Illuminate\Http\JsonResponse
    {
        return $this->prepareResponse(
            HttpCode::CREATED,
            Post::create($request->safe()->toArray()),
            __('post.created'),
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post): \Illuminate\Http\JsonResponse
    {
        $this->authorize('view', $post);

        return $this->prepareResponse(
            HttpCode::OK,
            $post,
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PostRequest $request, Post $post): \Illuminate\Http\JsonResponse
    {
        $this->authorize('update', $post);

        $post->update($request->safe()->toArray());

        return $this->prepareResponse(
            HttpCode::OK,
            $post->fresh(),
            __('post.updated'),
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post): \Illuminate\Http\JsonResponse
    {
        $this->authorize('delete', $post);

        $post->delete();

        return $this->prepareResponse(
            HttpCode::OK,
            $post,
            __('post.deleted'),
        );
    }
}
