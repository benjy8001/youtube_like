<?php

declare(strict_types=1);

namespace App\Models\Repositories;

use App\Models\Channel;

final class ChannelRepository extends BaseRepository
{
    /**
     * @param Channel $model
     */
    public function __construct(Channel $model)
    {
        parent::__construct($model);
    }
}
