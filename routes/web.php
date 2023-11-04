<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
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

Route::group(['middleware'=>'guest'],function (){
    Route::get('/register',[AuthController::class,'register'])->name('register');
    Route::post('register', [AuthController::class, 'registerPost'])->name('register');
    Route::get('/login',[AuthController::class,'login'])->name('login');
    Route::post('/login', [AuthController::class, 'loginPost'])->name('login');
    Route::get('/kac', function () {
        return view('template.template');
    });
    Route::get('/', function () {
        return view('guest.landingPage');
    });

});
Route::group(['middleware'=>'auth:user'],function (){
    Route::get('/home', function(){
        return view('user.dashboard');
    });
});
Route::middleware(['auth:admin'])->group(function () {
    // Rute-rute admin di sini
    Route::get('/dashboardAdmin', [DashboardAdminController::class, 'showdashboard'])->name('showDashboardAdmin');
});

