<?php

namespace Database\Seeders;

use App\Models\BrandCar;
use App\Models\Car_Type;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Office;

class CarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $officeIds = Office::pluck('id')->toArray();
        $brand_che = BrandCar::where('name_brand', 'Chevrolet')->first();
        $brand_hyn = BrandCar::where('name_brand', 'Hyundai')->first();
        $brand_toyo = BrandCar::where('name_brand', 'Toyota')->first();
        $brand_ford = BrandCar::where('name_brand', 'Ford')->first();
        $brand_innova = BrandCar::where('name_brand', 'Inovova')->first();
        $brand_cam = BrandCar::where('name_brand', 'Camry')->first();
        $brand_mer = BrandCar::where('name_brand', 'Mercede')->first();
        $type_seat4 = Car_Type::where('label', '4 seat')->first();
        $type_seat5 = Car_Type::where('label', '5 seat')->first();
        $type_seat7 = Car_Type::where('label', '7 seat')->first();
        $type_seat16 = Car_Type::where('label', '16 seat')->first();
        $type_seat45 = Car_Type::where('label', '45 seat')->first();
        $type_vip = Car_Type::where('label', 'Vip')->first();
        $cars = [
            [
                'type_id' => $type_seat4->id,
                'office_id' => $officeIds[array_rand($officeIds)],
                'brand_id' => $brand_che->id,
                'name' => 'Chevrolet',
                'color' => 'Black',
                'description' => 'Là đối thủ của Toyota Fortuner, Ford Everest, Isuzu MU-X, Nissan X-trail...',
                'purch_date' => '8/2017',
                'price_start' => '15.00',
                'price_hourly' => '10.00',
            ],
            [
                'type_id' => $type_seat4->id,
                'office_id' => $officeIds[array_rand($officeIds)],
                'brand_id' => $brand_toyo->id,
                'name' => 'Toyota Vios',
                'color' => 'Black',
                'description' => 'Là đối thủ của Toyota Fortuner, Ford Everest, Isuzu MU-X, Nissan X-trail....',
                'purch_date' => '8/2018',
                'price_start' => '15.00',
                'price_hourly' => '10.00',
            ],
            [
                'type_id' => $type_seat5->id,
                'office_id' => $officeIds[array_rand($officeIds)],
                'brand_id' => $brand_hyn->id,
                'name' => 'pickup truck 1',
                'color' => 'Black',
                'description' => 'Những chiếc bán tải đủ 5 chỗ ngồi, có thể dùng để đi du lịch',
                'purch_date' => '5/2015',
                'price_start' => '20.00',
                'price_hourly' => '15.00',
            ],
            [
                'type_id' => $type_seat5->id,
                'office_id' => $officeIds[array_rand($officeIds)],
                'brand_id' => $brand_hyn->id,
                'name' => 'pickup truck 2',
                'color' => 'Black',
                'description' => 'Những chiếc bán tải đủ 5 chỗ ngồi, có thể dùng để đi du lịch',
                'purch_date' => '5/2015',
                'price_start' => '30.00',
                'price_hourly' => '17.00',
            ],
            [
                'type_id' => $type_seat7->id,
                'office_id' => $officeIds[array_rand($officeIds)],
                'brand_id' => $brand_innova->id,
                'name' => 'Innova',
                'color' => 'White',
                'description' => 'được thiết kế sang trọng, nội thất rộng rãi nên được nhiều doanh nghiệp thuê xe tháng dài hạn',
                'purch_date' => '5/2018',
                'price_start' => '15.00',
                'price_hourly' => '12.00',
            ],
            [
                'type_id' => $type_seat7->id,
                'office_id' => $officeIds[array_rand($officeIds)],
                'brand_id' => $brand_ford->id,
                'name' => 'Fordtuner',
                'color' => 'White',
                'description' => 'được thiết kế sang trọng, nội thất rộng rãi nên được nhiều công ty nước ngoài thuê xe tháng dài hạn',
                'purch_date' => '5/2020',
                'price_start' => '20.00',
                'price_hourly' => '15.00',
            ],
            [
                'type_id' => $type_seat16->id,
                'office_id' => $officeIds[array_rand($officeIds)],
                'brand_id' => $brand_toyo->id,
                'name' => 'Ford Transit',
                'color' => 'Black, White',
                'description' => 'được thiết kế sang trọng, nội thất rộng rãi nên được nhiều công ty nước ngoài thuê xe tháng dài hạn',
                'purch_date' => '5/2018',
                'price_start' => '30.00',
                'price_hourly' => '20.00',
            ],
            [
                'type_id' => $type_seat45->id,
                'office_id' => $officeIds[array_rand($officeIds)],
                'brand_id' => $brand_hyn->id,
                'name' => 'Hyundai Univere',
                'color' => 'Black',
                'description' => 'Trong luong lon,..',
                'purch_date' => '5/2019',
                'price_start' => '50.00',
                'price_hourly' => '30.00',
            ],
            [
                'type_id' => $type_vip->id,
                'office_id' => $officeIds[array_rand($officeIds)],
                'brand_id' => $brand_cam->id,
                'name' => 'Camry 2.0',
                'color' => 'Black, While',
                'description' => 'Toyota Camry 2.0G 2021 là một trong 2 biến thể của thế hệ Camry 2021 mới nhập khẩu từ Thái lan.',
                'purch_date' => '5/2021',
                'price_start' => '30.00',
                'price_hourly' => '20.00',
            ],
            [
                'type_id' => $type_vip->id,
                'office_id' => $officeIds[array_rand($officeIds)],
                'brand_id' => $brand_cam->id,
                'name' => 'Camry 2.5',
                'color' => 'Black, While',
                'description' => 'Toyota Camry 2.5G 2021 là một trong 2 biến thể của thế hệ Camry 2021 mới nhập khẩu từ Thái lan.',
                'purch_date' => '1/2022',
                'price_start' => '35.00',
                'price_hourly' => '25.00',
            ],
            [
                'type_id' => $type_vip->id,
                'office_id' => $officeIds[array_rand($officeIds)],
                'brand_id' => $brand_mer->id,
                'name' => 'Merede C',
                'color' => 'Black, While',
                'description' => 'Những mẫu xe đến từ hãng xe hơi đẳng cấp toàn cầu - Mercedes-Benz đều toát lên nét sang trọng, lịch lãm riêng biệt, khoang nội thất rộng rãi với nhiều trang bị hiện đại bậc nhất.',
                'purch_date' => '1/2022',
                'price_start' => '45.00',
                'price_hourly' => '30.00',
            ],
            [
                'type_id' => $type_vip->id,
                'office_id' => $officeIds[array_rand($officeIds)],
                'brand_id' => $brand_mer->id,
                'name' => 'Merede E',
                'color' => 'Black, While',
                'description' => 'Những mẫu xe đến từ hãng xe hơi đẳng cấp toàn cầu - Mercedes-Benz đều toát lên nét sang trọng, lịch lãm riêng biệt, khoang nội thất rộng rãi với nhiều trang bị hiện đại bậc nhất.',
                'purch_date' => '1/2022',
                'price_start' => '45.00',
                'price_hourly' => '35.00',
            ],
            [
                'type_id' => $type_vip->id,
                'office_id' => $officeIds[array_rand($officeIds)],
                'brand_id' => $brand_mer->id,
                'name' => 'Merede S',
                'color' => 'Black, While',
                'description' => 'Những mẫu xe đến từ hãng xe hơi đẳng cấp toàn cầu - Mercedes-Benz đều toát lên nét sang trọng, lịch lãm riêng biệt, khoang nội thất rộng rãi với nhiều trang bị hiện đại bậc nhất.',
                'purch_date' => '1/2022',
                'price_start' => '60.00',
                'price_hourly' => '45.00',
            ],
        ];
        DB::table('cars')->insert($cars);
    }
}
