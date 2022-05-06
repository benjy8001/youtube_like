<?php

declare(strict_types=1);

namespace App\Models\Repositories;

use App\Models\Channel;
use Intervention\Image\ImageManagerStatic as Image;
use Livewire\TemporaryUploadedFile;

final class ChannelRepository extends BaseRepository
{
    /**
     * @param Channel $model
     */
    public function __construct(Channel $model)
    {
        parent::__construct($model);
    }

    /**
     * @param Channel               $channel
     * @param TemporaryUploadedFile $uploadedFile
     */
    public function updateImageOfChannel(Channel $channel, TemporaryUploadedFile $uploadedFile): void
    {
        $imageName = sprintf('%s.png', $channel->uid);
        $image = $uploadedFile->storeAs('images', $imageName);
        Image::make(sprintf('%s/%s/%s', storage_path(), 'app', $image))
            ->encode('png')
            ->fit(80, 80, function ($constraint) {
                $constraint->upsize();
            })
            ->save();
        $channel->update([
            'image' => $imageName,
        ]);
    }
}
