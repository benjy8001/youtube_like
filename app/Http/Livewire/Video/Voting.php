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
    public int $likes = 0;
    public int $dislike = 0;
    public bool $likeActive = true;
    public bool $dislikeActive = true;

    protected $listeners = [
        'LoadValues' => '$refresh',
    ];

    /**
     * @param Video $video
     */
    public function mount(Video $video): void
    {
        $this->video = $video;
        $this->checkIfLike();
        $this->checkIfDislike();
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
        } else {
            $this->video->likes()->create([
                'user_id' => auth()->id(),
            ]);
            $this->likeActive = true;
        }
        $this->disableDislike();
        $this->emit('LoadValues');
    }

    /**
     *
     */
    public function dislike(): void
    {
        if ($this->video->doesUserDislikedVideo()) {
            Dislike::where('user_id', auth()->id())->where('video_id', $this->video->id)->delete();
            $this->dislikeActive = false;
        } else {
            $this->video->dislikes()->create([
                'user_id' => auth()->id(),
            ]);
            $this->disableLike();
            $this->dislikeActive = true;
        }
        $this->emit('LoadValues');
    }

    /**
     *
     */
    public function checkIfLike(): void
    {
        $this->likeActive = $this->video->doesUserLikedVideo();
    }

    /**
     *
     */
    public function checkIfDislike(): void
    {
        $this->dislikeActive = $this->video->doesUserDislikedVideo();
    }

    /**
     *
     */
    public function disableDislike(): void
    {
        Dislike::where('user_id', auth()->id())->where('video_id', $this->video->id)->delete();
        $this->dislikeActive = false;
    }

    /**
     *
     */
    public function disableLike(): void
    {
        Like::where('user_id', auth()->id())->where('video_id', $this->video->id)->delete();
        $this->likeActive = false;
    }
}
