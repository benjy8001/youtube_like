<div>
    @if ($channel->image)
        <div class="row mb-3">
            <div class="offset-4 col-md-6">
                <img src="{{ secure_asset('images/' . $channel->image) }}?ver={{ filemtime(public_path('images/' . $channel->image)) }}">
            </div>
        </div>
    @endif

    <form wire:submit.prevent="update">
        <div class="row mb-3">
            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>
            <div class="col-md-6">
                <input type="text" class="form-control @error('channel.name') is-invalid @enderror" wire:model="channel.name">
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
                <input type="text" class="form-control @error('channel.slug') is-invalid @enderror" wire:model="channel.slug">
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
                <textarea class="form-control @error('channel.description') is-invalid @enderror" cols="30" rows="4" wire:model="channel.description"></textarea>
                @error('channel.description')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>
        <div class="row mb-3">
            <div class="offset-4 col-md-6">
                <input type="file" class="form-control @error('image') is-invalid @enderror" wire:model="image">
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
