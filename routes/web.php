<?php

use App\Http\Controllers\GudangController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RuanganController;
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
        Route::get('/', function () {
            return view('dashboard');
        })->name('dashboard');

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

        Route::get('/log_audit', function () {
            return view('log_audit');
        })->name('dashboard.log_audit');

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

        Route::post('/admin/ruangan', [RuanganController::class, 'store'])->name('admin.ruangans.store');
        Route::get('/admin/ruangan', [RuanganController::class, 'index'])->name('admin.ruangans.index');
        Route::get('/admin/ruangan/new', [RuanganController::class, 'create'])->name('admin.ruangans.create');
        Route::get('/admin/ruangan/{id}/edit', [RuanganController::class, 'edit'])->name('admin.ruangans.edit');
        Route::get('/admin/ruangan/{id}/delete', [RuanganController::class, 'delete'])->name('admin.ruangans.delete');
        Route::put('/admin/ruangan/{id}', [RuanganController::class, 'update'])->name('admin.ruangans.update');
    });
});
