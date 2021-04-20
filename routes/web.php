<?php

use App\Http\Controllers\AuditLogController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\GudangController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\RuanganController;
use App\Http\Controllers\TicketingController;
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
    return view('landing');
})->name('index');

Route::get('auth/google', [LoginController::class, 'redirectToGoogle']);
Route::get('auth/google/callback', [LoginController::class, 'handleGoogleCallback']);

Route::middleware(['auth:sanctum', 'verified'])->group(function () {

    Route::prefix('dashboard')->group(function () {
        Route::get('/', [Controller::class, 'dashboard'])->name('dashboard');

        Route::get('/pembayaran', function () {
            return view('pembayaran');
        })->name('dashboard.pembayaran');

        Route::get('/gudang', function () {
            return view('gudang');
        })->name('dashboard.gudang');

        Route::get('/ruangan', function () {
            return view('ruangan');
        })->name('dashboard.ruangan');

        Route::get('/barang', function () {
            return view('barang');
        })->name('dashboard.barang');

        Route::get('/audit_log', function () {
            return view('audit_log');
        })->name('dashboard.audit_log');

        Route::get('/ticketing', function () {
            return view('ticketing');
        })->name('dashboard.ticketing');

        Route::get('/user', function () {
            return view('user');
        })->name('dashboard.user')->middleware('can:viewDashboard,App\Models\User');

        Route::get('/kategori', function () {
            return view('kategoris');
        })->name('dashboard.kategories')->middleware('can:viewDashboard,App\Models\User');

        Route::post('/admin/user', [UserController::class, 'store'])->name('dashboard.user.store');
        Route::get('/admin/users', [UserController::class, 'index'])->name('users.index');
        Route::get('/admin/users/graph', [UserController::class, 'getRegisteredUserByTime']);
        Route::get('/admin/user/new', [UserController::class, 'create'])->name('dashboard.user.create');
        Route::get('/admin/user/{id}/delete', [UserController::class, 'delete'])->name('admin.user.delete');
        Route::get('/admin/user/{id}/verif', [UserController::class, 'verify'])->name('admin.user.verif');
        Route::get('/admin/user/edit/{id}', [UserController::class, 'edit']);
        Route::put('/admin/user/update/{id}', [UserController::class, 'update'])->name('admin.user.update');
        Route::put('/user/user/update/{id}', [UserController::class, 'update'])->name('user.update');
        Route::put('/user/user/update/{id}/password', [UserController::class, 'updatePassword'])->name('user.updatePassword');

        Route::post('/admin/kategori', [KategoriController::class, 'store'])->name('admin.kategories.store');
        Route::get('/admin/kategori', [KategoriController::class, 'index'])->name('admin.kategories.index');
        Route::get('/admin/kategori/new', [KategoriController::class, 'create'])->name('admin.kategories.create');
        Route::get('/admin/kategori/{id}/edit', [KategoriController::class, 'edit'])->name('admin.kategories.edit');
        Route::get('/admin/kategori/{id}/delete', [KategoriController::class, 'delete'])->name('admin.kategories.delete');
        Route::put('/admin/kategori/{id}', [KategoriController::class, 'update'])->name('admin.kategories.update');

        Route::post('/admin/gudang', [GudangController::class, 'store'])->name('admin.gudangs.store');
        Route::get('/admin/gudang', [GudangController::class, 'index'])->name('admin.gudangs.index');
        Route::get('/admin/gudang/new', [GudangController::class, 'create'])->name('admin.gudangs.create');
        Route::get('/admin/gudang/{id}/edit', [GudangController::class, 'edit'])->name('admin.gudangs.edit');
        Route::get('/admin/gudang/{id}/delete', [GudangController::class, 'delete'])->name('admin.gudangs.delete');
        Route::put('/admin/gudang/{id}', [GudangController::class, 'update'])->name('admin.gudangs.update');
        Route::get('/{user_id}/gudang/{id}/cek-barang/ajax', [GudangController::class, 'getBarangByUserData'])->name('user.gudangs.barangs.ajax');
        Route::get('/{user_id}/gudang/{id}/cek-barang', [GudangController::class, 'getBarangByUser'])->name('user.gudangs.barangs');
        Route::get('/gudang/barang', [GudangController::class, 'getBarangOnGudang'])->name('gudangs.count.barangs');

        Route::post('/admin/ruangan', [RuanganController::class, 'store'])->name('admin.ruangans.store');
        Route::get('/admin/ruangan', [RuanganController::class, 'index'])->name('admin.ruangans.index');
        Route::get('/admin/ruangan/new', [RuanganController::class, 'create'])->name('admin.ruangans.create');
        Route::get('/admin/ruangan/{id}/edit', [RuanganController::class, 'edit'])->name('admin.ruangans.edit');
        Route::get('/admin/ruangan/{kode_gudang}/gudang', [RuanganController::class, 'getRuanganByGudang'])->name('admin.ruangans.gudangs');
        Route::get('/admin/ruangan/{id}/delete', [RuanganController::class, 'delete'])->name('admin.ruangans.delete');
        Route::put('/admin/ruangan/{id}', [RuanganController::class, 'update'])->name('admin.ruangans.update');

        Route::post('/admin/barang', [BarangController::class, 'store'])->name('admin.barangs.store');
        Route::post('/user/barang', [BarangController::class, 'store'])->name('user.barangs.store');
        Route::get('/admin/barang', [BarangController::class, 'index'])->name('admin.barangs.index');
        Route::get('/admin/barang/new', [BarangController::class, 'create'])->name('admin.barangs.create');
        Route::get('/user/barang/new', [BarangController::class, 'create'])->name('user.barangs.create');
        Route::get('/admin/barang/{id}/edit', [BarangController::class, 'edit'])->name('admin.barangs.edit');
        Route::get('/admin/barang/{id}/delete', [BarangController::class, 'delete'])->name('admin.barangs.delete');
        Route::get('/admin/barang/{id}/detail', [BarangController::class, 'detail'])->name('admin.barangs.detail');
        Route::put('/admin/barang/{id}', [BarangController::class, 'update'])->name('admin.barangs.update');
        Route::get('/user/barang/{id}/tarik', [BarangController::class, 'tarik'])->name('user.barangs.tarik');

        Route::post('/pembayaran', [PembayaranController::class, 'store'])->name('user.pembayarans.store');
        Route::get('/admin/pembayaran/{id}', [PembayaranController::class, 'view'])->name('user.pembayarans.view');
        Route::get('/pembayaran/new', [PembayaranController::class, 'createPembayaran'])->name('user.pembayarans.create');
        Route::get('/user/pembayaran/{id}/upload_bukti', [PembayaranController::class, 'editBukti'])->name('user.pembayarans.bukti.edit');
        Route::get('/pembayarans', [PembayaranController::class, 'index'])->name('pembayarans.index');
        Route::get('/admin/pembayaran/{id}/verify', [PembayaranController::class, 'verify'])->name('admin.pembayarans.verify');
        Route::get('/admin/pembayaran/{id}/delete', [PembayaranController::class, 'delete'])->name('user.pembayarans.bukti.delete');
        Route::put('/pembayaran/{id}/upload_bukti', [PembayaranController::class, 'updateBukti'])->name('user.pembayarans.bukti.update');

        Route::post('/ticketing', [TicketingController::class, 'store'])->name('ticketing.store');
        Route::get('/ticketings', [TicketingController::class, 'index'])->name('ticketing.index');
        Route::get('/ticketing/new', [TicketingController::class, 'create'])->name('ticketing.create');
        Route::get('/ticketing/{id}/edit', [TicketingController::class, 'edit'])->name('ticketing.edit');
        Route::get('/ticketing/{id}/delete', [TicketingController::class, 'delete'])->name('ticketing.delete');
        Route::put('/ticketing/{id}', [TicketingController::class, 'update'])->name('ticketing.update');
        Route::put('/admin/ticketing/{id}/update_status', [TicketingController::class, 'updateStatus'])->name('ticketing.update_status');

        Route::get('/audit_logs', [AuditLogController::class, 'index'])->name('audit_logs');
    });
});
