<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RideController;


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
    Route::get('/rides', [RideController::class, 'showRides']);
});

Route::get('/login', [UserController::class, 'login']);
Route::post('/login', [UserController::class, 'userLogin'])->name('login');


