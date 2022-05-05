<?php

declare(strict_types=1);

namespace App\Models\Repositories;

use App\Models\Like;

final class LikeRepository extends BaseRepository
{
    /**
     * @param Like $model
     */
    public function __construct(Like $model)
    {
        parent::__construct($model);
    }

    /**
     * @param int $userId
     * @param int $videoId
     *
     * @return Like
     */
    public function createForUserAndVideo(int $userId, int $videoId): Like
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
