<?php

namespace App\Enum;

use Illuminate\Validation\Rules\Enum;

class VideoVisibilityEnum extends Enum
{
    const __DEFAULT = self::PRIVATE;

    const PRIVATE = 'private';
    const PUBLIC = 'public';
}