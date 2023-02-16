<?php

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

// Route::get('/', function () {
//     return view('login');
// });
Route::middleware(['auth'])->group(function(){
    // Route::get('/', function () {
    //     return view('layouts.dashboard');
    // });
    Route::get('/', 'HomeController@index');

    Route::resource('kendaraan', KendaraanController::class);
    Route::resource('driver', DriverController::class);
    Route::resource('penyewaan', PenyewaanController::class);
    Route::resource('persetujuan', PersetujuanController::class);


    Route::resource('riwayat_kendaraan', RiwayatKendaraanController::class);
    
    Route::post('/kendaraan/getEditForm','KendaraanController@getEditForm')->name('kendaraan.getEditForm');
    Route::post('/penyewaan/getEditForm','PenyewaanController@getEditForm')->name('penyewaan.getEditForm');
    Route::post('/driver/getEditForm','DriverController@getEditForm')->name('driver.getEditForm');
    Route::post('/persetujuan/change_status','PersetujuanController@changeStatus')->name('persetujuan.changeStatus');

});

Auth::routes();


Route::get('/home', 'HomeController@index')->name('home');
