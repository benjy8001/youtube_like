<div class="my-5">
    <div class="d-flex align-items-center justify-content-between">
        <div class="d-flex align-items-center">
            <img src="{{ secure_asset($channel->picture) }}" class="rounded-circle me-3" alt="">
            <div class="mx-2">
                <h4>{{ $channel->name }}</h4>
                <p class="gray-text text-sm">{{ trans_choice('[0,1]:nb subscriber|:nb subscribers', $channel->subscribers(), ['nb' => $channel->subscribers()]) }}</p>
            </div>
        </div>
        <div>
            <button wire:click.prevent="toggle" class="btn btn-lg text-uppercase {{ $userSubscribed ? 'sub-btn' : 'sub-btn-active' }}">
                {{ $userSubscribed ? __('Unsubscribe') : __('Subscribe') }}
            </button>
        </div>
    </div>
</div>
