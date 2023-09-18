<?php

namespace App\Services\Car;

use App\Projections\Car;

class QueryService
{
    public function query()
    {
        return Car::query()->get();
    }

    public function findCarsById(int $id)
    {
        return Car::where('id', $id)->first();
    }

    public function findCarsByModel(string $model)
    {
        return Car::where('model', $model)->get();
    }

    public function findCarsByStatus(string $status)
    {
        return Car::where('status', $status)->get();
    }

    public function findCarsByModelsAndStatuses(array $models, array $statuses)
    {
        return Car::whereIn('model', $models)
            ->whereIn('status', $statuses)
            ->get();
    }
}
