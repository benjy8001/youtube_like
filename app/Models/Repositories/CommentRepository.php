<?php

declare(strict_types=1);

namespace App\Models\Repositories;

use App\Models\Comment;

// @todo : Use thix one for get comments too
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
