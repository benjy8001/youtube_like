<div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                @if ($videos->count())
                    @foreach($videos as $video)
                        <div class="card my-2">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-2">
                                        <div style="position: relative;">
                                            <a href="{{ route('video.watch', ['video' => $video]) }}" alt="{{ $video->title }}">
                                                <img src="{{ secure_asset($video->thumbnail) }}" alt="" class="img-thumbnail">
                                                <div class="badge bg-dark" style="position: absolute; bottom: 8px; right: 16px;"> {{ $video->durationForHumans }}</div>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <h5>{{ $video->title }}</h5>
                                        <p class="text-truncate">{{ $video->description }}</p>
                                    </div>
                                    <div class="col-md-2">
                                        {{ $video->visibility }}
                                    </div>
                                    <div class="col-md-2">
                                        {{ $video->created_at->format('d/m/Y') }}
                                    </div>
                                    @if (auth()->user()->owns($video))
                                        <div class="col-md-2">
                                            <a href="{{ route('video.edit', ['channel' => auth()->user()->channel, 'video' => $video->uid]) }}" class="btn btn-light btn-sm">{{ __('Edit') }}</a>
                                            <a wire:click.prevent="delete('{{ $video->uid }}')" class="btn btn-danger btn-sm">{{ __('Delete') }}</a>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <h1>{{ __('No videos uploaded') }}</h1>
                @endif
            </div>
        </div>
        <div class="row justify-content-center align-items-center">
            {{ $videos->links() }}
        </div>
    </div>
</div>
