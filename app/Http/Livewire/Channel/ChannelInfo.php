<?php

namespace App\Http\Livewire\Channel;

use App\Models\Channel;
use App\Models\Subscription;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Livewire\Component;

class ChannelInfo extends Component
{
    public Channel $channel;
    public bool $userSubscribed = false;

    /**
     * @param Channel $channel
     *
     * @return void
     */
    public function mount(Channel $channel): void
    {
        $this->channel = $channel;
        if (Auth::check()) {
            $this->userSubscribed = auth()->user()->isSubscribedTo($channel);
        }
    }

    /**
     * @return View
     */
    public function render(): View
    {
        return view('livewire.channel.channel-info')
            ->extends('layouts.app');
    }

    /**
     * @return RedirectResponse|null
     */
    public function toggle(): ?RedirectResponse
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        if (auth()->user()->isSubscribedTo($this->channel)) {
            Subscription::where('user_id', auth()->id())->where('channel_id', $this->channel->id)->delete();
            $this->userSubscribed = false;

            return null;
        }
        Subscription::create([
            'user_id' => auth()->id(),
            'channel_id' => $this->channel->id,
        ]);
        $this->userSubscribed = true;

        return null;
    }
}
