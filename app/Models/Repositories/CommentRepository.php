<?php

declare(strict_types=1);

namespace App\Models\Repositories;

use App\Models\Comment;

final class CommentRepository extends BaseRepository
{
    /**
     * @param Comment $model
     */
    public function __construct(Comment $model)
    {
        parent::__construct($model);
    }
}
