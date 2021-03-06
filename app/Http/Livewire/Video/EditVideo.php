<?php

namespace App\Http\Livewire\Video;

use App\Models\Channel;
use App\Models\Repositories\VideoRepository;
use App\Models\Video;
use Illuminate\View\View;
use Livewire\Component;

class EditVideo extends Component
{
    public Channel $channel;
    public Video $video;

    protected $rules = [
        'video.title' => 'required|max:255',
        'video.description' => 'nullable|max:1000',
        'video.visibility' => 'required|in:private,public',
    ];

    /**
     * @param Channel $channel
     * @param Video   $video
     */
    public function mount(Channel $channel, Video $video): void
    {
        $this->channel = $channel;
        $this->video = $video;
    }

    /**
     * @param VideoRepository $videoRepository
     */
    public function update(VideoRepository $videoRepository): void
    {
        $this->validate();
        $videoRepository->update($this->video);

        session()->flash('message', 'Video updated');
    }

    /**
     * @return View
     */
    public function render(): View
    {
        return view('livewire.video.edit-video')
            ->extends('layouts.app');
    }
}
