<?php

namespace App\Http\Livewire\Comment;

use App\Models\Repositories\CommentRepository;
use App\Models\Video;
use Illuminate\View\View;
use Livewire\Component;

class NewComment extends Component
{
    public Video $video;
    public string $body = '';
    public ?int $comId = null;

    /**
     * @param Video $video
     * @param int   $comId
     */
    public function mount(Video $video, int $comId): void
    {
        $this->video = $video;
        $this->comId = empty($comId) ? null : $comId;
    }

    public function resetForm(): void
    {
        $this->body = '';
    }

    /**
     * @param CommentRepository $commentRepository
     *
     * @return void
     */
    public function addComment(CommentRepository $commentRepository): void
    {
        $commentRepository->createCommentForUserAndVideo($this->body, auth()->id(), $this->video->id, $this->comId);
        $this->resetForm();
        $this->emit('CommentCreated');
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
