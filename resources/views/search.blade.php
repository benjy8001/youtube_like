@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row my-4">
            @if($videos->count())
                @foreach($videos as $video)
                    <div class="col-12">
                        <a href="{{ route('video.watch', ['locale' => app()->getLocale(), 'video' => $video]) }}" class="card-link">
                            <div class="card mb-4" style="border:none;">
                                <div class="card-horizontal">
                                    <div style="width: 333px;">
                                        @include('includes.videoThumbnail')
                                    </div>
                                    <div class="card-body">
                                        <h4>{{ $video->title }}</h4>
                                        <p class="text-gray font-weight-bold">{{ trans_choice('[0,1]:nb view|:nb views', $video->views, ['nb' => $video->views]) }} •
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
            @else
                <h1>{{ __('No result') }}</h1>
            @endif
        </div>
    </div>
@endsection
