<?php

use App\Http\Controllers\CommissionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RideController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\DistinationController;
use App\Http\Controllers\ManagerController;

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
    return view('welcome');
});

Route::group(['middleware' => 'auth.custom'], function () {
    Route::get('/dashboard', [UserController::class, 'dashboard']);
    Route::get('/rides', [RideController::class, 'showRides'])->name('ride.index');
    Route::post('/rides/store', [RideController::class, 'store'])->name('ride.store');

    Route::get('/hotels', [HotelController::class, 'show'])->name('hotels');
    // Route::get('/hotels/create', [HotelController::class, 'create'])->name('hotels.create');
    Route::post('/hotels/submit', [HotelController::class, 'store'])->name('hotels.store');
    Route::get('/hotels/delete/{hotelID}', [HotelController::class, 'delete'])->name('hotels.delete');

    Route::get('/destination',[DistinationController::class, 'showDestination']);
    Route::post('/destination',[DistinationController::class, 'addEditDeleteDestination']);

    Route::get('/driver',[DriverController::class, 'index'])->name('driver.index');
    Route::post('/driver/store', [DriverController::class, 'store'])->name('drivers.store');


    Route::get('/permision', [PermissionController::class, 'showPermission']);
    Route::post('/permision', [PermissionController::class, 'addPermission']);

    Route::get('/permision/{roleID}', [PermissionController::class, 'showPermissionList']);


    Route::get('/managers',[ManagerController::class, 'index'])->name('managers.index');
    Route::post('/managers',[ManagerController::class, 'store'])->name('managers.store');

    Route::get('/commission',[CommissionController::class, 'index'])->name('commission.index');

    
});

Route::get('/login', [UserController::class, 'login']);
Route::post('/login', [UserController::class, 'userLogin'])->name('login');


