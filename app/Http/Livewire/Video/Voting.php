<?php

namespace App\Http\Livewire\Video;

use App\Models\Video;
use Illuminate\View\View;
use Livewire\Component;

class Voting extends Component
{
    public Video $video;

    /**
     * @param Video $video
     */
    public function mount(Video $video): void
    {
        $this->video = $video;
    }

    /**
     * @return View
     */
    public function render(): View
    {
        return view('livewire.video.voting')
            ->extends('layouts.app');
    }
}
