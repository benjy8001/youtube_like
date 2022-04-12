<?php

namespace App\Http\Livewire\Video;

use App\Models\Channel;
use App\Models\Video;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithPagination;

class AllVideo extends Component
{
    use WithPagination;
    use AuthorizesRequests;

    protected $paginationTheme = 'bootstrap';

    public Channel $channel;

    public function mount(Channel $channel): void
    {
        $this->channel = $channel;
    }

    /**
     * @return View
     */
    public function render(): View
    {
        return view('livewire.video.all-video')
            ->with('videos', $this->channel->videos()->paginate(10))
            ->extends('layouts.app');
    }

    /**
     * @param Video $video
     *
     * @return RedirectResponse
     */
    public function delete(Video $video): RedirectResponse
    {
        $this->authorize('delete', $video);
        if (Storage::disk('videos')->deleteDirectory($video->uid)) {
            $video->delete();
        }

        return back();
    }
}
