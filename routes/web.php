<?php
;

use App\Http\Controllers\Admin\BillingController;
use App\Http\Controllers\Admin\ClientController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Auth\AdminLoginController;

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

Auth::routes(['register'=>false]);

Route::get('/admin/login', [AdminLoginController::class,'showLoginForm']);
Route::post('/admin/login', [AdminLoginController::class,'login'])->name('admin.login');
Route::post('/admin/logout', [AdminLoginController::class,'logout'])->name('admin.logout');


Route::prefix('admin')->middleware(AdminMiddleware::class)->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    //Client
    Route::resource('/clients', ClientController::class);
    Route::get('/clients/datatables/ssd', [ClientController::class,'ssd']);

    //Billing
    Route::resource('/billings', BillingController::class);
    Route::get('/billings/datatables/ssd', [BillingController::class,'ssd']);

    
});