<?php

namespace App\Http\Controllers;

use App\Enums\HttpCode;
use App\Http\Requests\CommentRequest;
use App\Models\Comment;
use App\Models\Post;

class CommentController extends Controller
{
    public function __construct(
        public Comment $comment,
    ) {}

    /**
     * Display a listing of the resource.
     */
    public function index(Post $post): \Illuminate\Http\JsonResponse
    {
        return $this->prepareResponse(
            HttpCode::OK,
            $this->comment->getCommentsOfPost($post),
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CommentRequest $request, Post $post): \Illuminate\Http\JsonResponse
    {
        return $this->prepareResponse(
            HttpCode::CREATED,
            Comment::create($request->safe()->toArray()),
            __('comment.created'),
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Comment $comment): \Illuminate\Http\JsonResponse
    {
        $this->authorize('view', $comment);

        return $this->prepareResponse(
            HttpCode::OK,
            $comment
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CommentRequest $request, Comment $comment): \Illuminate\Http\JsonResponse
    {
        $this->authorize('update', $comment);

        $comment->update($request->safe()->toArray());

        return $this->prepareResponse(
            HttpCode::OK,
            $comment->fresh(),
            __('comment.updated'),
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment): \Illuminate\Http\JsonResponse
    {
        $this->authorize('delete', $comment);

        $comment->delete();

        return $this->prepareResponse(
            HttpCode::OK,
            $comment,
            __('comment.deleted'),
        );
    }
}
