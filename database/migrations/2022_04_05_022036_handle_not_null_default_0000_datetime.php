<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $tableFields = \App\Repositories\UpgradeRepository::DATETIME_INVALID_VALUE_FIELDS;

        foreach ($tableFields as $table => $fields) {
            $columnInfo = \Nexus\Database\NexusDB::getMysqlColumnInfo($table);
            $modifies = [];
            foreach ($fields as $field) {
                if (isset($columnInfo[$field]) && $columnInfo[$field]['COLUMN_DEFAULT'] == '0000-00-00 00:00:00') {
                    $modifies[] = sprintf('modify `%s` datetime default null', $field);
                }
            }
            if (!empty($modifies)) {
                $sql = sprintf("alter table `%s` %s", $table, implode(', ', $modifies));
                \Illuminate\Support\Facades\DB::statement($sql);
            }
        }

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
