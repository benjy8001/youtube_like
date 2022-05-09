<?php

declare(strict_types=1);

namespace App\Models\Repositories;

use App\Models\Comment;
use Illuminate\Database\Eloquent\Collection;

final class CommentRepository extends BaseRepository
{
    /**
     * @param Comment $model
     */
    public function __construct(Comment $model)
    {
        parent::__construct($model);
    }

    /**
     * @param int $videoId
     *
     * @return Collection
     */
    public function getAllCommentsForVideo(int $videoId): Collection
    {
        return $this->model->query()
            ->where('video_id', '=', $videoId)
            ->latest()
            ->get();
    }

    /**
     * @param string   $body
     * @param int      $userId
     * @param int      $videoId
     * @param int|null $replyId
     *
     * @return void
     */
    public function createCommentForUserAndVideo(string $body, int $userId, int $videoId, ?int $replyId): void
    {
        $this->model->create([
                                 'body' => $body,
                                 'user_id' => $userId,
                                 'video_id' => $videoId,
                                 'reply_id' => $replyId,
                             ]);
    }
}
