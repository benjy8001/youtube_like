@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row my-4">
            @foreach($videos as $video)
                <div class="col-12">
                    <a href="{{ route('video.watch', $video) }}" class="card-link">
                        <div class="card mb-4" style="border:none;">
                            <div class="card-horizontal">
                                <div>
                                    <img class="" src="{{ secure_asset( $video->thumbnail) }}" alt="{{ __('Card image cap') }}"
                                         style="height: 100%; width:333px">
                                </div>
                                <div class="card-body">
                                    <h4>{{ $video->title }}</h4>
                                    <p class="text-gray font-weight-bold">{{ $video->views }} {{ __('views') }} •
                                        {{ $video->created_at->diffForHumans() }}</p>
                                    <div class="d-flex align-items-center">
                                        <img src="{{ secure_asset($video->channel->picture) }}" class="rounded circle">
                                        <p class="text-gray font-weight-bold ms-3">
                                            {{ $video->channel->name }}
                                        </p>
                                    </div>
                                    <p class="text-truncate">
                                        {{ $video->description }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
@endsection
