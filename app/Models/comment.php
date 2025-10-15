<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'post_id',
        'user_id',
        'body',
    ];

    // Each Comment belongs to one Post
    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    // Each Comment belongs to one User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
