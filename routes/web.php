<?php

use App\Models\Suratpusat;
use App\Models\Masteranggota;
use App\Models\Suratdisposisi;

// New
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\IzinusahaController;
use App\Http\Controllers\HasilauditController;
use App\Http\Controllers\SuratpusatController;
use App\Http\Controllers\MastercabangController;
use App\Http\Controllers\EvaluasiauditController;
use App\Http\Controllers\IzinkunjunganController;
use App\Http\Controllers\MasteranggotaController;
use App\Http\Controllers\MasterpegawaiController;
use App\Http\Controllers\PengadaanauditController;
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
    Route::resource('pengadaanaudit', PengadaanauditController::class);
    Route::resource('evaluasiaudit', EvaluasiauditController::class);
    Route::resource('hasilaudit', HasilauditController::class);
    Route::get('suratmasuk', [SuratdisposisiController::class, 'suratMasuk'])->name('suratmasuk');

    // Status Route
    Route::put('/suratdisposisi/{id}/status', [SuratDisposisiController::class, 'updateStatus'])->name('updateStatus');

// Data Tables Report Report
// Route::get('suratdisposisipdf', [SuratdisposisiController::class, 'suratdisposisipdf'])->name('suratdisposisipdf');
// Route::get('laporanpusatpdf', [SuratpusatController::class, 'laporanpusatpdf'])->name('laporanpusatpdf');
// Route::get('laporanizinusahapdf', [IzinusahaController::class, 'laporanizinusahapdf'])->name('laporanizinusahapdf');
// Route::get('laporanizinkunjunganpdf', [IzinkunjunganController::class, 'laporanizinkunjunganpdf'])->name('laporanizinkunjunganpdf');

// Recap Laporan Tampilan
Route::get('laporannya/laporandisposisi', [SuratdisposisiController::class, 'cetakbarangpertanggal'])->name('laporandisposisi');
Route::get('laporannya/laporanpusat', [SuratpusatController::class, 'cetaksuratpusatpertanggal'])->name('laporanpusat');
Route::get('laporannya/laporanizinusaha', [IzinusahaController::class, 'cetakizinpertanggal'])->name('laporanizinusaha');
Route::get('laporannya/laporanizinkunjungan', [IzinkunjunganController::class, 'cetakizinkunjunganpertanggal'])->name('laporanizinkunjungan');
Route::get('laporannya/laporanpengadaanaudit', [PengadaanauditController::class, 'cetakpengadaanauditpertanggal'])->name('laporanpengadaanaudit');
Route::get('laporannya/laporanevaluasiaudit', [EvaluasiauditController::class, 'cetakevaluasiauditpertanggal'])->name('laporanevaluasiaudit');
Route::get('laporannya/laporanhasilaudit', [HasilauditController::class, 'cetakhasilauditpertanggal'])->name('laporanhasilaudit');

// Filtering
Route::get('laporandisposisi', [SuratdisposisiController::class, 'filterlaporandisposisi'])->name('filterlaporandisposisi');
Route::get('laporanpusat', [SuratpusatController::class, 'filterdatesuratpusat'])->name('filterlaporanpusat');
Route::get('laporanizinusaha', [IzinusahaController::class, 'filterdateizin'])->name('filterlaporanizinusaha');
Route::get('laporanizinkunjungan', [IzinkunjunganController::class, 'filterdateizinkunjungan'])->name('filterlaporanizinkunjungan');
Route::get('laporanpengadaanaudit', [PengadaanauditController::class, 'filterdatepengadaanaudit'])->name('filterlaporanpengadaanaudit');
Route::get('laporanevaluasiaudit', [EvaluasiauditController::class, 'filterdateevaluasiaudit'])->name('filterlaporanevaluasiaudit');
Route::get('laporanhasilaudit', [HasilauditController::class, 'filterdatehasilaudit'])->name('filterlaporanhasilaudit');

// Filter Laporan
Route::get('laporandisposisipdf/filter={filter}', [SuratdisposisiController::class, 'laporandisposisipdf'])->name('laporandisposisipdf');
Route::get('laporanpusatpdf/filter={filter}', [SuratpusatController::class, 'laporanpusatpdf'])->name('laporanpusatpdf');
Route::get('laporanizinusahapdf/filter={filter}', [IzinusahaController::class, 'laporanizinusahapdf'])->name('laporanizinusahapdf');
Route::get('laporanizinkunjunganpdf/filter={filter}', [IzinkunjunganController::class, 'laporanizinkunjunganpdf'])->name('laporanizinkunjunganpdf');
Route::get('laporanpengadaanauditpdf/filter={filter}', [PengadaanauditController::class, 'laporanpengadaanauditpdf'])->name('laporanpengadaanauditpdf');
Route::get('laporanevaluasiauditpdf/filter={filter}', [EvaluasiauditController::class, 'laporanevaluasiauditpdf'])->name('laporanevaluasiauditpdf');
Route::get('laporanhasilauditpdf/filter={filter}', [HasilauditController::class, 'laporanhasilauditpdf'])->name('laporanhasilauditpdf');


// Disposisi Verifikasi
Route::get('suratverif', [SuratDisposisiController::class, 'tampilanterverifikasi'])->name('suratverif');
Route::get('suratverif/search', [SuratDisposisiController::class, 'terverifikasipencariannomorsurat'])->name('suratverif.search');
Route::get('suratverif/pdf', [SuratDisposisiController::class, 'terverifikasipdf'])->name('laporansuratverifpdf');


// Disposisi Ditolak
Route::get('suratditolak', [SuratDisposisiController::class, 'tampilanditolak'])->name('suratditolak');
Route::get('suratditolak/search', [SuratDisposisiController::class, 'ditolakpencariannomorsurat'])->name('suratditolak.search');
Route::get('suratditolak/pdf', [SuratDisposisiController::class, 'ditolakpdf'])->name('laporansuratditolakpdf');

});



// Login Register
Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
Route::post('/loginuser', [LoginController::class, 'loginuser'])->name('loginuser');








