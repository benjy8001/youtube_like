<h1 align='center'>
  YouTube Like 👨‍💻
</h1>

<p align='center'>
  A PHP project in order to upload videos, processing and playing them.
</p>

---
- Real time video upload progress and convertion thanks to Livewire
- Jobs for converting and generate video thumbnail
- Ability to search and like or dislike video, subscribe to a video channel
- Video commentary and reply
---
<details>
    <summary>📃 Commands history</summary>

        source .autoaliases.sh
        composer create-project laravel/laravel --prefer-dist .
        composer require laravel/ui
        artisan ui bootstrap --auth
        npm install
        npm run --cache .npm/cache dev
        composer require livewire/livewire
        artisan livewire:publish --config
        artisan make:livewire Channel\\EditChannel
        artisan make:policy ChannelPolicy
        composer require intervention/image
        artisan vendor:publish --provider="Intervention\Image\ImageServiceProviderLaravelRecent"
        artisan storage:link
        artisan make:modle Video -mc
        artisan queue:table
        artisan make:livewire Video/CreateVideo
        artisan vendor:publish --provider="ProtoneMedia\LaravelFFMpeg\Support\ServiceProvider"
        artisan make:job CreateThumbnailFromVideo
        artisan make:job ConvertVideoForStreaming
        artisan queue:work --tries=3

</details>
---
