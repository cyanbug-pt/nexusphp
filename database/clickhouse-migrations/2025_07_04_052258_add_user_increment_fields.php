<?php

declare(strict_types=1);

use Cog\Laravel\Clickhouse\Migration\AbstractClickhouseMigration;

return new class extends AbstractClickhouseMigration
{
    public function up(): void
    {
        $this->clickhouseClient->write(
            <<<SQL
ALTER TABLE announce_logs
ADD COLUMN promotion_state   UInt8 after info_hash,
ADD COLUMN promotion_state_desc   LowCardinality(String) after promotion_state,
ADD COLUMN up_factor   Float64 after promotion_state_desc,
ADD COLUMN up_factor_desc   String after up_factor,
ADD COLUMN down_factor   Float64 after up_factor_desc,
ADD COLUMN down_factor_desc   String after down_factor,
ADD COLUMN uploaded_total_last   Float64 after peer_id,
ADD COLUMN uploaded_increment_for_user   Float64 after uploaded_increment,
ADD COLUMN downloaded_total_last   Float64 after uploaded_increment_for_user,
ADD COLUMN downloaded_increment_for_user   Float64 after downloaded_increment,
ADD COLUMN speed   Float64 after announce_time,
ADD COLUMN batch_no   String after request_id;
SQL
        );
    }
};
