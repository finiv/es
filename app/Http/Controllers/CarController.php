<?php

namespace App\Http\Controllers;

use App\Aggregates\CarAggregate;
use App\Enums\CarStatus;
use App\Http\Requests\CarStoreRequest;
use App\Http\Requests\CarUpdateRequest;
use App\Projections\Car;
use App\Services\Car\QueryService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

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
        $carUuid = Str::uuid();

        $car = CarAggregate::retrieve($carUuid);
        $car->addCar($request->make, $request->model);

        $car->persist();

        return response()->json(['message' => 'Car created'], 201);
    }

    public function update(CarUpdateRequest $request, int $id): JsonResponse
    {
        $car = $this->queryService->find($id);

        if (!$car) {
            return response()->json(['message' => 'Car not found'], 404);
        }

        CarAggregate::retrieve($id)->update($request->all())->persist();

        return response()->json($car, 200);
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
