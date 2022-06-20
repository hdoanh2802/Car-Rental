<?php

namespace Database\Factories;

use App\Models\Car;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Office;
use App\Models\Car_Type;

class CarFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = Car::class;

    public function definition()
    {
        $car_typeIds = Car_Type::pluck('id')->toArray();
        $officeIds = Office::pluck('id')->toArray();
        return [
            'type_id' => $car_typeIds[array_rand($car_typeIds)],
            'office_id' => $officeIds[array_rand($officeIds)],
            'name' => $this->faker->name(),
            'color' => $this->faker->colorName(),
            'brand' => $this->faker->text(),
            'description' => $this->faker->text(),
            'purch_date' => $this->faker->date()
        ];
    }
}
