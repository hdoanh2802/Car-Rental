<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\User_Info;
use Illuminate\Database\Eloquent\Factories\Factory;

class User_InfoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = User_Info::class;

    public function definition()
    {
   
        return [
            'fullname' => $this->faker->name(),
            'address' => $this->faker->address(),
            'age' => rand(18, 50),
            'phone' => $this->faker->phoneNumber(),
        ];
    }
}



