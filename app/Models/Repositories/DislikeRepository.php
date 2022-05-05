<?php

declare(strict_types=1);

namespace App\Models\Repositories;

use App\Models\Dislike;

final class DislikeRepository extends BaseRepository
{
    /**
     * @param Dislike $model
     */
    public function __construct(Dislike $model)
    {
        parent::__construct($model);
    }

    /**
     * @param int $userId
     * @param int $videoId
     *
     * @return Dislike
     */
    public function createForUserAndVideo(int $userId, int $videoId): Dislike
    {
        return parent::create([
                                  'user_id' => $userId,
                                  'video_id' => $videoId,
                              ]);
    }

    /**
     * @param int $userId
     * @param int $videoId
     *
     * @return void
     */
    public function deleteForUserAndVideo(int $userId, int $videoId): void
    {
        $this->model->where('user_id', $userId)->where('video_id', $videoId)->delete();
    }
}
