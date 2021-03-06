<?php

namespace App\Http\Livewire\Video;

use App\Models\Video;
use Illuminate\View\View;
use Livewire\Component;

class WatchVideo extends Component
{
    public Video $video;
    protected $listeners = [
        'VideoViewed' => 'increaseView',
    ];

    /**
     * @param Video $video
     */
    public function mount(Video $video): void
    {
        $this->video = $video;
    }

    public function increaseView(): void
    {
        $this->video->update([
            'views' => ++$this->video->views,
        ]);
    }

    /**
     * @return View
     */
    public function render(): View
    {
        return view('livewire.video.watch-video')
            ->extends('layouts.app');
    }
}
