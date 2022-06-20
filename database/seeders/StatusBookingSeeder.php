<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusBookingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $status_booking = [
            [
                'name_status' => 'waiting',
            ],
            [
                'name_status' => 'processing',
            ],
            [
                'name_status' => 'booked',
            ],
            [
                'name_status' => 'received',
            ],
            [
                'name_status' => 'cancel',
            ],
            [
                'name_status' => 'complete',
            ]
        ];
        DB::table('status_booking')->insert($status_booking);
    }
}
