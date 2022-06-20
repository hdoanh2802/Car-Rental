<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\LoginSocialiteController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\ExcelCSVController;
use App\Http\Controllers\Admin\CarTypeController;
use App\Http\Controllers\Admin\CarController;
use App\Http\Controllers\common\AccountController;
use App\Http\Controllers\common\BookingController;
use App\Http\Controllers\admin\OfficeController;
use App\Http\Controllers\User\UserBookingController;
use App\Http\Controllers\User\PaypalPaymentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [LoginController::class, 'getLogin'])->name('login');
Route::post('/', [LoginController::class, 'postLogin'])->name('login');
Route::get('/signup', [LoginController::class, 'showSignup'])->name('show.signup');
Route::post('/signup', [LoginController::class, 'postSignup'])->name('signup');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');


Route::get('/verify', [LoginController::class, 'verifyUser'])->name('verify-user');

Route::get('/google/login', [LoginSocialiteController::class, 'redirectGoogle'])->name('login.google');
Route::get('/auth/google-callback', [LoginSocialiteController::class, 'loginWithGoogle']);

Route::prefix('admin')->middleware('admin')->group(function () {
    Route::get('/', [HomeController::class, 'dashboard'])->name('dashboard');

    Route::prefix('user')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('user.list');
        Route::get('/create', [UserController::class, 'create'])->name('user.create');
        Route::post('/store', [UserController::class, 'store'])->name('user.store');
        Route::get('/edit/{id}', [UserController::class, 'edit'])->name('user.edit');
        Route::post('/update/{id}', [UserController::class, 'update'])->name('user.update');
        Route::get('/delete/{id}', [UserController::class, 'delete'])->name('user.delete');

        Route::prefix('excel')->group(function () {
            Route::get('import-excel-file', [ExcelCSVController::class, 'showImport'])->name('user.import');
            Route::post('import-excel-file', [ExcelCSVController::class, 'importExcel'])->name('user.import');
            Route::get('export-excel-file', [ExcelCSVController::class, 'exportExcel'])->name('user.export');
        });
    });

    Route::prefix('car-type')->group(function () {
        Route::get('/', [CarTypeController::class, 'index'])->name('car-type.list');
        Route::get('/create', [CarTypeController::class, 'create'])->name('car-type.create');
        Route::post('/store', [CarTypeController::class, 'store'])->name('car-type.store');
        Route::get('/edit/{id}', [CarTypeController::class, 'edit'])->name('car-type.edit');
        Route::post('/update/{id}', [CarTypeController::class, 'update'])->name('car-type.update');
        Route::get('/delete/{id}', [CarTypeController::class, 'delete'])->name('car-type.delete');
        Route::post('/search', [CarTypeController::class, 'search'])->name('search');
    });

    Route::prefix('car')->group(function () {
        Route::get('/', [CarController::class, 'index'])->name('car.list');
        Route::get('/create', [CarController::class, 'create'])->name('car.create');
        Route::post('/store', [CarController::class, 'store'])->name('car.store');
        Route::get('/edit/{id}', [CarController::class, 'edit'])->name('car.edit');
        Route::post('/update/{id}', [CarController::class, 'update'])->name('car.update');
        Route::get('/delete/{id}', [CarController::class, 'delete'])->name('car.delete');
    });

    Route::prefix('booking')->group(function () {
        Route::get('/', [BookingController::class, 'index'])->name('booking.list');
        Route::get('/create', [BookingController::class, 'create'])->name('booking.create');
        Route::post('/store', [BookingController::class, 'store'])->name('booking.store');
        Route::get('/edit/{id}', [BookingController::class, 'edit'])->name('booking.edit');
        Route::post('/update/{id}', [BookingController::class, 'update'])->name('booking.update');
    });

    Route::prefix('office')->group(function () {
        Route::get('/', [OfficeController::class, 'index'])->name('office.list');
        Route::get('/create', [OfficeController::class, 'create'])->name('office.create');
        Route::post('/store', [OfficeController::class, 'store'])->name('office.store');
        Route::get('/edit/{id}', [OfficeController::class, 'edit'])->name('office.edit');
        Route::post('/update/{id}', [OfficeController::class, 'update'])->name('office.update');
        Route::get('/delete/{id}', [OfficeController::class, 'delete'])->name('office.delete');
    });
});

Route::prefix('user')->group(function () {
    Route::post('/createBooking', [BookingController::class, 'store'])->name('create-booking');
    Route::get('home', [HomeController::class, 'home'])->name('home.user');
    Route::get('car-type/{slug}/{id}', [HomeController::class, 'searchByType'])->name('search-by-type');
    Route::post('check-availability', [BookingController::class, 'CheckAvailability'])->name('check-availability');
    
    Route::get('/cart', [UserBookingController::class, 'cart'])->name('cart.list');
    Route::get('/delete/{id}', [BookingController::class, 'delete'])->name('booking.delete');
    Route::get('handle-payment', [PayPalPaymentController::class, 'handlePayment'])->name('make.payment');
    Route::get('cancel-payment', [PayPalPaymentController::class, 'paymentCancel'])->name('cancel.payment');
    Route::get('payment-success', [PayPalPaymentController::class, 'paymentSuccess'])->name('success.payment');
    Route::post('booking-car', [PayPalPaymentController::class, 'booking'])->name('booking.car');
    Route::post('received-car', [PayPalPaymentController::class, 'received'])->name('received.car');
    Route::get('booked-car', [UserBookingController::class, 'bookedCar'])->name('booked.car');
});

Route::post('change-password', [AccountController::class, 'changePassword'])->name('change-password');
Route::post('update', [AccountController::class, 'updateAuth'])->name('update-auth');

