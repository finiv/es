<?php

namespace Database\Factories;

use App\Enums\CarStatus;
use App\Models\Model;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Model>
 */
class CarFactory extends Factory
{
    public const CARS_BRANDS = ['Mercedes', 'BMW', 'Audi', 'Toyota', 'Opel', 'VolksWagen', 'Fiat'];

    public const CARS_MODELS = ['Gtx', 'X5', 'Mokka', 'B3', 'M7', 'L33'];
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'uuid' => Str::random(20),
            'make' => self::CARS_BRANDS[array_rand(self::CARS_BRANDS)],
            'model' => self::CARS_MODELS[array_rand(self::CARS_MODELS)],
            'status' => CarStatus::NEW->value,
        ];
    }
}
