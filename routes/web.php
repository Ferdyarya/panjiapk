<?php

use App\Models\Rusak;
use App\Models\Reqbuku;
use App\Models\Masterrak;
use App\Models\Masterbuku;
use App\Models\Peminjaman;
use App\Models\Masteranggota;
use App\Models\Masterkategori;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RusakController;
use App\Http\Controllers\ReqbukuController;

// New
use App\Http\Controllers\AnggaranController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MasterrakController;
use App\Http\Controllers\MasterbukuController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\PemusnahanController;
use App\Http\Controllers\SuratpusatController;
use App\Http\Controllers\MasterebookController;
use App\Http\Controllers\MasteranggotaController;
use App\Http\Controllers\MasterkategoriController;
use App\Http\Controllers\SuratdisposisiController;
use App\Http\Controllers\PeminjamanebookController;
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

Route::get('/', function () {
    $jumlahbuku = Masteranggota::count();
    $jumlahanggota = Masteranggota::count();


    return view('dashboard',compact(
        'jumlahbuku','jumlahanggota'));
})->middleware('auth');


Route::prefix('dashboard')->middleware(['auth:sanctum'])->group(function() {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Master Data
    Route::resource('masterebook', MasterebookController::class);

    // Data Tables Surat
    Route::resource('suratpusat', SuratpusatController::class);
    Route::resource('suratdisposisi', SuratdisposisiController::class);



    // Verifikasi Di Master Data surat
    // Route::put('/items/{id}/verify', [MasteranggotaController::class, 'verify'])->name('items.verify');






// Data Tables Report Report
Route::get('suratdisposisipdf', [SuratdisposisiController::class, 'suratdisposisipdf'])->name('suratdisposisipdf');

// Rute untuk menampilkan laporan anggota
Route::get('laporannya/laporananggota', [MasteranggotaController::class, 'perkelas'])->name('laporananggota');

// Rute untuk mengekspor PDF
// Route::get('/perkelaspdf', [MasteranggotaController::class, 'cetakPerkelasPdf'])->name('laporananggotapdf');

// Recap Laporan Tampilan
Route::get('laporannya/laporanpeminjaman', [SuratdisposisiController::class, 'cetakpertanggalpengembalian'])->name('laporanpeminjaman');

// Filtering
Route::get('laporanpeminjaman', [SuratdisposisiController::class, 'filterdatebarang'])->name('laporanpeminjaman');


// Filter Laporan
Route::get('laporandendapdf/filter={filter}', [SuratdisposisiController::class, 'laporandendapdf'])->name('laporandendapdf');


});



// Login Register
Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
Route::post('/loginuser', [LoginController::class, 'loginuser'])->name('loginuser');








