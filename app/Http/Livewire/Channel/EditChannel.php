<?php

namespace App\Http\Livewire\Channel;

use App\Models\Channel;
use App\Models\Repositories\ChannelRepository;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;
use Livewire\Component;
use Livewire\TemporaryUploadedFile;
use Livewire\WithFileUploads;

class EditChannel extends Component
{
    use AuthorizesRequests;
    use WithFileUploads;

    /** @var Channel */
    public Channel $channel;

    /** @var TemporaryUploadedFile */
    public $image;

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
        return view('livewire.channel.edit-channel')
            ->extends('layouts.app');
    }

    /**
     * @param ChannelRepository $channelRepository
     *
     * @return Redirector
     */
    public function update(ChannelRepository $channelRepository): Redirector
    {
        $this->authorize('update', $this->channel);
        $this->validate();
        $channelRepository->update($this->channel);

        if ($this->image) {
            $channelRepository->updateImageOfChannel($this->channel, $this->image);
        }

        session()->flash('message', __('Channel updated !'));

        return redirect()->route('channel.edit', ['channel' => $this->channel->slug]);
    }

    /**
     * @return string[]
     */
    protected function rules(): array
    {
        return [
            'channel.name' => 'required|max:255|unique:channels,name,'.$this->channel->id,
            'channel.slug' => 'required|max:255|unique:channels,slug,'.$this->channel->id,
            'channel.description' => 'nullable|max:1024',
            'image' => 'nullable|image|max:1024',
        ];
    }
}
