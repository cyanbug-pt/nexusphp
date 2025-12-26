<?php

namespace App\Console\Commands\Upgrade;

use Illuminate\Console\Command;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MigrateUsersTableCommentRelatedColumn extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'upgrade:migrate_users_table_comment_related_column';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Migrate users table comment related column';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'modcomment')) {
                $table->dropColumn('modcomment');
            }
            if (Schema::hasColumn('users', 'bonuscomment')) {
                $table->dropColumn('bonuscomment');
            }
        });
    }
}
