<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\Role_User;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\User_Info;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin_role = Role::where('name', 'admin')->first();

        $start = microtime(true);
        $admin = User::where([
            ['username', 'admin'],
            ['id', 1]
        ])->first();
        $info_admin = User_Info::where([
            ['id', 1],
            ['fullname', 'Hoang Duc Doanh']
        ])->first();

        if ($admin === null) {
            print("Creating Admin Account. Please wait... \n");

            $admin = new User();
            $admin->username = 'admin';
            $admin->email = 'admin@gmail.com';
            $admin->status = User::STATUS_ACTIVATED;
            $admin->password = Hash::make('12345678');
            $admin->is_verified = '1';
            $admin->email_verified_at = now();

            $admin->save();
            $admin->roles()->attach($admin_role);

            if ($info_admin === null) {
                $info_admin = new User_Info();
                $info_admin->fullname = 'Hoang Duc Doanh';
                $info_admin->address = "Ha Noi";
                $info_admin->age = "23";
                $info_admin->phone = "035640074";
                $info_admin->user_id = $admin->id;
                $info_admin->save();
            }
        }

        print("Creating dummy account data. Please wait... \n");
        $user = User::factory(100)->create();
        $user->each(function ($u) {
            $u->userInfo()->save(User_Info::factory()->make());
        });
        $proocessTime = microtime(true) - $start;
        print("Finised: $proocessTime s\n");
    }
}
