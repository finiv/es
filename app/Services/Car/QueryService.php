<?php

namespace App\Services\Car;

use App\Projections\Car;
use Illuminate\Database\Eloquent\Collection;

class QueryService
{
    public function query(): Collection|array
    {
        return Car::query()->get();
    }

    public function find(int $id): ?Car
    {
        return Car::where('id', $id)->first();
    }

    public function findCarsByModel(string $model): Collection
    {
        return Car::where('model', $model)->get();
    }

    public function findCarsByStatus(string $status): Collection
    {
        return Car::where('status', $status)->get();
    }

    public function findCarsByModelsAndStatuses(array $models, array $statuses): Collection
    {
        return Car::whereIn('model', $models)
            ->whereIn('status', $statuses)
            ->get();
    }
}
