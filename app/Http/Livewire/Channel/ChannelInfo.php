<?php

namespace App\Http\Livewire\Channel;

use App\Models\Channel;
use App\Models\Repositories\ChannelRepository;
use App\Models\Repositories\SubscriptionRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\Redirector;

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
     * @param ChannelRepository      $channelRepository
     * @param SubscriptionRepository $subscriptionRepository
     *
     * @return Redirector|null
     */
    public function toggle(SubscriptionRepository $subscriptionRepository): ?Redirector
    {
        if (!Auth::check()) {
            return redirect()->route('login', app()->getLocale());
        }

        if (auth()->user()->isSubscribedTo($this->channel)) {
            $subscriptionRepository->deleteForUserAndChannel(auth()->id(), $this->channel->id);
            $this->userSubscribed = false;

            return null;
        }
        $subscriptionRepository->createForUserAndChannel(auth()->id(), $this->channel->id);
        $this->userSubscribed = true;

        return null;
    }
}
