<?php

namespace App\Enum;

use Illuminate\Validation\Rules\Enum;

class VideoVisibilityEnum extends Enum
{
    public const __DEFAULT = self::PRIVATE;

    public const PRIVATE = 'private';
    public const PUBLIC = 'public';
}
