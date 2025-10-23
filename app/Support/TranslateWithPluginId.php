<?php

namespace App\Support;

/**
 * Trait StaticMake
 */
trait TranslateWithPluginId
{
    public static function trans($name): string
    {
        return nexus_trans(static::ID . "::{$name}");
    }
}
