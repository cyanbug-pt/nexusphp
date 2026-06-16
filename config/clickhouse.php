<?php

/*
 * This file is part of Laravel ClickHouse.
 *
 * (c) Anton Komarev <anton@komarev.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

return [

    /*
    |--------------------------------------------------------------------------
    | ClickHouse Client Configuration
    |--------------------------------------------------------------------------
    |
    | Here you can configure a connection to connect to the ClickHouse
    | database and specify additional configuration options.
    |
    */

    'connection' => [
        'host' => nexus_env('CLICKHOUSE_HOST', 'localhost'),
        'port' => nexus_env('CLICKHOUSE_HTTP_PORT', 8123),
        'username' => nexus_env('CLICKHOUSE_USER', 'default'),
        'password' => nexus_env('CLICKHOUSE_PASSWORD', ''),
        'options' => [
            'database' => nexus_env('CLICKHOUSE_DATABASE', 'default'),
            'timeout' => 1,
            'connectTimeOut' => 2,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | ClickHouse Migration Settings
    |--------------------------------------------------------------------------
    */

    'migrations' => [
        'table' => nexus_env('CLICKHOUSE_MIGRATION_TABLE', 'migrations'),
        'path' => __DIR__ . '/../database/clickhouse-migrations',
    ],
];
