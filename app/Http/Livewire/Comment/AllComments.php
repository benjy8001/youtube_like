<?php

namespace App\Http\Livewire\Comment;

use App\Models\Repositories\CommentRepository;
use App\Models\Video;
use Illuminate\View\View;
use Livewire\Component;

class AllComments extends Component
{
    public Video $video;
    protected $listeners = [
        'CommentCreated' => '$refresh',
    ];

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
     * @param CommentRepository $commentRepository
     *
     * @return View
     */
    public function render(CommentRepository $commentRepository): View
    {
        return view('livewire.comment.all-comments', ['comments' => $commentRepository->getAllCommentsForVideo($this->video->id)])
            ->extends('layouts.app');
    }
}
