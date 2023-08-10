<?php

namespace App\Models;

use App\Enums\Pagination;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $with = ['user'];

    public function user(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function post(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Post::class, 'id', 'post_id');
    }

    public function getCommentsOfPost(Post $post): \Illuminate\Contracts\Pagination\LengthAwarePaginator
    {
        return $this->wherePostId($post->id)
            ->paginate(Pagination::DEFAULT->value)
            ->withQueryString();
    }
}
