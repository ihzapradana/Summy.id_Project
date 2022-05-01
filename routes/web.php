<?php

use App\Http\Controllers\LaporanController;
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
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


// Route::prefix('/petani', function(){
//     Route::get('/', [App\Http\Controllers\PetaniController::class, 'index'])->name('petani');
//     Route::get('/tambah', [App\Http\Controllers\PetaniController::class, 'tambah'])->name('petani');
// });
Route::name('petani.')->middleware('auth')->group(function () {
    Route::get('/petani', [App\Http\Controllers\PetaniController::class, 'index'])->name('index');
    Route::get('/petani/tambah', [App\Http\Controllers\PetaniController::class, 'tambah'])->name('tambah');
    Route::get('/petani/delete/{id}', [App\Http\Controllers\PetaniController::class, 'delete'])->name('delete');
    Route::get('/petani/edit/{id}', [App\Http\Controllers\PetaniController::class, 'edit'])->name('edit');
    Route::post('/petani/store', [App\Http\Controllers\PetaniController::class, 'store'])->name('store');
    Route::post('/petani/update', [App\Http\Controllers\PetaniController::class, 'update'])->name('update');
});

Route::name('laporan.')->middleware('auth')->group(function () {
    Route::get('/laporan', [LaporanController::class, 'index'])->name('index');
    Route::get('/laporan/tambah', [LaporanController::class, 'tambah'])->name('tambah');
    Route::get('/laporan/delete/{id}', [LaporanController::class, 'delete'])->name('delete');
    Route::get('/laporan/detail/{id}', [LaporanController::class, 'detail'])->name('detail');
    Route::get('/laporan/edit/{id}', [LaporanController::class, 'edit'])->name('edit');
    Route::post('/laporan/update', [LaporanController::class, 'update'])->name('update');
    Route::post('/laporan/store', [LaporanController::class, 'store'])->name('store');
});


