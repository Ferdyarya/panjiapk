<?php

namespace App\Http\Controllers;

use PDF;
use App\Models\Suratpusat;
use App\Models\Mastercabang;
use Illuminate\Http\Request;
use App\Models\Masterpegawai;

class SuratpusatController extends Controller
{
    public function index(Request $request)
    {
        if($request->has('search')){
            $suratpusat = Suratpusat::where('kodesurat', 'LIKE', '%' .$request->search.'%')->paginate(10);
        }else{
            $suratpusat = Suratpusat::paginate(10);
        }
        return view('suratpusat.index',[
            'suratpusat' => $suratpusat
        ]);
    }


    public function create()
    {
        $mastercabang = Mastercabang::all();
        $masterpegawai = Masterpegawai::all();

        return view('suratpusat.create', [
            'mastercabang' => $mastercabang,
            'masterpegawai' => $masterpegawai,
        ]);
        return view('suratpusat.create')->with('success', 'Data Telah ditambahkan');
    }


    public function store(Request $request)
{
    $data = $request->all();

    // Validasi permintaan
    $request->validate([
        'id_mastercabang' => 'required|string',
        'tujuan_surat' => 'required|string',
        'tentangsurat' => 'required|string',
        'tanggal' => 'required|date',
        'filesurat' => 'file|mimes:pdf',
        'klasifikasi' => 'required|string',
    ]);

    // Generate kode surat
    $kodeSurat = $this->generateKodeSurat();

    // Persiapkan data untuk disimpan
    $data = $request->only(['id_mastercabang', 'tujuan_surat', 'tentangsurat', 'filesurat', 'klasifikasi','tanggal']);
    $data['kodesurat'] = $kodeSurat;

    // Menangani file surat jika ada
    if ($request->hasFile('filesurat')) {
        $fileName = $request->file('filesurat')->getClientOriginalName();
        $request->file('filesurat')->move(public_path('filesurat'), $fileName);
        $data['filesurat'] = $fileName;
    }

    // Debugging: Periksa nilai $data sebelum menyimpan ke database
    // dd($data);

    // Buat entri baru dengan kode surat otomatis
    Suratpusat::create($data);

    // Redirect dengan pesan sukses
    return redirect()->route('suratpusat.index')->with('success', 'Data telah ditambahkan');
}


    public function generateKodeSurat()
    {
        $latestSurat = Suratpusat::orderBy('created_at', 'desc')->first();
        if (!$latestSurat) {
            return 'SRT-BJB-001';
        }

        $lastKode = $latestSurat->kodesurat;
        $lastNumber = (int)substr($lastKode, -3);
        $newNumber = $lastNumber + 1;
        $newKode = 'SRT-BJB-' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);

        return $newKode;
    }


    public function show($id)
    {

    }


    public function edit(Suratpusat $suratpusat)
    {
        $mastercabang = Mastercabang::all();
        $masterpegawai = Masterpegawai::all();

        return view('suratpusat.edit', [
            'item' => $suratpusat,
            'mastercabang' => $mastercabang,
            'masterpegawai' => $masterpegawai,
        ]);
    }


    public function update(Request $request, Suratpusat $suratpusat)
    {
        $data = $request->all();

        $suratpusat->update($data);

        //dd($data);

        return redirect()->route('suratpusat.index')->with('success', 'Data Telah diupdate');

    }


    public function destroy(Suratpusat $suratpusat)
    {
        $suratpusat->delete();
        return redirect()->route('suratpusat.index')->with('success', 'Data Telah dihapus');
    }



     // Laporan Buku Surat Pusat Filter
     public function cetakbarangpertanggal()
     {
         $suratpusat = Suratpusat::Paginate(10);

         return view('laporannya.laporanpusat', ['laporanpusat' => $suratpusat]);
     }

     public function filterdatebarang(Request $request)
     {
         $startDate = $request->input('dari');
         $endDate = $request->input('sampai');

          if ($startDate == '' && $endDate == '') {
             $laporanpusat = Suratpusat::paginate(10);
         } else {
             $laporanpusat = Suratpusat::whereDate('tanggal','>=',$startDate)
                                         ->whereDate('tanggal','<=',$endDate)
                                         ->paginate(10);
         }
         session(['filter_start_date' => $startDate]);
         session(['filter_end_date' => $endDate]);

         return view('laporannya.laporanpusat', compact('laporanpusat'));
     }


     public function laporanpusatpdf(Request $request )
     {
         $startDate = session('filter_start_date');
         $endDate = session('filter_end_date');

         if ($startDate == '' && $endDate == '') {
             $laporanpusat = Suratpusat::all();
         } else {
             $laporanpusat = Suratpusat::whereDate('tanggal', '>=', $startDate)
                                             ->whereDate('tanggal', '<=', $endDate)
                                             ->get();
         }

         // Render view dengan menyertakan data laporan dan informasi filter
         $pdf = PDF::loadview('laporannya.laporanpusatpdf', compact('laporanpusat'));
         return $pdf->download('laporan_laporanpusat.pdf');
     }
}
