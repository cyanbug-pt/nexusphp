<?php

namespace Nexus\Imdb;

function parse_imdb_id($value): int
{
    return preg_match('/(?:tt)?(\d+)/', (string) $value, $matches) ? (int) $matches[1] : 0;
}

function do_log($message, $level = 'info'): void
{
    \Tests\Unit\ImdbTestLog::$entries[] = [$level, $message];
}
