<?php

namespace App\Models;

use App\Enum\VideoVisibilityEnum;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Video extends Model
{
    use HasFactory;

    /** @var array */
    protected $guarded = [];

    /**
     * @return string
     */
    public function getRouteKeyName(): string
    {
        return 'uid';
    }

    /**
     * @return string
     */
    public function getThumbnailAttribute(): ?string
    {
        if (null !== $this->thumbnail_image) {
            return sprintf('/videos/%s/%s', $this->uid, $this->thumbnail_image);
        }

        return '/videos/default.jpg';
    }

    /**
     * @return string
     */
    public function getUploadedDateAttribute(): string
    {
        $d = new Carbon($this->created_at);

        return $d->toFormattedDateString();
    }

    /**
     * @return BelongsTo
     */
    public function channel(): BelongsTo
    {
        return $this->belongsTo(Channel::class);
    }

    /**
     * @return HasMany
     */
    public function likes(): HasMany
    {
        return $this->hasMany(Like::class);
    }

    /**
     * @return HasMany
     */
    public function dislikes(): HasMany
    {
        return $this->hasMany(Dislike::class);
    }

    /**
     * @return bool
     */
    public function doesUserLikedVideo(): bool
    {
        return $this->likes()->where('user_id', auth()->id())->exists();
    }

    /**
     * @return bool
     */
    public function doesUserDislikedVideo(): bool
    {
        return $this->dislikes()->where('user_id', auth()->id())->exists();
    }
}
