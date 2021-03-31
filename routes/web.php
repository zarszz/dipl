<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
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

Route::get('/', function () {
    return view('welcome');
})->name('index');

Route::get('auth/google', [LoginController::class, 'redirectToGoogle']);
Route::get('auth/google/callback', [LoginController::class, 'handleGoogleCallback']);

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/dashboard',function () {
       return view('dashboard') ;
    })->name('dashboard');

    Route::get('/pembayaran',function () {
        return view('pembayaran') ;
     })->name('pembayaran');

     Route::get('/gudang',function () {
        return view('gudang') ;
     })->name('gudang');

     Route::get('/barang',function () {
        return view('barang') ;
     })->name('barang');

     Route::get('/log_audit',function () {
        return view('log_audit') ;
     })->name('log_audit');

     Route::get('/user',function () {
        return view('user') ;
     })->name('user');

     /*
    * Ticketings Routes
    */
    Route::resource('ticketings', App\Http\Controllers\TicketingController::class);

    /*
    * Gudangs Routes
    */
    Route::resource('gudangs', App\Http\Controllers\GudangController::class);

    /*
    * Barangs Routes
    */
    Route::resource('barangs', App\Http\Controllers\BarangController::class);

    /*
    * AuditLogs Routes
    */
    Route::resource('audit_logs', App\Http\Controllers\AuditLogController::class);

    /*
    * UserRoles Routes
    */
    // Route::resource('user_roles', App\Http\Controllers\UserRoleController::class);

    /*
    * Roles Routes
    */
    Route::resource('roles', App\Http\Controllers\RoleController::class);

    /*
    * Pembayarans Routes
    */
    Route::resource('pembayarans', App\Http\Controllers\PembayaranController::class);

    Route::get('/users', [UserController::class, 'index'])->name('users.index');

    /*
    * Kendaraans Routes
    */
    Route::resource('kendaraans', App\Http\Controllers\KendaraanController::class);

    /*
    * Ruangans Routes
    */
    Route::resource('ruangans', App\Http\Controllers\RuanganController::class);

    /*
    * Kategoris Routes
    */
    Route::resource('kategoris', App\Http\Controllers\KategoriController::class);

});
