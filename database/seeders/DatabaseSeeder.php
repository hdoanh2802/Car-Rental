<?php

namespace Database\Seeders;

use App\Models\Booking;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([UserSeeder::class]);
        $this->call([Role::class]);
        $this->call([Role_UserSeeder::class]);
        $this->call([CarTypeSeeder::class]);
        $this->call([OfficeSeeder::class]);
        $this->call([OfficeTelSeeder::class]);
        $this->call([CarSeeder::class]);
        $this->call([UserInfoSeeder::class]);
        $this->call([Booking::class]);
        $this->call([StatusBookingSeeder::class]);
        $this->call([BrandCarSeeder::class]);
    }
}
