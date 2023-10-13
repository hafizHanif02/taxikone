<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RideController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\CommissionController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\DistinationController;

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

Route::get('/', function () {
    return redirect('/login');
});

Route::group(['middleware' => 'auth.custom'], function () {
    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');
    Route::get('/rides', [RideController::class, 'showRides'])->name('ride.index');
    Route::post('/rides/store', [RideController::class, 'store'])->name('ride.store');

    
    Route::get('/hotels', [HotelController::class, 'show'])->name('hotels');
    Route::post('/hotels/update/{hotel}', [HotelController::class, 'update'])->name('hotels.update');
    // Route::get('/hotels/create', [HotelController::class, 'create'])->name('hotels.create');
    Route::post('/hotels/submit', [HotelController::class, 'store'])->name('hotels.store');
    Route::get('/hotels/delete/{hotelID}', [HotelController::class, 'delete'])->name('hotels.delete');

    Route::get('/destination',[DistinationController::class, 'showDestination']);
    Route::post('/destination',[DistinationController::class, 'addEditDeleteDestination']);

    Route::get('/driver',[DriverController::class, 'index'])->name('driver.index');
    Route::post('/driver/update/{driver}',[DriverController::class, 'update'])->name('driver.update');
    Route::post('/driver/delete/{driver}',[DriverController::class, 'destroy'])->name('driver.delete');
    Route::post('/driver/store', [DriverController::class, 'store'])->name('drivers.store');


    Route::get('/permision', [PermissionController::class, 'showPermission']);
    Route::post('/permision', [PermissionController::class, 'addPermission']);

    Route::get('/permision/{roleID}', [PermissionController::class, 'showPermissionList']);


    Route::get('/managers',[ManagerController::class, 'index'])->name('managers.index');
    Route::post('/managers',[ManagerController::class, 'store'])->name('managers.store');
    Route::post('/managers/update/{manager}',[ManagerController::class, 'update'])->name('managers.update');
    Route::post('/managers/delete/{manager}',[ManagerController::class, 'delete'])->name('managers.delete');

    Route::get('/commissions',[CommissionController::class, 'index'])->name('commissions.index');
    Route::post('/commissions',[CommissionController::class, 'store'])->name('commissions.store');
    Route::get('/get-commission-rate',[ CommissionController::class,'getCommissionRate']);


    Route::get('/payments',[PaymentController::class,'index'])->name('payment.index');
    // Route::post('/controller/payments',[PaymentController::class,'MyPayments'])->name('payment.controller.index');

    Route::post('/add_payment/{driver}',[PaymentController::class,'addpay']);
    Route::post('/add_payment_hotel/{hotel}',[PaymentController::class,'addpayhotel']);


    // CONTROLLER ROUTE

    // Hotel
    Route::post('controller/hotels',[HotelController::class,'myhotels'])->name('hotel.controller.index');

    // Ride
    Route::post('controller/rides', [RideController::class, 'myshowRides'])->name('ride.controller.index');

    // Payments
    Route::post('/controller/payments', [PaymentController::class, 'MyPayments'])->name('payment.controller.index');
    Route::post('/add_payment_hotelc/{hotel}',[PaymentController::class,'addpayhotelController']);
    Route::post('/add_paymentc/{driver}',[PaymentController::class,'addpayController']);
});

Route::get('/login', [UserController::class, 'login']);
Route::post('/login', [UserController::class, 'userLogin'])->name('login');


