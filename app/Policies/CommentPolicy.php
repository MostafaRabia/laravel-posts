<?php

namespace App\Policies;

use App\Models\Comment;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class CommentPolicy
{
    private function isCommentBelongsToUser(User $user, Comment $comment): bool
    {
        return $user->id === $comment->user_id;
    }

    public function view(User $user, Comment $comment): bool
    {
        return $this->isCommentBelongsToUser($user, $comment);
    }

    public function update(User $user, Comment $comment): bool
    {
        return $this->isCommentBelongsToUser($user, $comment);
    }

    public function delete(User $user, Comment $comment): bool
    {
        return $this->isCommentBelongsToUser($user, $comment);
    }
}
