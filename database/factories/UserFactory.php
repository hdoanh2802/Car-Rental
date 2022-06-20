<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Role;
use App\Models\User_Info;
use Illuminate\Support\Facades\Hash;
use Faker\Generator as Faker;

class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * 
     * @return array
     */
    protected $model = User::class;

    public function definition()
    {
        $password = Hash::make('12345678');
        return [
            'username' => $this->faker->userName(),
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' =>  $password,
            'status' => User::STATUS_ACTIVATED,
            'is_verified' => User::VERIFIED,
        ];

    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
    public function configure()
    {

        return $this->afterCreating(function ($user, $faker) {
            $user_role = Role::where('name', 'user')->first();
            $user->roles()->attach($user_role);
        });
    }
}
