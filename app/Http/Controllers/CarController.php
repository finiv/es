<?php

namespace App\Http\Controllers;

use App\Aggregates\CarAggregate;
use App\ESEvents\CarAdded;
use App\Http\Requests\CarStoreRequest;
use App\Projections\Car;
use App\Services\Car\CommandService;
use App\Services\Car\QueryService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CarController extends Controller
{
    public function __construct(private readonly QueryService $queryService, private readonly CommandService $commandService){}

    public function index(): JsonResponse
    {
        return response()->json($this->queryService->query());
    }

    public function show($id): JsonResponse
    {
        return response()->json($this->queryService->findCarsById($id));
    }

    public function store(CarStoreRequest $request): JsonResponse
    {
        $carUuid = Str::uuid();

        $car = CarAggregate::retrieve($carUuid);
        $car->addCar($request->make, $request->model);

        $car->persist();

        return response()->json(['message' => 'Car created'], 201);
    }

    public function update(Request $request, int $id): JsonResponse
    {
        $car = $this->queryService->findCarsById($id);

        if (!$car) {
            return response()->json(['message' => 'Car not found'], 404);
        }

        $status = $request->status;

        if ($status) {
            CarAggregate::retrieve($id)->changeStatus($status)->persist();
        }


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
