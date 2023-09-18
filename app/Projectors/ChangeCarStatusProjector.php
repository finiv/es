<?php

namespace App\Projectors;

use App\ESEvents\CarStatusChanged;
use App\Projections\Car;
use App\Services\Car\CommandService;
use Spatie\EventSourcing\EventHandlers\Projectors\Projector;
use Spatie\EventSourcing\EventHandlers\Projectors\ProjectsEvents;

class ChangeCarStatusProjector extends Projector
{
    use ProjectsEvents;

    public function onCarStatusChanged(CarStatusChanged $event): void
    {
        $car = Car::where('id', $event->aggregateRootUuid())->first();

        $car->status = $event->status;

        $car->writeable()->save();

        app(CommandService::class)->registerCarStatusChangedEvent($event);
    }
}
