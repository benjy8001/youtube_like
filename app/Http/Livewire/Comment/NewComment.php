<?php

namespace App\Http\Livewire\Comment;

use App\Models\Video;
use Illuminate\View\View;
use Livewire\Component;

class NewComment extends Component
{
    public Video $video;
    public string $body = '';
    public int $col;

    /**
     * @param Video $video
     * @param int $col
     */
    public function mount(Video $video): void
    {
        $this->video = $video;
        //$this->col = $col;
    }

    /**
     * @return View
     */
    public function render(): View
    {
        return view('livewire.comment.new-comment')
            ->extends('layouts.app');
    }
}
