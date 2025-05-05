<?php

namespace App\Support;

/**
 * Trait StaticMake
 */
trait StaticMake
{
    public static function make(): static
    {
        return app(static::class);
    }
}
