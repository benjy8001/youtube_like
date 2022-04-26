
@foreach($comments as $comment)
    <div class="media my-3">
        <img class="mr-3 rounded-circle" src="{{ secure_asset($comment->user->channel->picture) }}" alt="Channel image">
        <div class="media-body">
            <h5 class="mt-0">
                {{ $comment->user->name }}
                <span class="text-muted">{{ $comment->created_at->diffForHumans }}</span>
            </h5>
            {{ $comment->body }}
            @if($comment->replies->count())
                <a href="">{{ $comment->replies->count() }} {{ __('replies') }}</a>
                @include('includes.recursive', ['comments' => $comment->replies])
            @endif
        </div>
    </div>
@endforeach