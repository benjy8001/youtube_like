<?php

namespace App\Http\Livewire\Video;

use App\Models\Like;
use App\Models\Video;
use Illuminate\View\View;
use Livewire\Component;

class Voting extends Component
{
    public Video $video;
    public int $likes = 0;
    public int $dislike = 0;
    public bool $likeActive = true;
    public bool $dislikeActive = true;

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
        $this->likes = $this->video->likes->count();
        $this->dislikes = $this->video->dislikes->count();
        return view('livewire.video.voting')
            ->extends('layouts.app');
    }

    /**
     *
     */
    public function like(): void
    {
        if ($this->video->doesUserLikedVideo()) {
            Like::where('user_id', auth()->id())->where('video_id', $this->video->id)->delete();
            $this->likeActive = false;
            return;
        }
        $this->video->likes()->create([
            'user_id' => auth()->id(),
        ]);
        $this->likeActive = true;
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
