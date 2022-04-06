<div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body"
                         x-data="{ isUploading: false, progress: 0 }"
                         x-on:livewire-upload-start="isUploading = true"
                         x-on:livewire-upload-finish="isUploading = false, $wire.fileCompleted()"
                         x-on:livewire-upload-error="isUploading = false"
                         x-on:livewire-upload-progress="progress = $event.detail.progress"
                    >
                        <div class="progress my-4" x-show="isUploading">
                            <div class="progress-bar" role="progressbar" :style="`width: ${progress}%`" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <form x-show="!isUploading">
                            <input type="file" class="form-control @error('videoFile') is-invalid @enderror" wire:model="videoFile">
                            @error('videoFile')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
