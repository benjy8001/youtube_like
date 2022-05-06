<?php

declare(strict_types=1);

namespace App\Models\Repositories;

use App\Models\Subscription;

final class SubscriptionRepository extends BaseRepository
{
    /**
     * @param Subscription $model
     */
    public function __construct(Subscription $model)
    {
        parent::__construct($model);
    }

    /**
     * @param int $userId
     * @param int $channelId
     */
    public function deleteForUserAndChannel(int $userId, int $channelId): void
    {
        $this->model->where('user_id', $userId)->where('channel_id', $channelId)->delete();
    }

    /**
     * @param int $userId
     * @param int $channelId
     *
     * @return Subscription
     */
    public function createForUserAndChannel(int $userId, int $channelId): Subscription
    {
        return parent::create([
            'user_id' => $userId,
            'channel_id' => $channelId,
        ]);
    }
}
