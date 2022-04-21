<?php

namespace App\Http\Livewire\Channel;

use App\Models\Channel;
use Illuminate\View\View;
use Livewire\Component;

class ChannelInfo extends Component
{
    public Channel $channel;

    /**
     * @param Channel $channel
     *
     * @return void
     */
    public function mount(Channel $channel): void
    {
        $this->channel = $channel;
    }

    /**
     * @return View
     */
    public function render(): View
    {
        return view('livewire.channel.channel-info')
            ->extends('layouts.app');
    }
}
