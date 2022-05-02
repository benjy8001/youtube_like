<?php

namespace App\Jobs;

use App\Models\Video;
use FFMpeg\Format\Video\X264;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use ProtoneMedia\LaravelFFMpeg\Support\FFMpeg;

class ConvertVideoForStreaming implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    public Video $video;

    /**
     * Create a new job instance.
     *
     * @param Video $video
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
        $destination = sprintf('/%s/%s.m3u8', $this->video->uid, $this->video->uid); // @todo: common with CreateThumbnail, except extension
        $low = (new X264('aac'))->setKiloBitrate(500);
        $high = (new X264('aac'))->setKiloBitrate(1000);

        $media = FFMpeg::fromDisk('videos-temp')
            ->open($this->video->path)
            ->exportForHLS()
            ->addFormat($low, function ($filters) {
                $filters->resize(640, 480);
            })
            ->addFormat($high, function ($filters) {
                $filters->resize(1280, 720);
            })
            ->onProgress(function ($progress) {
                $this->video->update([
                    'processing_percentage' => $progress,
                ]);
            })
            ->toDisk('videos')
            ->save($destination);

        $this->video->update([
            'processed' => true,
            'processed_file' => sprintf('%s.m3u8', $this->video->uid),
            'duration' => $media->getDurationInSeconds(),
        ]);

        Storage::disk('videos-temp')->delete($this->video->path);
    }
}
