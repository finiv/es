<?php

namespace App\ESEvents;

use Spatie\EventSourcing\StoredEvents\ShouldBeStored;

class CarUpdated extends ShouldBeStored
{
    public string|null $make;
    public string|null $model;

    public function __construct(?string $make, ?string $model)
    {
        $this->model = $model;
        $this->make = $make;
    }

    public function getMake(): string|null
    {
        return $this->make;
    }

    public function getModel(): string|null
    {
        return $this->model;
    }

    public function getAttributes(): array
    {
        return [
            'make' => $this->make,
            'model' => $this->model,
        ];
    }

    public function getActiveAttributes(): array
    {
        $data = [];

        foreach ($this->getAttributes() as $key => $attribute){
            if ($attribute) {
                $data[$key] = $attribute;
            }
        }

        return $data;
    }
}
