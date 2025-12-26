<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $tableFields = \App\Repositories\UpgradeRepository::DATETIME_INVALID_VALUE_FIELDS;

        foreach ($tableFields as $table => $fields) {
            $columnInfo = \Nexus\Database\NexusDB::getMysqlColumnInfo($table);
            foreach ($fields as $field) {
                if (isset($columnInfo[$field]) && $columnInfo[$field]['DATA_TYPE'] == 'datetime') {
                    \Illuminate\Support\Facades\DB::statement("update $table set $field = null where $field = '0000-00-00 00:00:00'");
                }
            }
        }
        $columnInfo = \Nexus\Database\NexusDB::getMysqlColumnInfo("snatched");
        if (isset($columnInfo["finish_ip"])) {
            \Illuminate\Support\Facades\DB::statement("alter table snatched drop column finish_ip");
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
