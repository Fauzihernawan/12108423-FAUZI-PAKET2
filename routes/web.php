<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PetugasController;
use App\Http\Controllers\ProdukController;
use App\Models\Produk;
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

Route::get('/', [AuthController::class, 'index'])->name('/');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::group(['middleware' => 'role:admin'], function () {
    Route::get('/beranda', [AdminController::class, 'index'])->name('dashboard_admin');
    Route::controller(UserController::class)->prefix('user')->group(function () {
        Route::get('', 'index')->name('user');
        Route::get('tambah', 'tambah')->name('formUser');
        Route::post('simpan', 'simpanUser')->name('user.simpan');
        Route::get('edit/{id}', 'edit')->name('user.edit');
        Route::patch('edit/{id}', 'update')->name('user.update');
        Route::get('hapus/{id}', 'hapus')->name('user.hapus');
    });
    Route::controller(ProdukController::class)->prefix('produk')->group(function () {
        Route::get('', 'index')->name('produk');
        Route::get('tambah', 'tambah')->name('formproduk');
        Route::post('simpan', 'simpan')->name('produk.simpan');
        Route::get('edit/{id}', 'edit')->name('produk.edit');
        Route::patch('edit/{id}', 'update')->name('produk.update');
        Route::get('hapus/{id}', 'hapus')->name('produk.hapus');
    });
});

Route::group(['middleware' => 'role:petugas'], function () {
    Route::get('/dashboard', [PetugasController::class, 'index'])->name('dashboard_petugas');
});
