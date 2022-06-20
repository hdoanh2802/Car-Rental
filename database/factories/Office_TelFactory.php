<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Office_Tel;
use App\Models\Office;

class Office_TelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = Office_Tel::class;

    public function definition()
    {
        $officeIds = Office::pluck('id')->toArray();
        return [
            'office_id' => $officeIds[array_rand($officeIds)],
            'phone' => $this->faker->phoneNumber()
        ];
    }
}
