<div>
    @push('custom-css')
        <link href="https://vjs.zencdn.net/7.18.1/video-js.css" rel="stylesheet" />
    @endpush
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="video-container">
                    <video controls preload="auto" id="yt-video" class="video-js vjs-fill vjs-styles=defaults vjs-big-play-centered" data-setup="{}" wire:ignore>
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
