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
}
