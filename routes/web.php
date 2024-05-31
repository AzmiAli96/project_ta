<?php

use App\Http\Controllers\ActivityLogController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\JurusanController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\ProdiController;
use App\Http\Controllers\RuanganController;
use App\Http\Controllers\SesiController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('dashbord');
})->middleware('auth');

Route::get('/main', function () {
    return view('layout/main');
});

Route::get('/404', function () {
    return view('404');
});


route::middleware(['guest'])->group(function(){
    Route::get('/login', [LoginController::class,'index']);
    Route::post('/login', [LoginController::class,'login'])->name('login');
    Route::get('/register', [LoginController::class,'showRegister'])->name('register.show');
    Route::post('/register', [LoginController::class,'create'])->name('register.create');
});


route::middleware(['auth'])->group(function(){
    Route::resource('/mahasiswa',MahasiswaController::class);
    route::resource('/dosen',DosenController::class);
    route::resource('/activityLog',ActivityLogController::class);
    route::resource('/jurusan',JurusanController::class);
    route::resource('/prodi',ProdiController::class);
    route::resource('/ruangan',RuanganController::class);
    route::resource('/sesi',SesiController::class);
    route::get('/logout',[LoginController::class,'logout']);
});

route::get('/exportMahasiswa',[MahasiswaController::class,'export'])->name('mahasiswa.export');
route::post('/importMahasiswa',[MahasiswaController::class,'import']);