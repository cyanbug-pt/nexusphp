<?php

namespace App\Jobs;

use App\Repositories\UserRepository;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class UpdateUserDownloadPrivilege implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(public int $userId, public string $status, public string $reasonKey)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $rep = new UserRepository();
        $rep->updateDownloadPrivileges(null, $this->userId, $this->status, $this->reasonKey);
        do_log("Updating user download privilege for user {$this->userId} to {$this->status} by reason {$this->reasonKey}");
    }
}
