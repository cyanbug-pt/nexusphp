<?php

declare(strict_types=1);

use Cog\Laravel\Clickhouse\Migration\AbstractClickhouseMigration;

return new class extends AbstractClickhouseMigration
{
    public function up(): void
    {
        $this->clickhouseClient->write(
            <<<SQL
CREATE TABLE bonus_logs
(
    business_type   UInt32,
    uid             UInt64,
    old_total_value Decimal(20,1),
    value           Decimal(20,1),
    new_total_value Decimal(20,1),
    comment         String,
    created_at      DateTime64(6)
)
ENGINE = MergeTree
PARTITION BY toYYYYMMDD(created_at)
ORDER BY (uid, created_at, business_type)
TTL toDateTime(created_at) + INTERVAL 90 DAY
SETTINGS index_granularity = 8192;
SQL
        );
    }

};
