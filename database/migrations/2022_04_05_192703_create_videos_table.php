<?php

use App\Enum\VideoVisibilityEnum;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('videos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('channel_id');
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('uid');
            $table->text('path')->nullable();
            $table->string('processed_file')->nullable();
            $table->enum('visibility', [VideoVisibilityEnum::PRIVATE, VideoVisibilityEnum::PUBLIC])->default(VideoVisibilityEnum::PRIVATE);
            $table->boolean('processed')->default(false);
            $table->boolean('allow_likes')->default(false);
            $table->boolean('allow_comments')->default(false);
            $table->unsignedTinyInteger('processing_percentage')->default(0);

            $table->foreign('channel_id')->references('id')->on('channels')->cascadeOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('videos');
    }
};
