<?php

namespace App\Http\Livewire\Comment;

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
     * @param int $comId
     */
    public function mount(Video $video, int $comId): void
    {
        $this->video = $video;
        $this->comId = empty($comId) ? null : $comId;
    }

    /**
     *
     */
    public function resetForm(): void
    {
        $this->body = '';
    }

    public function addComment(): void
    {
        auth()->user()->comments()->create([
            'body' => $this->body,
            'video_id' => $this->video->id,
            'reply_id' => $this->comId,
        ]);

        $this->resetForm();
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
