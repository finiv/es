<?php

namespace App\Projectors\Cars;

use App\ESEvents\CarStatusChanged;
use App\Services\Car\CommandService;
use Spatie\EventSourcing\EventHandlers\Projectors\Projector;
use Spatie\EventSourcing\EventHandlers\Projectors\ProjectsEvents;

class ChangeCarStatusProjector extends Projector
{
    use ProjectsEvents;

    public function __construct(private readonly CommandService $commandService){}

    public function onCarStatusChanged(CarStatusChanged $event): void
    {
        $this->commandService->changeStatus($event);
    }
}
