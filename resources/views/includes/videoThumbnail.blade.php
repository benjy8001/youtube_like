<div style="position: relative;">
    <img class="card-img-top" src="{{ secure_asset( $video->thumbnail) }}" alt="{{ __('Card image cap') }}"
         style="height: 174px; width:333px;">
    <div class="badge bg-dark" style="position: absolute; bottom: 8px; right: 16px;"> {{ $video->durationForHumans }}</div>
</div>
