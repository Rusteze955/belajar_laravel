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
    Route::get('service', [App\Http\Controllers\DashboardController::class, 'indexService']);
    Route::get('insert/service', [App\Http\Controllers\DashboardController::class, 'showInsService']);
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
