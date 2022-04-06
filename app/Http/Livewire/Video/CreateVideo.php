<?php

namespace App\Http\Livewire\Video;

use App\Models\Channel;
use App\Models\Video;
use Illuminate\Contracts\View\View;
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
     *
     */
    public function fileCompleted(): void
    {

    }

    /**
     *
     */
    public function upload(): void
    {
        $this->validate([
            'videoFile' => 'required|mimes:mp4|max:102400',
        ]);
    }
}
