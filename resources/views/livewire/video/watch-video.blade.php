<div xmlns:livewire="http://www.w3.org/1999/html">
    @push('custom-css')
        <link href="https://vjs.zencdn.net/7.18.1/video-js.css" rel="stylesheet" />
    @endpush
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 p-0">
                <div class="video-container" wire:ignore>
                    <video controls preload="auto" id="yt-video"
                           class="video-js vjs-fill vjs-styles=defaults vjs-big-play-centered"
                           data-setup="{}"
                           poster="{{ secure_asset('videos/' . $video->uid . '/' . $video->thumbnail_image) }}">
                        <source src="{{ secure_asset('videos/' . $video->uid . '/' . $video->processed_file) }}" type="application/x-mpegURL" />
                        <p class="vjs-no-js">
                            To view this video please enable JavaScript, and consider upgrading to a
                            web browser that
                            <a href="https://videojs.com/html5-video-support/" target="_blank"
                            >supports HTML5 video</a
                            >
                        </p>
                    </video>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8 offset-md-2 offset-sm-0">
                <div class="row">
                    <div class="col-md-12">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h3 class="mt-3">{{ $video->title }}</h3>
                                <p class="gray-text">{{ trans_choice('[0,1]:nb view|:nb views', $video->views, ['nb' => $video->views]) }}. {{ $video->uploaded_date }}</p>
                            </div>
                            <div>
                                <livewire:video.voting :video="$video" />
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-12">
                        <livewire:channel.channel-info :channel="$video->channel" />
                    </div>
                </div>
                <hr>

                <h4>{{ trans_choice('[0,1]:nb comment|:nb comments', $video->allCommentsCount(), ['nb' => $video->allCommentsCount()]) }}</h4>
                @auth
                    <div class="my-2">
                        <livewire:comment.new-comment :video="$video" :comId="0" :key="$video->id" />
                    </div>
                @endauth
                <livewire:comment.all-comments :video="$video" />
            </div>
            <div class="col-md-2">
            </div>
        </div>
    </div>
    @push('scripts')
        <script src="https://vjs.zencdn.net/7.18.1/video.min.js"></script>
        <script>
            let player = videojs('yt-video');
            player.on('timeupdate', function () {
                if (this.currentTime() > 3) {
                    this.off('timeupdate');
                    Livewire.emit('VideoViewed');
                }
            });
        </script>
    @endpush
</div>
