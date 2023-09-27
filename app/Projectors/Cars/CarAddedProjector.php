<?php

namespace App\Projectors\Cars;

use App\ESEvents\CarAdded;
use App\Services\Car\CommandService;
use Spatie\EventSourcing\EventHandlers\Projectors\Projector;
use Spatie\EventSourcing\EventHandlers\Projectors\ProjectsEvents;

class CarAddedProjector extends Projector
{
    use ProjectsEvents;

    public function __construct(private readonly CommandService $commandService){}

    public function onCarAdded(CarAdded $event): void
    {
        $this->commandService->addCar($event);
    }
}
