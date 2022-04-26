
@foreach($comments as $comment)
    <div class="media my-3" x-data="{ open: false }">
        <img class="mr-3 rounded-circle" src="{{ secure_asset($comment->user->channel->picture) }}" alt="Channel image">
        <div class="media-body">
            <h5 class="mt-0">
                {{ $comment->user->name }}
                <span class="text-muted">{{ $comment->created_at->diffForHumans }}</span>
            </h5>
            {{ $comment->body }}
            @if($comment->replies->count())
                <a href="" @click.prevent="open = !open">{{ $comment->replies->count() }} {{ __('replies') }}</a>
                <div x-show="open">
                    @include('includes.recursive', ['comments' => $comment->replies])
                </div>
            @endif
        </div>
    </div>
@endforeach