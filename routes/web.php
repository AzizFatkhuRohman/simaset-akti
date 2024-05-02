<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\EquipmentController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\PengambilanController;
use Illuminate\Support\Facades\Route;

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
Route::middleware('auth')->group(function () {
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
    Route::middleware('role:admin')->group(function () {
        Route::get('/', [Controller::class, 'index'])->name('index');
        Route::get('data-equipment', [EquipmentController::class, 'get'])->name('equipment');
        Route::get('data-equipment/filter', [EquipmentController::class, 'filter'])->name('equipment');
        Route::post('data-equipment', [EquipmentController::class, 'post'])->name('equipment');
        Route::put('data-equipment/edit/{id}', [EquipmentController::class, 'put'])->name('equipment-edit');
        Route::put('data-equipment/trash/{id}', [EquipmentController::class, 'trash'])->name('equipment-trash');
        Route::get('trash', [EquipmentController::class, 'getTrash'])->name('trash');
        Route::put('trash/restore/{id}', [EquipmentController::class, 'restore'])->name('trash-restore');
        Route::delete('trash/permanently/{id}', [EquipmentController::class, 'permanently'])->name('trash-permanently');
        Route::get('data-user', [AuthController::class, 'user'])->name('user');
        Route::post('data-user', [AuthController::class, 'add'])->name('user-add');
        Route::delete('data-user/permanently/{id}', [AuthController::class, 'destroy'])->name('user-permanently');
        Route::put('data-user/edit/{id}', [AuthController::class, 'put'])->name('data-user-edit');
        Route::get('pengambilan-barang', [PengambilanController::class, 'get'])->name('pengambilan-barang');
        Route::post('pengambilan-barang', [PengambilanController::class, 'post'])->name('pengambilan-barang');
        Route::put('pengambilan-barang/edit/{id}', [PengambilanController::class, 'put'])->name('pengambilan-barang');
        Route::delete('pengambilan-barang/hapus/{id}', [PengambilanController::class, 'destroy'])->name('barang-permanently');
        Route::get('peminjaman-barang', [PeminjamanController::class, 'get'])->name('peminjaman-barang');
        Route::post('peminjaman-barang', [PeminjamanController::class, 'post'])->name('peminjaman-barang');
        Route::put('peminjaman-barang/edit/{id}', [PeminjamanController::class, 'put'])->name('peminjaman-barang-edit');
        Route::delete('peminjaman-barang/hapus/{$id}', [PeminjamanController::class, 'destroy']);
    });
    Route::middleware('role:user')->group(function () {
        Route::get('dashboard', [Controller::class, 'dashboard'])->name('dashboard');
        Route::get('pengambilan-user', [PengambilanController::class, 'getUser'])->name('pengambilan');
        Route::post('pengambilan-user', [PengambilanController::class, 'post']);
        Route::get('peminjaman-user', [PeminjamanController::class, 'getUser'])->name('peminjaman');
        Route::post('peminjaman-user', [PeminjamanController::class, 'post']);
        Route::put('peminjaman-user/edit/{id}', [PeminjamanController::class, 'putUser']);
    });
});
Route::get('login', [AuthController::class, 'get'])->name('login');
Route::post('login', [AuthController::class, 'login'])->name('login');
