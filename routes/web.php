<?php

use App\Http\Controllers\ActivityLogController;
use App\Http\Controllers\AwalController;
use App\Http\Controllers\ChartDataController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\JurusanController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\NilaiController;
use App\Http\Controllers\PdfController;
// use App\Http\Controllers\NilayController;
use App\Http\Controllers\PenjumlahanController;
use App\Http\Controllers\ProdiController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\RekapNilaiController;
use App\Http\Controllers\RuanganController;
use App\Http\Controllers\SesiController;
use App\Http\Controllers\SidangController;
use App\Http\Controllers\TAController;
use App\Http\Controllers\TanggalController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ValidasiController;
use App\Models\Dosen;
use App\Models\Mahasiswa;
use App\Models\Penjumlahan;
use App\Models\Sidang;
use App\Models\TA;
use App\Models\tanggal;
use App\Models\Validasi;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

// Route::get('/', function () {
//     return view('dashboard');
// })->middleware('auth');

Route::get('/main', function () {
    return view('test');
});

Route::get('/404', function () {
    return view('404');
});
Route::resource('/', AwalController::class );

//------------------------------------------------------------------//

route::middleware(['guest'])->group(function () {
    Route::get('/login', [LoginController::class, 'index']);
    Route::post('/login', [LoginController::class, 'login'])->name('login');
    Route::get('/register', [RegisterController::class, 'register'])->name('register.show');
    Route::post('/register', [RegisterController::class, 'create'])->name('register.create');
});


//-----------------------------------------------------------------//

route::middleware(['auth'])->group(function () {

    ////////////////// Akses untuk semua level user//////////////////
    // Route::resource('/profile', ProfileController::class);

    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::post('/profile', [App\Http\Controllers\ProfileController::class, 'store'])->name('user.profile.store');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

    
    
    Route::resource('/dashboard', DashboardController::class);
    // Route::get('/dashboard', [ChartDataController::class, 'index'])->name('dashboard');


    route::get('/pdf/{id}',[PdfController::class, 'generatePdf']);
    route::resource('/nilai', NilaiController::class);



    Route::get('download-dokumen/{id}', function ($id) {
        $dokumen = TA::where('id', $id)->first();
        return Storage::download('public/ta/' . $dokumen->dokumen, $dokumen->dokumen);
    })->name('download.dokumen');

    route::resource('/ta', TAController::class);
    route::resource('/sidang', SidangController::class);
    Route::get('/get-dosen/{ta_id}', [TAController::class, 'getDosen']);
    route::get('/logout', [LoginController::class, 'logout']);
    //////////////////--------------------------/////////////////////

    ///////////////// Akses hanya untuk dosen /////////////////////
    route::get('/berinilai/{sidang_id}/{penilai}/{jenjang}', [NilaiController::class, 'berinilai']);
    route::put('/berinilai/{nilai_id}/edit', [NilaiController::class, 'update']);

    /////////////////---------------------------////////////////////


    Route::group(['middleware' => 'userAkses:Admin'], function () {

        route::resource('/activityLog', ActivityLogController::class);
        Route::resource('/user', UserController::class);


    });

    ///////////////// Akses untuk user admin & kaprodi//////////////
    Route::group(['middleware' => 'userAkses:Admin|Kaprodi'], function () {
        Route::resource('/mahasiswa', MahasiswaController::class);
        route::resource('/dosen', DosenController::class);
        route::resource('/jurusan', JurusanController::class);
        route::resource('/prodi', ProdiController::class);
        route::resource('/ruangan', RuanganController::class);
        route::resource('/sesi', SesiController::class);
        route::resource('/tanggal', TanggalController::class);
        route::resource('/rekap-nilai', RekapNilaiController::class);
        Route::get('/rekap-nilai-pdf', [PdfController::class, 'exportPDF'])->name('rekap-nilai-pdf');

        route::resource('/validasi', ValidasiController::class);
        // route::get('/cek-nilai/{id}', [NilayController::class, 'nilai']);
        route::resource('/nilai/penjumlahan', PenjumlahanController::class);
        route::post('penjumlahan/{id}', [PenjumlahanController::class, 'update']);
        // route::resource('/nilay', NilayController::class);
        // route::get('nilaik/{id}', [NilayController::class, 'edit']);
        // route::post('/nilai/penjumlahan', [PenjumlahanController::class, 'edit']);
        // route::put('/nilai/penjumlahan/{id}/update', [PenjumlahanController::class, 'update']);
        route::get('/exportMahasiswa', [MahasiswaController::class, 'export'])->name('mahasiswa.export');
        route::post('/importMahasiswa', [MahasiswaController::class, 'import']);
        route::get('/exportDosen', [DosenController::class, 'export'])->name('dosen.export');
        route::post('/importDosen', [DosenController::class, 'import']);



    });
    ////////////////----------------------------////////////////////

    // route::resource('/D4',NilaiController::class,'D4');
    // route::resource('/penjumlahan',PenjumlahanController::class);

    Route::get('/penilaian', function () {
        return view('nilai/penilaian');
    });

    Route::get('getDosen', function(){
     $dosen = Dosen::where('user_id', null)->get();
     return response()->json([$dosen]);   
    });
    Route::get('getMahasiswa', function(){
     $mahasiswa = Mahasiswa::whereNull('user_id')->get();
     return response()->json([$mahasiswa]);   
    });


});





// Route::get('test', function(){
// dd();
// });