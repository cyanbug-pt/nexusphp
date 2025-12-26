<?php

namespace App\Jobs;

use App\Repositories\ClaimRepository;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class SettleClaim implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(public int $userId)
    {

    }

    public $timeout = 600;

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $userId = $this->userId;
        $logMsg = "userId: $userId";
        $rep = new ClaimRepository();
        $result = $rep->settleUser($userId, false, false, true);
        do_log("$logMsg, result: " . var_export($result, true));
    }
}
