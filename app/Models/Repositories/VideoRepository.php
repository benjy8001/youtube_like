<?php

declare(strict_types=1);

namespace App\Models\Repositories;

use App\Enum\VideoVisibilityEnum;
use App\Models\Video;
use Illuminate\Database\Eloquent\Collection;

final class VideoRepository extends BaseRepository
{
    /**
     * @param Video $model
     */
    public function __construct(Video $model)
    {
        parent::__construct($model);
    }

    /**
     * @param string|null $search
     *
     * @return Collection
     */
    public function search(?string $search): Collection
    {
        if (null === $search) {
            return new Collection();
        }

        return $this->model->query()
            ->where('title', 'LIKE', sprintf('%%%s%%', $search))
            ->orWhere('description', 'LIKE', sprintf('%%%s%%', $search))
            ->get();
    }

    /**
     * @param int    $channelId
     * @param string $path
     *
     * @return Video
     */
    public function createDefaultForChannel(int $channelId, string $path): Video
    {
        return $this->model->create([
            'channel_id' => $channelId,
            'title' => 'untitle',
            'description' => 'none',
            'path' => $path,
            'uid' => uniqid('', true),
            'visibility' => VideoVisibilityEnum::PRIVATE,
        ]);
    }
}
