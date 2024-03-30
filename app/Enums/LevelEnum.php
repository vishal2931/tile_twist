<?php

namespace App\Enums;

use Illuminate\Support\Collection;

enum LevelEnum: string
{
    case BEGINNER = 'beginner';

    case INTERMEDIATE = 'intermediate';

    case ADVANCED = 'advanced';

    public static function values(): Collection
    {
        return collect(self::cases())->pluck('value');
    }

    public static function steps(): Collection
    {
        return collect([
            self::ADVANCED->value => 30,
            self::INTERMEDIATE->value => 40,
            self::BEGINNER->value => 50,
        ]);
    }
}
