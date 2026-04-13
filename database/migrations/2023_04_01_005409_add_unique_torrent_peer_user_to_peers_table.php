<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $tableName = 'peers';
        $columnNames = ['torrent', 'peer_id', 'userid'];
        // 1. 获取该表所有的索引信息
        $indexesToDelete = \Nexus\Database\NexusDB::listColumnIndexNames($tableName, $columnNames);

        // 3. 执行删除操作
        Schema::table($tableName, function (Blueprint $table) use ($indexesToDelete) {
            foreach ($indexesToDelete as $indexName) {
                // 如果是主键，需要单独处理
                if ($indexName === 'primary') {
                    $table->dropPrimary();
                } else {
                    $table->dropIndex($indexName);
                }
            }
            $table->unique(['torrent', 'peer_id', 'userid']);
            $table->index('peer_id');
            $table->index('userid');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('peers', function (Blueprint $table) {
            //
        });
    }
};
