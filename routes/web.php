<?php

use App\Http\Controllers\DashboardDMJ;
use App\Http\Controllers\DashboardDMJBTASController;
use App\Http\Controllers\DashboardIKABDGController;
use App\Http\Controllers\DashboardIKAController;
use Illuminate\Support\Facades\Route;

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

Route::controller(DashboardDMJ::class)->group(function () {
    Route::get('/dashboard_DMJ', 'dashboarddmj')->name('DMJS');
    Route::get('/dashboard_IKA', 'dashboardika')->name('IKA');
    Route::get('/', 'dashboarddmj')->name('DMJS');
    Route::post('/filter', 'carimonthly')->name('filltermonthly');
    Route::get('/filters', 'carimonthly')->name('filltermonthlyS');
    Route::post('/tambah_target', 'createtarget')->name('Tambah Target');
});
Route::controller(DashboardIKAController::class)->group(function () {
    Route::get('/dashboard_IKA', 'dashboardika')->name('IKA');
});
Route::controller(DashboardIKABDGController::class)->group(function () {
    Route::get('/dashboard_IKABDG', 'dashboardikabdg')->name('IKABDG');
});
Route::controller(DashboardDMJBTASController::class)->group(function () {
    Route::get('/dashboard_DMJBTA', 'dashboarddmjbta')->name('DMJBTA');
});

