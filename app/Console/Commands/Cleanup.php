<?php

namespace App\Console\Commands;

use App\Jobs\CalculateUserSeedBonus;
use App\Jobs\UpdateTorrentSeedersEtc;
use App\Jobs\UpdateUserSeedingLeechingTime;
use Illuminate\Console\Command;
use Illuminate\Contracts\Queue\ShouldQueue;

class Cleanup extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cleanup {--action=} {--begin_id=} {--id_str=} {--end_id=} {--request_id=} {--delay=} {--id_redis_key=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cleanup async job trigger, options: --begin_id, --end_id, --id_str, --request_id, --delay, --id_redis_key,--action (seed_bonus, seeding_leeching_time, seeders_etc)';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $action = $this->option('action');
        $beginId = $this->option('begin_id');
        $endId = $this->option('end_id');
        $idStr = $this->option('id_str') ?: "";
        $idRedisKey = $this->option('id_redis_key') ?: "";
        $commentRequestId = $this->option('request_id');
        $delay = intval($this->option('delay') ?: 0);
        $this->info("beginId: $beginId, endId: $endId, idStr: $idStr, idRedisKey: $idRedisKey, commentRequestId: $commentRequestId, delay: $delay, action: $action");
        if ($action == 'seed_bonus') {
            $this->dispatchCleanupJob(new CalculateUserSeedBonus($beginId, $endId, $idStr, $idRedisKey, $commentRequestId), $delay, $commentRequestId, $action);
        } elseif ($action == 'seeding_leeching_time') {
            $this->dispatchCleanupJob(new UpdateUserSeedingLeechingTime($beginId, $endId, $idStr, $idRedisKey, $commentRequestId), $delay, $commentRequestId, $action);
        }elseif ($action == 'seeders_etc') {
            $this->dispatchCleanupJob(new UpdateTorrentSeedersEtc($beginId, $endId, $idStr, $idRedisKey, $commentRequestId), $delay, $commentRequestId, $action);
        } else {
            $msg = "[$commentRequestId], Invalid action: $action";
            do_log($msg, 'error');
            $this->error($msg);
        }
        return Command::SUCCESS;
    }

    private function dispatchCleanupJob(ShouldQueue $job, int $delay, string $requestId, string $action): void
    {
        $forceSync = filter_var(env('CLEANUP_FORCE_SYNC_QUEUE', false), FILTER_VALIDATE_BOOLEAN);
        if (config('queue.default') === 'sync' || $forceSync) {
            do_log("[$requestId], cleanup action: $action run synchronously, queue.default: " . config('queue.default') . ", forceSync: " . var_export($forceSync, true));
            $job->handle();
            return;
        }

        try {
            dispatch($job)->delay($delay);
            do_log("[$requestId], cleanup action: $action dispatched to queue, delay: $delay, queue.default: " . config('queue.default'));
        } catch (\Throwable $throwable) {
            do_log("[$requestId], cleanup action: $action dispatch failed, fallback to sync handle, error: " . $throwable->getMessage() . $throwable->getTraceAsString(), 'error');
            $job->handle();
        }
    }
}
