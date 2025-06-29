<?php

declare(strict_types=1);

use Cog\Laravel\Clickhouse\Migration\AbstractClickhouseMigration;

return new class extends AbstractClickhouseMigration
{
    public function up(): void
    {
        $this->clickhouseClient->write(
            <<<SQL
CREATE TABLE announce_logs
(
    timestamp         DateTime64(6),
    user_id           UInt32,
    passkey           String,
    torrent_id        UInt32,
    torrent_size      UInt64,
    info_hash         FixedString(20),
    event             LowCardinality(String),
    peer_id           String,
    uploaded_total    Float64,
    uploaded_offset   Float64,
    uploaded_increment Float64,
    downloaded_total    Float64,
    downloaded_offset   Float64,
    downloaded_increment Float64,
    announce_time        UInt32,
    ip               String,
    ipv4             String,
    ipv6             String,
    port             UInt16,
    agent            LowCardinality(String),
    left             UInt64,
    started          Nullable(DateTime),
    prev_action      Nullable(DateTime),
    last_action      Nullable(DateTime),
    client_select    UInt32,
    seeder_count     UInt32,
    leecher_count    UInt32,
    scheme           LowCardinality(String),
    host             LowCardinality(String),
    path             LowCardinality(String),
    continent        LowCardinality(String),
    country          LowCardinality(String),
    city             LowCardinality(String),
    request_id       String
)
ENGINE = MergeTree
PARTITION BY toYYYYMMDD(timestamp)
ORDER BY (user_id, torrent_id, peer_id, timestamp)
TTL toDateTime(timestamp) + INTERVAL 90 DAY
SETTINGS index_granularity = 8192;
SQL
        );
    }
};
