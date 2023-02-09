<?php

use App\Http\Controllers\AlatController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DatapegawaiController;
use App\Http\Controllers\DepartemenController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\PetugasController;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\App;
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
    return redirect('dashboard');
});

Route::group(['middleware' => ['auth']], function(){
	
// route menu dashboard
Route::get('/dashboard', [DashboardController::class,'index']);

// Kelola petugas
Route::get('petugas', [PetugasController::class,'index']);
Route::post('petugas/store', [PetugasController::class,'store']);
Route::get('petugas/edit/{id}', [PetugasController::class,'edit']);
Route::put('petugas/update/{id}', [PetugasController::class,'update']);
Route::delete('petugas/delete/{id}', [PetugasController::class,'destroy']);

// route kelola pengguna
Route::get('/pengguna', [PenggunaController::class,'index']);
Route::post('/pengguna/store', [PenggunaController::class,'store']);
Route::get('/pengguna/edit/{id}', [PenggunaController::class,'edit']);
Route::put('/pengguna/edit/{id}', [PenggunaController::class,'update']);
Route::delete('pengguna/delete/{id}', [PenggunaController::class,'destroy']);

// kelola category
Route::get('category', [CategoryController::class,'index']);
Route::post('/category/store', [CategoryController::class,'store']);
Route::get('/category/edit/{id}', [CategoryController::class,'edit']);
Route::put('/category/edit/{id}', [CategoryController::class,'update']);
Route::delete('category/delete/{id}', [CategoryController::class,'destroy']);

// kelola alat
Route::get('alat', [AlatController::class,'index']);
Route::post('/alat/store', [AlatController::class,'store']);
Route::get('/alat/edit/{id}', [AlatController::class,'edit']);
Route::put('/alat/update/{id}', [AlatController::class,'update']);
Route::delete('alat/delete/{id}', [AlatController::class,'destroy']);

// Kelola departemen
Route::get('departemen', [DepartemenController::class,'index']);
Route::post('/departemen/store', [DepartemenController::class,'store']);
Route::get('departemen/edit/{id}', [DepartemenController::class,'edit']);
Route::put('departemen/update/{id}', [DepartemenController::class,'update']);
Route::delete('departemen/delete/{id}', [DepartemenController::class,'destroy']);

// Kelola Peminjaman
Route::get('peminjaman-alat', [PeminjamanController::class,'index']);
Route::post('peminjaman/store', [PeminjamanController::class,'store']);
Route::get('peminjaman/edit/{id}', [PeminjamanController::class,'edit']);
Route::put('peminjaman/update/{id}', [PeminjamanController::class,'update']);
Route::delete('peminjaman/delete/{id}', [PeminjamanController::class,'destroy']);

// update password
Route::get('update-password',[DashboardController::class,'update_password']);
Route::post('update-password',[DashboardController::class,'update']);

// data pegawai
Route::get('data-pegawai', [DatapegawaiController::class,'index']);

});

// route logout
Route::post('logout', function(){
	\Auth::logout();
	return redirect('login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
