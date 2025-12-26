<?php

namespace App\Exceptions;

class SeedBoxYesException extends NexusException
{
    private int $id;

    public function __construct($id)
    {
        parent::__construct();
        $this->id = $id;
    }

    public function getId(): int
    {
        return $this->id;
    }
}

