<?php

namespace App\Policies;

use App\Models\Comment;
use App\Models\User;

class CommentPolicy
{
    // Only comment owner can delete
    public function delete(User $user, Comment $comment)
    {
        return $user->id === $comment->user_id;
    }
}
