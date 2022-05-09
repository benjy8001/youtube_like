<?php

namespace App\Http\Livewire\Video;

use App\Jobs\ConvertVideoForStreaming;
use App\Jobs\CreateThumbnailFromVideo;
use App\Models\Channel;
use App\Models\Repositories\VideoRepository;
use App\Models\Video;
use Illuminate\Contracts\View\View;
use Illuminate\Routing\Redirector;
use Livewire\Component;
use Livewire\TemporaryUploadedFile;
use Livewire\WithFileUploads;

class CreateVideo extends Component
{
    use WithFileUploads;

    public Channel $channel;
    /** @var TemporaryUploadedFile */
    public $videoFile;

    protected $rules = [
        'videoFile' => 'required|file|mimes:mp4|max:12228',
    ];
    private Video $video;
    private VideoRepository $videoRepository;

    public function mount(Channel $channel): void
    {
        $this->channel = $channel;
    }

    /**
     * @return View
     */
    public function render(): View
    {
        return view('livewire.video.create-video')
            ->extends('layouts.app');
    }

    /**
     * @param VideoRepository $videoRepository
     *
     * @return Redirector
     */
    public function fileCompleted(VideoRepository $videoRepository): Redirector
    {
        $this->validate();
        $path = $this->videoFile->store('videos-temp');
        $this->video = $videoRepository->createDefaultForChannel($this->channel->id, explode('/', $path)[1]); // @todo: method to do that

        CreateThumbnailFromVideo::dispatch($this->video);
        ConvertVideoForStreaming::dispatch($this->video);

        return redirect()->route('video.edit', [
            'locale' => app()->getLocale(),
            'channel' => $this->channel,
            'video' => $this->video,
        ]);
    }
}
