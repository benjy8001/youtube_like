<?php

namespace App\Policies;

use App\Models\Channel;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ChannelPolicy
{
    use HandlesAuthorization;

    /**
     * @param User $user
     * @param Channel $channel
     * @return bool
     */
    public function update(User $user, Channel $channel): bool
    {
        return $user->id === $channel->user_id;
    }
}
