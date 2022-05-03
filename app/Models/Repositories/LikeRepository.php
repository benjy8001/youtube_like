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
}
