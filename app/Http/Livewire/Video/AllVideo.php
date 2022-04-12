<?php

namespace App\Http\Livewire\Video;

use App\Models\Video;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\WithPagination;

class AllVideo extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    /**
     * @return View
     */
    public function render(): View
    {
        return view('livewire.video.all-video')
            ->with('videos', auth()->user()->channel->videos()->paginate(10))
            ->extends('layouts.app');
    }

    /**
     * @param Video $video
     *
     * @return RedirectResponse
     */
    public function delete(Video $video): RedirectResponse
    {
        if (Storage::disk('videos')->deleteDirectory($video->uid)) {
            $video->delete();
        }

        return back();
    }
}
