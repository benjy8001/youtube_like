<?php

namespace App\Http\Livewire\Video;

use App\Models\Dislike;
use App\Models\Like;
use App\Models\Video;
use Illuminate\View\View;
use Livewire\Component;

class Voting extends Component
{
    public Video $video;
    public Like $likes;
    public Dislike $dislike;
    public $likeActive;
    public $dislikeActive;

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

    /**
     *
     */
    public function like(): void
    {
        $this->video->likes()->create([
            'user_id' => auth()->id(),
        ]);
    }

    /**
     *
     */
    public function dislike(): void
    {
        $this->video->dislikes()->create([
            'user_id' => auth()->id(),
        ]);
    }
}
