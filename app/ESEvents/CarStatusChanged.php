<?php

namespace App\ESEvents;

use Spatie\EventSourcing\StoredEvents\ShouldBeStored;

class CarStatusChanged extends ShouldBeStored
{
    public $status;

    public function __construct(string $status)
    {
        $this->status = $status;
    }

    public function getStatus(): string
    {
        return $this->status;
    }
}
