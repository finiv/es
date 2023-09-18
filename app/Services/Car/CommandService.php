<?php

namespace App\Services\Car;

use App\Enums\CarStatus;
use App\ESEvents\CarAdded;
use App\ESEvents\CarRegistered;
use App\ESEvents\CarStatusChanged;
use App\Models\CarEvent;
use App\Projections\Car;
use Illuminate\Support\Str;

class CommandService
{
    public function registerCarAddedEvent(CarAdded $event): void
    {
        CarEvent::create([
            'car_id' => $event->storedEventId(),
            'event_class' => CarAdded::class,
            'event_properties' => json_encode([
                'make' => $event->getMake(),
                'model' => $event->getModel(),
                'uuid' => $event->aggregateRootUuid(),
            ], JSON_THROW_ON_ERROR),
        ]);
    }

    public function registerCarRegisteredEvent(Car $car, CarRegistered $event): void
    {
        CarEvent::create([
            'car_id' => $car->id,
            'event_class' => CarRegistered::class,
            'event_properties' => json_encode([]),
        ]);
    }

    public function registerCarStatusChangedEvent(CarStatusChanged $event): void
    {
        CarEvent::create([
            'car_id' => $event->aggregateRootUuid(),
            'event_class' => CarStatusChanged::class,
            'event_properties' => json_encode([
                'status' => $event->getStatus(),
            ], JSON_THROW_ON_ERROR),
        ]);
    }

    public function addCar(CarAdded $event)
    {
        $car = new Car([
            'uuid' => $event->aggregateRootUuid(),
            'model' => $event->getModel(),
            'make' => $event->getMake(),
            'status' => CarStatus::NEW->value,
        ]);

        $car->writeable()->save();

        $this->registerCarAddedEvent($event);

    }
}
