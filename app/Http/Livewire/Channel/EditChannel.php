<?php

namespace App\Http\Livewire\Channel;

use App\Models\Channel;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;
use Intervention\Image\ImageManagerStatic as Image;
use Livewire\Component;
use Livewire\TemporaryUploadedFile;
use Livewire\WithFileUploads;

class EditChannel extends Component
{
    use AuthorizesRequests;
    use WithFileUploads;

    /** @var Channel */
    public $channel;

    /** @var TemporaryUploadedFile */
    public $image;

    /**
     * @return string[]
     */
    protected function rules(): array
    {
        return[
            'channel.name' => 'required|max:255|unique:channels,name,' . $this->channel->id,
            'channel.slug' => 'required|max:255|unique:channels,slug,' . $this->channel->id,
            'channel.description' => 'nullable|max:1024',
            'image' => 'nullable|image|max:1024',
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

        if ($this->image) {
            $imageName = sprintf('%s.png', $this->channel->uid);
            $image = $this->image->storeAs('images', $imageName);
            Image::make(sprintf('%s/%s/%s', storage_path(), 'app', $image))
                ->encode('png')
                ->fit(80, 80, function ($constraint) {
                    $constraint->upsize();
                })
                ->save();
            $this->channel->update([
                'image' => $imageName,
            ]);
        }

        session()->flash('message', 'Channel updated');

        return redirect()->route('channel.edit', ['channel' => $this->channel->slug]);
    }
}
