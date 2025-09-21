<?php

namespace App\Exceptions;

class LockFailException extends NexusException
{
    public function __construct(protected string $lockName, protected string $lockOwner)
    {
        parent::__construct();
    }

    public function getLockName(): string
    {
        return $this->lockName;
    }
    public function getLockOwner(): string
    {
        return $this->lockOwner;
    }
}
