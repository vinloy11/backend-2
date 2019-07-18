<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use App\Post;

class PostPolicy
{
    use HandlesAuthorization;


    public function __construct()
    {
        //
    }

    public function update(User $user, Post $post) {
        return $user->ownsPost($post);
    }

    public function destroy(User $user, Post $post) {
        return $user->ownsPost($post);
    }

}
