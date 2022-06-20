<?php

namespace Database\Factories;

use App\Models\Booking;
use App\Models\Car;
use App\Models\Office;
use App\Models\StatusBooking;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */

    protected $model = Booking::class;

    public function definition()
    {
        $carIds = Car::pluck('id')->toArray();
        $officeIds = Office::pluck('id')->toArray();
        $userIds = User::pluck('id')->toArray();
        $status = StatusBooking::where('name_status', 'waiting')->first();

        return [
            'car_id' => $carIds[array_rand($carIds)],
            'user_id' => $userIds[array_rand($userIds)],
            'pick_up_office_id' => $officeIds[array_rand($officeIds)],
            'return_office_id' => $officeIds[array_rand($officeIds)],
            'pick_up_date' => '2022-06-07 11:00:00',
            'return_date' => '2022-06-07 15:00:00',
            'status_id' => $status->id,
            'rental_type' => 'Short-term',
            'total_price' => '5000.00',
        ];
    }
}
