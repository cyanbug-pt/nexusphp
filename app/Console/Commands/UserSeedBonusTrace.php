<?php

namespace App\Console\Commands;

use App\Repositories\CleanupRepository;
use Illuminate\Console\Command;

class UserSeedBonusTrace extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:seed-bonus-trace {uid : User ID}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Show latest announce, cleanup batch record and seed bonus job trace for a user.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): int
    {
        $uid = (int)$this->argument('uid');
        if ($uid <= 0) {
            $this->error('uid must be a positive integer.');
            return self::FAILURE;
        }

        $trace = CleanupRepository::getUserSeedBonusTrace($uid);
        if (empty($trace)) {
            $this->warn("No seed bonus trace found for user ID: $uid");
            $this->line('Trace is stored for the latest 24 hours after announce/batch/job activity.');
            return self::SUCCESS;
        }

        $this->info("Latest seed bonus trace for user ID: $uid");
        $this->line(json_encode($trace, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
        return self::SUCCESS;
    }
}
