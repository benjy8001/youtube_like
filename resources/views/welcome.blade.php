@extends('layouts.app')

@section('content')
    <div class="container">

        <form action="{{ route('search.video') }}" method="POST">
            @csrf
            <div class="d-flex align-items-center my-3">
                <input type="text" name="query" id="query" class="form-control" placeholder="{{ __('Search') }}">
                <button type="submit" class="search-btn"><i class="material-icons">search</i></button>
            </div>
        </form>

        <div class="row my-3">
            @if(empty($channels->count()))
                <p>{{ __('$You are not subscribed to any channel !') }}</p>
            @endif

            @foreach($channels as $channelVideos)
                @foreach($channelVideos as $video)
                    <div class="col-12 col-md-6 col-lg-4">
                        <a href="{{ route('video.watch', $video) }}" class="card-link">
                            <div class="card mb-4" style="width: 333px; border:none;">
                                <img class="card-img-top" src="{{ secure_asset( $video->thumbnail) }}" alt="{{ __('Card image cap') }}"
                                     style="height: 174px; width:333px">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <img src="{{ secure_asset($video->channel->picture) }}" height="40px"
                                             class="rounded circle">

                                        <h4 class="ms-3">{{ $video->title }}</h4>

                                    </div>
                                    <p class="text-gray mt-4 font-weight-bold" style="line-height: 0.2px">
                                        {{ $video->channel->name}}
                                    </p>
                                    <p class="text-gray font-weight-bold" style="line-height: 0.2px">{{ $video->views }} {{ __('views') }} •
                                        {{ $video->created_at->diffForHumans() }}</p>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            @endforeach
        </div>
    </div>
@endsection
