<?php

namespace App\Http\Livewire\Comment;

use App\Models\Video;
use Illuminate\View\View;
use Livewire\Component;

class AllComments extends Component
{
    public Video $video;

    /**
     * @param Video $video
     *
     * @return void
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
        return view('livewire.comment.all-comments')
            ->extends('layouts.app');
    }
}
