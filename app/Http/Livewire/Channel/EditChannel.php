<?php

namespace App\Http\Livewire\Channel;

use App\Models\Channel;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;
use Livewire\Component;

class EditChannel extends Component
{
    use AuthorizesRequests;

    /** @var Channel */
    public $channel;

    /**
     * @return string[]
     */
    protected function rules(): array
    {
        return[
            'channel.name' => 'required|max:255|unique:channels,name,' . $this->channel->id,
            'channel.slug' => 'required|max:255|unique:channels,slug,' . $this->channel->id,
            'channel.description' => 'nullable|max:1024',
        ];
    }

    /**
     * @param Channel $channel
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
        return view('livewire.channel.edit-channel');
    }

    /**
     * @return Redirector
     */
    public function update(): Redirector
    {
        $this->authorize('update', $this->channel);
        $this->validate();
        $this->channel->update([
            'name' => $this->channel->name,
            'slug' => $this->channel->slug,
            'description' => $this->channel->description,
        ]);

        session()->flash('message', 'Channel updated');

        return redirect()->route('channel.edit', ['channel' => $this->channel->slug]);
    }
}
