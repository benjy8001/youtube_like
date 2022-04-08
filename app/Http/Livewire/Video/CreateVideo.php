<?php

namespace App\Http\Livewire\Video;

use App\Jobs\ConvertVideoForStreaming;
use App\Jobs\CreateThumbnailFromVideo;
use App\Models\Channel;
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
    public Video $video;
    /** @var TemporaryUploadedFile */
    public $videoFile;

    protected $rules = [
        'videoFile' => 'required|file|mimes:mp4|max:12228',
    ];

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
     * @return Redirector
     */
    public function fileCompleted(): Redirector
    {
        $this->validate();
        $path = $this->videoFile->store('videos-temp');
        $this->video = $this->channel->videos()->create([
            'title' => 'untitle',
            'description' => 'none',
            'path' => explode('/', $path)[1], //@todo: method to do that
            'uid' => uniqid(true),
            'visibility' => 'private',
        ]);
        CreateThumbnailFromVideo::dispatch($this->video);
        ConvertVideoForStreaming::dispatch($this->video);

        return redirect()->route('video.edit', [
            'channel' => $this->channel,
            'video' => $this->video,
        ]);
    }
}
