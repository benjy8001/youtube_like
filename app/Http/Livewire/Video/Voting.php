<?php

namespace App\Http\Livewire\Video;

use App\Models\Dislike;
use App\Models\Like;
use App\Models\Repositories\LikeRepository;
use App\Models\Video;
use Illuminate\View\View;
use Livewire\Component;

class Voting extends Component
{
    public Video $video;
    public int $likes = 0;
    public int $dislikes = 0;
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
     * @param LikeRepository $likeRepository
     *
     * @return void
     */
    public function like(LikeRepository $likeRepository): void
    {
        if ($this->video->doesUserLikedVideo()) {
            $this->disableLike($likeRepository);
        } else {
            $likeRepository->createForUserAndVideo(auth()->id(), $this->video->id);
            $this->disableDislike();
            $this->likeActive = true;
        }
        $this->emit('LoadValues');
    }

    /**
     * @param LikeRepository $likeRepository
     *
     * @return void
     */
    public function dislike(LikeRepository $likeRepository): void
    {
        if ($this->video->doesUserDislikedVideo()) {
            Dislike::where('user_id', auth()->id())->where('video_id', $this->video->id)->delete();
            $this->dislikeActive = false;
        } else {
            $this->video->dislikes()->create([
                'user_id' => auth()->id(),
            ]);
            $this->disableLike($likeRepository);
            $this->dislikeActive = true;
        }
        $this->emit('LoadValues');
    }

    private function checkIfLike(): void
    {
        $this->likeActive = $this->video->doesUserLikedVideo();
    }

    private function checkIfDislike(): void
    {
        $this->dislikeActive = $this->video->doesUserDislikedVideo();
    }

    private function disableDislike(): void
    {
        Dislike::where('user_id', auth()->id())->where('video_id', $this->video->id)->delete();
        $this->dislikeActive = false;
    }

    private function disableLike(LikeRepository $likeRepository): void
    {
        $likeRepository->deleteForUserAndVideo(auth()->id(), $this->video->id);
        $this->likeActive = false;
    }
}
