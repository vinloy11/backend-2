<?php

namespace App\Policies;

use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use App\Topic;

class TopicPolicy
{
    use HandlesAuthorization;


    public function __construct()
    {
        //
    }

    public function update(User $user, Topic $topic) {
        return $user->ownsTopic($topic);
    }


}
