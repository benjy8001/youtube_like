<div class="my-5">
    <div class="d-flex align-items-center justify-content-between">
        <div class="d-flex align-items-center">
            <img src="{{ secure_asset($channel->picture) }}" class="rounded-circle" alt="">
            <div class="mx-2">
                <h4>{{ $channel->name }}</h4>
                <p class="gray-text text-sm">{{ $channel->subscribers() }} {{ __('subscribers') }}</p>
            </div>
        </div>
        <div>
            <button class="btn btn-lg text-uppercase {{ $userSubscribed ? 'sub-btn' : 'sub-btn-active' }}">
                {{ $userSubscribed ? __('Unsubscribe') : __('Subscribe') }}
            </button>
        </div>
    </div>
</div>
