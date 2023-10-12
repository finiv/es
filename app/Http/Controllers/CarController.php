<?php

namespace App\Http\Controllers;

use App\Aggregates\CarAggregate;
use App\Http\Requests\CarStoreRequest;
use App\Http\Requests\CarUpdateRequest;
use App\Projections\Car;
use App\Services\AggregateService;
use App\Services\Car\QueryService;
use Illuminate\Http\JsonResponse;

class CarController extends Controller
{
    public function __construct(private readonly QueryService $queryService){}

    public function index(): JsonResponse
    {
        return response()->json($this->queryService->query());
    }

    public function show($id): JsonResponse
    {
        return response()->json($this->queryService->find($id));
    }

    public function store(CarStoreRequest $request): JsonResponse
    {
        app(AggregateService::class)
            ->store(
                resolve(CarAggregate::class),
                ['make' => $request->make, 'model' => $request->model],
                'addCar'
            );

        return response()->json(['message' => 'Car created'], 201);
    }

    public function update(CarUpdateRequest $request, int $id): JsonResponse
    {
        $car = $this->queryService->find($id);

        if (!$car) {
            return response()->json(['message' => 'Car not found'], 404);
        }

        app(AggregateService::class)->update(
            resolve(CarAggregate::class),
            $request->all(),
            $car->id
        );

        return response()->json($car);
    }

    public function destroy($id): JsonResponse
    {
        $car = Car::find($id);

        if (!$car) {
            return response()->json(['message' => 'Car not found'], 404);
        }

        $car->delete();

        return response()->json(null, 204);
    }
}
