<?php

namespace Database\Seeders;

use App\Models\User_Info;
use Illuminate\Database\Seeder;

class UserInfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User_Info::factory()->count(20)->create();
    }
}
