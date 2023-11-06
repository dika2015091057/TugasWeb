<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Guest\GuestController;
use App\Http\Controllers\Admin\DashboardAdminController;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// ROUTE FOR GUEST
Route::group(['middleware'=>'guest'],function (){
    Route::get('/register',[AuthController::class,'register'])->name('register');
    Route::post('register', [AuthController::class, 'registerPost'])->name('register');
    Route::get('/login',[AuthController::class,'login'])->name('login');
    Route::post('/login', [AuthController::class, 'loginPost'])->name('login');
    Route::get('/viewvehicles', [UserController::class, 'viewvehicles'])->name('viewvehicles');
    Route::post('/back/viewvehiclewithid', [UserController::class, 'viewVehicleWithId'])->name('viewVehicleWithId');
    Route::post('/back/createbooking', [UserController::class, 'createBooking'])->name('createBooking');
    Route::get('/', [GuestController::class, 'index'])->name('index');
});



// ROUTE FOR USER
Route::group(['middleware'=>'auth:user'],function (){
    Route::get('/home', function(){return view('user.dashboard');});
    Route::delete('/logoutuser', [AuthController::class, 'logout'])->name('logoutuser');
});

// ROUTE FOR ADMIN
Route::middleware(['auth:admin'])->group(function () {
    Route::get('/dashboardAdmin', [DashboardAdminController::class, 'showdashboard'])->name('showDashboardAdmin');
    Route::delete('/logout', [AuthController::class, 'logout'])->name('logout');
});

