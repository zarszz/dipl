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

    Route::prefix('dashboard')->group(function () {
        Route::get('/',function () {
            return view('dashboard') ;
         })->name('dashboard');

         Route::get('/pembayaran',function () {
             return view('pembayaran') ;
          })->name('dashboard.pembayaran');

          Route::get('/gudang',function () {
             return view('gudang') ;
          })->name('dashboard.gudang');

          Route::get('/barang',function () {
             return view('barang') ;
          })->name('dashboard.barang');

          Route::get('/log_audit',function () {
             return view('log_audit') ;
          })->name('dashboard.log_audit');

          Route::get('/user',function () {
             return view('user');
          })->name('dashboard.user')->middleware('can:viewDashboard,App\Models\User');

          Route::get('/admin/users', [UserController::class, 'index'])->name('users.index');
          Route::get('/admin/user/new', [UserController::class, 'create'])->name('dashboard.user.create');
          Route::post('/admin/user', [UserController::class, 'store'])->name('dashboard.user.store');
          Route::get('/admin/user/edit/{id}', [UserController::class, 'edit']);
          Route::put('/admin/user/update/{id}', [UserController::class, 'update'])->name('admin.user.update');
          Route::get('/admin/user/{id}/delete', [UserController::class, 'delete'])->name('admin.user.delete');
    });
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
