<div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="row">
                    <div class="col-md-4">
                        <img src="{{ secure_asset($this->video->thumbnail) }}" alt="" class="img-thumbnail">
                    </div>
                    <div class="col-md-4">
                        <p>Processing ({{ $this->video->processing_percentage }})</p>
                    </div>
                </div>
                <form wire:submit.prevent="update">
                    <div class="row mb-3">
                        <label for="title" class="col-md-4 col-form-label text-md-end">{{ __('Title') }}</label>
                        <div class="col-md-6">
                            <input type="text" class="form-control @error('video.title') is-invalid @enderror" wire:model="video.title">
                            @error('video.title')
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="description" class="col-md-4 col-form-label text-md-end">{{ __('Description') }}</label>
                        <div class="col-md-6">
                            <textarea class="form-control @error('video.description') is-invalid @enderror" cols="30" rows="4" wire:model="video.description"></textarea>
                            @error('video.description')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="visibility" class="col-md-4 col-form-label text-md-end">{{ __('Visibility') }}</label>
                        <div class="col-md-6">
                            <select class="form-select @error('video.visibility') is-invalid @enderror" wire:model="video.visibility">
                                <option value="private">Private</option>
                                <option value="public">Public</option>
                            </select>
                            @error('video.visibility')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>


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
        </div>
    </div>
</div>
