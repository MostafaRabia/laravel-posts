<?php

namespace App\Models;

use App\Enums\Pagination;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $with = ['comments'];

    public function user(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function comments(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Comment::class);
    }

    public function getUserPosts(): \Illuminate\Contracts\Pagination\LengthAwarePaginator
    {
        return $this->whereUserId(auth()->id())
            ->paginate(Pagination::DEFAULT->value)
            ->withQueryString();
    }
}
