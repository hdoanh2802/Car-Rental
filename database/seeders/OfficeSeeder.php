<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class OfficeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $office = [
            [
                'name' => 'basis 1',
                'address' => 'Ha Noi',
            ],
            [
                'name' => 'basis 2',
                'address' => 'Vinh Phuc',
            ]
        ];
        DB::table('office')->insert($office);
    }
}
