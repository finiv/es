<?php

namespace App\Projectors\Cars;

use App\ESEvents\CarUpdated;
use App\Services\Car\CommandService;
use JsonException;
use Spatie\EventSourcing\EventHandlers\Projectors\Projector;
use Spatie\EventSourcing\EventHandlers\Projectors\ProjectsEvents;

class CarUpdatedProjector extends Projector
{
    use ProjectsEvents;

    public function __construct(private readonly CommandService $commandService){}

    /**
     * @throws JsonException
     */
    public function onUpdate(CarUpdated $event): void
    {
        $this->commandService->registerCarUpdatedEvent($event);
    }
}
