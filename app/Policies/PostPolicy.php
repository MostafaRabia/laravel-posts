<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class PostPolicy
{
    private function isPostBelongsToUser(User $user, Post $post): bool
    {
        return $user->id === $post->user_id;
    }

    public function view(User $user, Post $post): bool
    {
        return $this->isPostBelongsToUser($user, $post);
    }

    public function update(User $user, Post $post): bool
    {
        return $this->isPostBelongsToUser($user, $post);
    }

    public function delete(User $user, Post $post): bool
    {
        return $this->isPostBelongsToUser($user, $post);
    }
}
