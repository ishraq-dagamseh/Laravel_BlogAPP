<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;

class PostPolicy
{
    // Only logged-in users can create posts
    public function create(User $user)
    {
        return $user != null;
    }

    // Only post owner can update
    public function update(User $user, Post $post)
    {
        return $user->id === $post->user_id;
    }

    // Only post owner can delete
    public function delete(User $user, Post $post)
    {
        return $user->id === $post->user_id;
    }
}
