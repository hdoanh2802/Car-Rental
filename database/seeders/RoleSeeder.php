<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = Role::where([
            ['name', 'admin'],
            ['id', 1]
        ])->first();
        $admin = [
            [
                'name' => 'admin',
            ],
            [
                'name' => 'user'
            ]
        ];
        DB::table('roles')->insert($admin);
    }
}
