<?php

namespace App\Jobs;

use App\Models\Video;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use ProtoneMedia\LaravelFFMpeg\Support\FFMpeg;

class CreateThumbnailFromVideo implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public Video $video;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Video $video)
    {
        $this->video = $video;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(): void
    {
        $destination = sprintf('/%s/%s.png', $this->video->uid, $this->video->uid);
        FFMpeg::fromDisk('videos-temp')
            ->open($this->video->path)
            ->getFrameFromSeconds(2)
            ->export()
            ->toDisk('videos')
            ->save($destination);
        $this->video->update([
           'thumbnail_image' =>  sprintf('%s.png', $this->video->uid),
        ]);
    }
}
