<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class CarTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $car_type = [
            [
                'label' => 'Vip',
                'description' => 'Thuê xe đi City Tour, Thuê xe đi Sự kiện, Hội nghị,Thuê xe đi gặp đối tác khách hàng',
            ],
            [
                'label' => '4 seat',
                'description' => 'Thích hợp sử dụng để đưa đón sân bay, thuê xe cá nhân phục vụ nhu cầu đi lại hàng ngày như đi du lịch,..',
            ],
            [
                'label' => '5 seat',
                'description' => 'Những chiếc bán tải đủ 5 chỗ ngồi, có thể dùng để đi du lịch, chở hàng, đi dã ngoại cuối tuần, đi phượt những cung đường đồi núi,... ',
            ],
            [
                'label' => '7 seat',
                'description' => 'Xe 7 chỗ 2 cầu lại là sự lựa chọn hoàn hảo cho những chuyến du lịch gia đình từ đi Đưa đón sân bay,  City Tour,..',
            ],
            [
                'label' => '16 seat',
                'description' => 'Dưa đón công nhân viên, đưa đón học sinh, du lịch, dã ngoại, thuê xe 16 chỗ đi sân bay, đi City tour, đi du lịch - lễ hội,..',
            ],
            [
                'label' => '45 seat',
                'description' => 'Nếu chuyến hành trình của bạn có từ 40-45 người Dưa đón công nhân viên, đưa đón học sinh, du lịch, dã ngoại',
            ],
        ];
        DB::table('car_type')->insert($car_type);
    }
}
