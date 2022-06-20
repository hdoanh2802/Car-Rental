<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BrandCarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $brand_car = [
            ['name_brand'=>'Chevrolet'],
            ['name_brand'=>'Toyota'],
            ['name_brand'=>'Mazda'],
            ['name_brand'=>'Hyundai'],
            ['name_brand'=>'Inovova'],
            ['name_brand'=>'Ford'],
            ['name_brand'=>'Camry'],
            ['name_brand'=>'Mercede'],
        ];
        DB::table('brand_car')->insert($brand_car);
    }
}
