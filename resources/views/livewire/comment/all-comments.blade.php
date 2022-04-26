<div>
    <h4>{{ $video->allCommentsCount() }} {{ __('comments') }}</h4>
    @include('includes.recursive', ['comments' => $video->comments])
</div>
