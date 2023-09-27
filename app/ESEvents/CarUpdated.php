<?php

namespace App\ESEvents;

use Spatie\EventSourcing\StoredEvents\ShouldBeStored;

class CarUpdated extends ShouldBeStored
{
    public string $make;
    public string $model;
    public function __construct(?string $make, ?string $model)
    {
        $this->model = $model;
        $this->make = $make;
    }

    public function getMake(): string
    {
        return $this->make;
    }

    public function getModel(): string
    {
        return $this->model;
    }
}
