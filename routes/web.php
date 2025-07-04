<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BelajarController;


//defalut ('/')
Route::get('/', [App\Http\Controllers\LoginController::class, 'login']);
Route::get('login', [App\Http\Controllers\LoginController::class, 'login'])->name('login');
Route::get('logout', [App\Http\Controllers\LoginController::class, 'logout'])->name('logout');
Route::post('actionLogin', [App\Http\Controllers\LoginController::class, 'actionLogin'])->name('actionLogin');

Route::middleware(['auth'])->group(function () {
    Route::resource('dashboard', App\Http\Controllers\DashboardController::class);
    Route::resource('user', App\Http\Controllers\UserController::class);
    Route::resource('trans', App\Http\Controllers\TransOrderController::class);
    Route::resource('level', App\Http\Controllers\LevelController::class);
    Route::resource('service', App\Http\Controllers\ServiceController::class);
    Route::resource('customer', App\Http\Controllers\CustomerController::class);
    Route::get('print_struk/{id}', [App\Http\Controllers\TransOrderController::class, 'printStruk'])->name('print_struk');
    Route::post('trans/{id}/snap', [App\Http\Controllers\TransOrderController::class, 'snap'])->name('trans.snap');
});

// get: hanya bisa melihat dan membaca
// post: bisa membuat dan menambahkan data
// put: bisa mengubah data(form)
// delete: bisa menghapus data(form)

Route::get('belajar', [App\Http\Controllers\BelajarController::class, 'index']);
Route::get('tambah', [App\Http\Controllers\BelajarController::class, 'tambah'])->name('tambah');
Route::get('kurang', [App\Http\Controllers\BelajarController::class, 'kurang'])->name('kurang');

// Table Counts
Route::get('data/hitungan', [BelajarController::class, 'viewHitungan'])->name('data.hitungan');
Route::get('edit/data-hitung/{id}', [BelajarController::class, 'editDataHitung'])->name('edit.data-hitung');
Route::put('update/tambahan/{id}', [BelajarController::class, 'updateTambahan'])->name('update.tambahan');
Route::delete('softDelete/data-hitungan/{id}', [BelajarController::class, 'softDeleteTambahan'])->name('softDelete.data-hitung');

Route::post('tambah-action', [App\Http\Controllers\BelajarController::class, 'tambahAction'])->name('tambah-action');
Route::post('kurang-action', [App\Http\Controllers\BelajarController::class, 'kurangAction'])->name('kurang-action');
