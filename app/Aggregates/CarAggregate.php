<?php

namespace App\Aggregates;

use App\Enums\CarStatus;
use App\ESEvents\CarAdded;
use App\ESEvents\CarRegistered;
use App\ESEvents\CarStatusChanged;
use App\ESEvents\CarUpdated;
use App\Projections\Car;
use Exception;
use Spatie\EventSourcing\AggregateRoots\AggregateRoot;

class CarAggregate extends AggregateRoot
{
    public function addCar(array $params): static
    {
        if (array_key_exists('make', $params) && array_key_exists('model', $params)) {
            $this->recordThat(new CarAdded($params['make'], $params['model']));
        }

        return $this;
    }

    public function registerCar(Car $car): static
    {
        if ($car->status === CarStatus::NEW->value) {
            $this->recordThat(new CarRegistered());
        }

        return $this;
    }

    public function update(array $params): static
    {
        $this->recordThat(new CarUpdated($params['make'] ?? null, $params['model'] ?? null));

        if (array_key_exists('status', $params)) {
            $this->changeStatus($params['status']);
        }

        return $this;
    }

    public function changeStatus(string $status): static
    {
        $this->recordThat(new CarStatusChanged($status));

        return $this;
    }
}
