<?php

use App\Models\Suratpusat;
use App\Models\Masteranggota;
use App\Models\Suratdisposisi;

// New
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\IzinusahaController;
use App\Http\Controllers\SuratpusatController;
use App\Http\Controllers\MastercabangController;
use App\Http\Controllers\IzinkunjunganController;
use App\Http\Controllers\MasteranggotaController;
use App\Http\Controllers\MasterpegawaiController;
use App\Http\Controllers\SuratdisposisiController;
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
    $jumlahsuratdisposisi = Suratdisposisi::count();
    $jumlahsuratpusat = Suratpusat::count();


    return view('dashboard',compact(
        'jumlahsuratdisposisi','jumlahsuratpusat'));
})->middleware('auth');


Route::prefix('dashboard')->middleware(['auth:sanctum'])->group(function() {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Master Data
    // Route::resource('masterebook', MasterebookController::class);
    Route::resource('mastercabang', MastercabangController::class);
    Route::resource('masterpegawai', MasterpegawaiController::class);

    // Data Tables Surat
    Route::resource('suratpusat', SuratpusatController::class);
    Route::resource('suratdisposisi', SuratdisposisiController::class);
    Route::resource('izinusaha', IzinusahaController::class);
    Route::resource('izinkunjungan', IzinkunjunganController::class);
    Route::get('suratmasuk', [SuratdisposisiController::class, 'suratMasuk'])->name('suratmasuk');

    // Route untuk verifikasi surat disposisi
   // Route to update the status of a surat
    // Route::put('suratmasuk/updateStatus/{id}', [SuratDisposisiController::class, 'updateStatus'])->name('suratmasuk.updateStatus');
    Route::put('/suratdisposisi/{id}/status', [SuratDisposisiController::class, 'updateStatus'])->name('updateStatus');





    // Verifikasi Di Master Data surat
    // Route::put('/items/{id}/verify', [MasteranggotaController::class, 'verify'])->name('items.verify');






// Data Tables Report Report
Route::get('suratdisposisipdf', [SuratdisposisiController::class, 'suratdisposisipdf'])->name('suratdisposisipdf');
Route::get('laporanpusatpdf', [SuratpusatController::class, 'laporanpusatpdf'])->name('laporanpusatpdf');
Route::get('laporanizinusahapdf', [IzinusahaController::class, 'laporanizinusahapdf'])->name('laporanizinusahapdf');
Route::get('laporanizinkunjunganpdf', [IzinkunjunganController::class, 'laporanizinkunjunganpdf'])->name('laporanizinkunjunganpdf');

// Rute untuk menampilkan laporan anggota
// Route::get('laporannya/laporananggota', [MasteranggotaController::class, 'perkelas'])->name('laporananggota');

// Rute untuk mengekspor PDF
// Route::get('/perkelaspdf', [MasteranggotaController::class, 'cetakPerkelasPdf'])->name('laporananggotapdf');

// Recap Laporan Tampilan
Route::get('laporannya/laporandisposisi', [SuratdisposisiController::class, 'cetakpertanggalpengembalian'])->name('laporandisposisi');
Route::get('laporannya/laporanizinusahapdf', [IzinusahaController::class, 'cetakizinpertanggal'])->name('laporanizinusahapdf');
Route::get('laporannya/laporanizinkunjunganpdf', [IzinkunjunganController::class, 'cetakizinkunjunganpertanggal'])->name('laporanizinkunjunganpdf');

// Filtering
Route::get('laporandisposisi', [SuratdisposisiController::class, 'filterdatebarang'])->name('laporandisposisi');
Route::get('laporanpusat', [SuratpusatController::class, 'filterdatebarang'])->name('laporanpusat');
Route::get('laporanizinusaha', [IzinusahaController::class, 'filterdateizin'])->name('laporanizinusaha');
Route::get('laporanizinkunjungan', [IzinkunjunganController::class, 'filterdateizinkunjungan'])->name('laporanizinkunjungan');


// Filter Laporan
Route::get('laporandisposisipdf/filter={filter}', [SuratdisposisiController::class, 'laporandisposisipdf'])->name('laporandisposisipdf');
Route::get('laporanpusatpdf/filter={filter}', [SuratpusatController::class, 'laporanpusatpdf'])->name('laporanpusatpdf');
Route::get('laporanizinusahapdf/filter={filter}', [IzinusahaController::class, 'laporanizinusahapdf'])->name('laporanizinusahapdf');
Route::get('laporanizinkunjunganpdf/filter={filter}', [IzinkunjunganController::class, 'laporanizinkunjunganpdf'])->name('laporanizinkunjunganpdf');


// Disposisi Verifikasi
// Route to show verified surat data
Route::get('suratverif', [SuratDisposisiController::class, 'tampilanterverifikasi'])->name('suratverif');
// Route for searching surat
Route::get('suratverif/search', [SuratDisposisiController::class, 'terverifikasipencariannomorsurat'])->name('suratverif.search');
// Route to generate PDF for printing
Route::get('suratverif/pdf', [SuratDisposisiController::class, 'terverifikasipdf'])->name('laporansuratverifpdf');


// Disposisi Verifikasi
// Route to show verified surat data
Route::get('suratditolak', [SuratDisposisiController::class, 'tampilanditolak'])->name('suratditolak');
// Route for searching surat
Route::get('suratditolak/search', [SuratDisposisiController::class, 'ditolakpencariannomorsurat'])->name('suratditolak.search');
// Route to generate PDF for printing
Route::get('suratditolak/pdf', [SuratDisposisiController::class, 'ditolakpdf'])->name('laporansuratditolakpdf');

});



// Login Register
Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
Route::post('/loginuser', [LoginController::class, 'loginuser'])->name('loginuser');








