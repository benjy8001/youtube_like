<?php

declare(strict_types=1);

namespace App\Models\Repositories;

use App\Models\User;

final class VideoRepository extends BaseRepository
{
    /**
     * @param User $model
     */
    public function __construct(User $model)
    {
        parent::__construct($model);
    }
}
