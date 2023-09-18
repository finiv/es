<?php

namespace App\Aggregates;

use App\Enums\CarStatus;
use App\ESEvents\CarAdded;
use App\ESEvents\CarRegistered;
use App\ESEvents\CarStatusChanged;
use App\Projections\Car;
use Exception;
use Spatie\EventSourcing\AggregateRoots\AggregateRoot;

class CarAggregate extends AggregateRoot
{
    public function addCar(string $make, string $model): static
    {
        $this->recordThat(new CarAdded($make, $model));

        return $this;
    }

    public function registerCar(Car $car): static
    {
        if ($car->status === CarStatus::NEW->value) {
            $this->recordThat(new CarRegistered());

            return $this;
        }

        throw new Exception('Car can only be registered if it is in "new" status.');
    }

    public function changeStatus(string $status): static
    {
        $this->recordThat(new CarStatusChanged($status));

        return $this;
    }
}
