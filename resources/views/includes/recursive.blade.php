
@foreach($comments as $comment)
    <div class="media my-3 ps-3" style="border-left: 1px solid #e9ecef;" x-data="{ openComment: false, openReply: false }">
        <img class="rounded-circle" src="{{ secure_asset($comment->user->channel->picture) }}" alt="Channel image">
        <div class="media-body">
            <h5 class="mt-0">
                {{ $comment->user->name }}
                <span class="text-muted">{{ $comment->created_at->diffForHumans() }}</span>
            </h5>
            {{ $comment->body }}

            <p class="mt-3">
                <a href="" class="text-muted" @click.prevent="openReply = !openReply">{{ __('Reply') }}</a>
            </p>
            @auth
                <div class="my-2" x-show="openReply">
                    <livewire:comment.new-comment :video="$video" :comId="$comment->id" :key="$comment->id . uniqid()" />
                </div>
            @endauth

            @if($comment->replies->count())
                <a href="" @click.prevent="openComment = !openComment"> {{ __('View') }} {{ $comment->replies->count() }} {{ __('replies') }}</a>
                <div x-show="openComment">
                    @include('includes.recursive', ['comments' => $comment->replies])
                </div>
            @endif
        </div>
    </div>
@endforeach
