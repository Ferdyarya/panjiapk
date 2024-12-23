<?php

use App\Models\Masteranggota;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;

// New
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SuratpusatController;
use App\Http\Controllers\MastercabangController;
use App\Http\Controllers\MasteranggotaController;
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
    $jumlahbuku = Masteranggota::count();
    $jumlahanggota = Masteranggota::count();


    return view('dashboard',compact(
        'jumlahbuku','jumlahanggota'));
})->middleware('auth');


Route::prefix('dashboard')->middleware(['auth:sanctum'])->group(function() {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Master Data
    // Route::resource('masterebook', MasterebookController::class);
    Route::resource('mastercabang', MastercabangController::class);

    // Data Tables Surat
    Route::resource('suratpusat', SuratpusatController::class);
    Route::resource('suratdisposisi', SuratdisposisiController::class);
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

// Rute untuk menampilkan laporan anggota
Route::get('laporannya/laporananggota', [MasteranggotaController::class, 'perkelas'])->name('laporananggota');

// Rute untuk mengekspor PDF
// Route::get('/perkelaspdf', [MasteranggotaController::class, 'cetakPerkelasPdf'])->name('laporananggotapdf');

// Recap Laporan Tampilan
Route::get('laporannya/laporandisposisi', [SuratdisposisiController::class, 'cetakpertanggalpengembalian'])->name('laporandisposisi');
Route::get('laporannya/laporanpusat', [SuratpusatController::class, 'cetakpertanggalpengembalian'])->name('laporanpusat');

// Filtering
Route::get('laporandisposisi', [SuratdisposisiController::class, 'filterdatebarang'])->name('laporandisposisi');
Route::get('laporanpusat', [SuratpusatController::class, 'filterdatebarang'])->name('laporanpusat');


// Filter Laporan
Route::get('laporandisposisipdf/filter={filter}', [SuratdisposisiController::class, 'laporandisposisipdf'])->name('laporandisposisipdf');
Route::get('laporanpusatpdf/filter={filter}', [SuratpusatController::class, 'laporanpusatpdf'])->name('laporanpusatpdf');


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








