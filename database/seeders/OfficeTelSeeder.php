<?php

namespace Database\Seeders;

use App\Models\Office_Tel;
use Illuminate\Database\Seeder;

class OfficeTelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Office_Tel::factory()->count(5)->create();
    }
}
