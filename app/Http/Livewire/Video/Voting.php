<?php

namespace App\Http\Livewire\Video;

use App\Models\Repositories\DislikeRepository;
use App\Models\Repositories\LikeRepository;
use App\Models\Video;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\Redirector;

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
     * @param LikeRepository    $likeRepository
     * @param DislikeRepository $dislikeRepository
     *
     * @return Redirector|null
     */
    public function like(LikeRepository $likeRepository, DislikeRepository $dislikeRepository): ?Redirector
    {
        if (!Auth::check()) {
            return redirect()->route('login', app()->getLocale());
        }

        if ($this->video->doesUserLikedVideo()) {
            $this->disableLike($likeRepository);
        } else {
            $this->enableLike($likeRepository);
            $this->disableDislike($dislikeRepository);
        }
        $this->emit('LoadValues');
    }

    /**
     * @param LikeRepository    $likeRepository
     * @param DislikeRepository $dislikeRepository
     *
     * @return Redirector|null
     */
    public function dislike(LikeRepository $likeRepository, DislikeRepository $dislikeRepository): ?Redirector
    {
        if (!Auth::check()) {
            return redirect()->route('login', app()->getLocale());
        }

        if ($this->video->doesUserDislikedVideo()) {
            $this->disableDislike($dislikeRepository);
        } else {
            $this->enableDislike($dislikeRepository);
            $this->disableLike($likeRepository);
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

    /**
     * @param DislikeRepository $dislikeRepository
     *
     * @return void
     */
    private function enableDislike(DislikeRepository $dislikeRepository): void
    {
        $dislikeRepository->createForUserAndVideo(auth()->id(), $this->video->id);
        $this->dislikeActive = true;
    }

    /**
     * @param DislikeRepository $dislikeRepository
     *
     * @return void
     */
    private function disableDislike(DislikeRepository $dislikeRepository): void
    {
        $dislikeRepository->deleteForUserAndVideo(auth()->id(), $this->video->id);
        $this->dislikeActive = false;
    }

    /**
     * @param LikeRepository $likeRepository
     *
     * @return void
     */
    private function enableLike(LikeRepository $likeRepository): void
    {
        $likeRepository->createForUserAndVideo(auth()->id(), $this->video->id);
        $this->likeActive = true;
    }

    /**
     * @param LikeRepository $likeRepository
     *
     * @return void
     */
    private function disableLike(LikeRepository $likeRepository): void
    {
        $likeRepository->deleteForUserAndVideo(auth()->id(), $this->video->id);
        $this->likeActive = false;
    }
}
