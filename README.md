## Tên dự án Car rental
## Giới thiệu
- Khách hàng có thể đặt xe theo lịch cụ thể.
- Hệ thống có phân quyền admin-quản trị và use- người dùng
   + User: Có thể đăng nhập hệ thống bằng email hoặc tài khoản google, có thể xem và sử profile, xem thông tin xe và đặt xe.
   + Admin: Ngoài những quyền user có admin có thể quản lý khách hàng, xe, loại xe,...(crud), có thể import và export danh sách khách hàng.
## Yêu cầu
- php: 7.3
- laravel 8.
- mysql
## Sử dụng thư viện
- Socialite : để đăng lý và đăng nhập vào hệ thống qua tài khoản google
- Maatwebsite: để gửi email xác thực sau khi khách hàng đăng ký tài khoản.
- Srmklive: thanh toán qua paypal
## Cách cài đặt
- Tài khoản admin: admin@gmail.com, passwork: 12345678. Tài khoản user có thể tự đăng ký hoặc dùng tài khoản có trong database
- Install composer: composer install nếu lỗi do virsion: composer install --ignore-platform-reqs
- Tạo file .env
- Tạo database: php artisan migrate.
- Tạo dữ liệu test: 
   + php artisan db:seed RoleSeeder
   + php artisan db:seed UserSeeder
   + php artisan db:seed OfficeTelSeeder
   + php artisan db:seed OfficeSeeder
   + php artisan db:seed CarTypeSeeder
   + php artisan db:seed BrandSeeder
   + php artisan db:seed CarSeeder
   + php artisan db:seed StatusBookingSeeder
   + php artisan db:seed BookingSeeder
- Chạy chương trình: php artisan serve   


#   C a r - R e n t a l  
 