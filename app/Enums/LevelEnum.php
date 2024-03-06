<?php
namespace App\Enums;

use Illuminate\Support\Collection;
use Route;

enum LevelEnum: string
{

    case BEGINNER = 'beginner';

    case INTERMEDIATE = 'intermediate';

    case ADVANCED = 'advanced';

    public static function values(): Collection
    {
        return collect(self::cases())->pluck('value');
    }

    public static function durations(): Collection
    {
        $durations = collect([]);
        self::values()->reverse()->values()->each(function ($value, $key) use (&$durations) {
            $durations[$value] = ($key + 1) * 2; // Minutes
        });
        return $durations;
    }
}