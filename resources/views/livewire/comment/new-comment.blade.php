<div>
    <div class="d-flex align-items-center">
        <img src="{{ secure_asset(auth()->user()->channel->picture) }}" class="rounded-circle" style="height: 40px;" alt="{{ __('Avatar') }}">
        <input type="text" wire:model="body" class="my-2 comment-form-control" placeholder="{{ __('Add a public comment ...') }}">
    </div>

    <div class="d-flex justify-content-end align-items-center">
        @if($body)
            <a href="" wire:click.prevent="resetForm">{{ __('Cancel') }}</a>
            <a href="" wire:click.prevent="addComment" class="mx-2 btn btn-secondary">{{ __('Comment') }}</a>
        @endif
    </div>
</div>
