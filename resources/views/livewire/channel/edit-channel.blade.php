<div>
    {{ $channel->name }}

    <form wire:submit.prevent="update">
        <div class="row mb-3">
            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>
            <div class="col-md-6">
                <input type="text" class="form-control" wire:model="channel.name">
                @error('channel.name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="row mb-3">
            <label for="slug" class="col-md-4 col-form-label text-md-end">{{ __('Slug') }}</label>
            <div class="col-md-6">
                <input type="text" class="form-control" wire:model="channel.slug">
                @error('channel.slug')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="row mb-3">
            <label for="description" class="col-md-4 col-form-label text-md-end">{{ __('Description') }}</label>
            <div class="col-md-6">
                <textarea class="form-control" cols="30" rows="4" wire:model="channel.description"></textarea>
                @error('channel.description')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="row mb-3">
            <div class="offset-4 col-md-6">
                <input type="file" class="form-control" wire:model="image">
                @error('image')
                <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        @if ($image)
            <div class="row mb-3">
                <div class="offset-4 col-md-6">
                    <img src="{{ $image->temporaryUrl() }}" class="img-thumbnail">
                </div>
            </div>
        @endif

        <div class="row mb-3">
            <button type="submit" class="btn btn-primary">{{ __('Update') }}</button>
        </div>

        @if (session()->has('message'))
            <div class="alert alert-success" role="alert">
                {{ session('message') }}
            </div>
        @endif
    </form>
</div>
