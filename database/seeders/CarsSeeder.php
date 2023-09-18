<?php

namespace Database\Seeders;

use App\Projections\Car;
use Database\Factories\CarFactory;
use Illuminate\Database\Seeder;

class CarsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CarFactory::factoryForModel(Car::class)->count(25)->create();
    }
}
