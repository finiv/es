<?php

namespace App\ESEvents;

use Spatie\EventSourcing\StoredEvents\ShouldBeStored;

class CarAdded extends ShouldBeStored
{
    public function __construct(private string $make, private string $model){}

    public function getMake(): string
    {
        return $this->make;
    }

    public function getModel(): string
    {
        return $this->model;
    }
}
