<?php

namespace App\Http\Livewire\Channel;

use App\Models\Channel;
use Illuminate\View\View;
use Livewire\Component;

class EditChannel extends Component
{
    /** @var string */
    public $channel;

    /**
     * @param Channel $channel
     */
    public function mount(Channel $channel): void
    {
        $this->channel = $channel;
    }

    public function render(): View
    {
        return view('livewire.channel.edit-channel');
    }
}
