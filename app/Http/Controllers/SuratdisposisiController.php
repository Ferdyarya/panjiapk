<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Suratdisposisi;

class SuratdisposisiController extends Controller
{
    public function index(Request $request)
    {
        if($request->has('search')){
            $suratdisposisi = Suratdisposisi::where('nmrsurat', 'LIKE', '%' .$request->search.'%')->paginate(10);
        }else{
            $suratdisposisi = Suratdisposisi::paginate(10);
        }
        return view('suratdisposisi.index',[
            'suratdisposisi' => $suratdisposisi
        ]);
    }


    public function create()
    {
        return view('suratdisposisi.create')->with('success', 'Data Telah ditambahkan');
    }


    public function store(Request $request)
{
    // Validasi permintaan
    $request->validate([
        'asal' => 'required|string',        // Asal surat
        'tglterima' => 'required|date',     // Tanggal terima
        'sifat' => 'required|string',       // Sifat surat
        'perihal' => 'required|string',     // Perihal surat
        'diteruskan' => 'required|string',  // Kepada siapa surat diteruskan
        'catatan' => 'nullable|string',     // Catatan
        'disposisi' => 'nullable|string',   // Disposisi surat
        'filesurat' => 'file|mimes:pdf',    // File surat
    ]);

    // Generate kode surat
    $nmrsurat = $this->generatenmrsurat();

    // Persiapkan data untuk disimpan
    $data = $request->only(['asal', 'tglterima', 'sifat', 'perihal', 'diteruskan', 'catatan', 'disposisi']);
    $data['nmrsurat'] = $nmrsurat; // Menambahkan kode surat yang sudah digenerate

    // Jika ada file surat, simpan file tersebut dan tambahkan ke data
    if ($request->hasFile('filesurat')) {
        $data['filesurat'] = $request->file('filesurat')->store('surat_files', 'public');
    }

    // Buat entri baru dengan data yang sudah disiapkan
    Suratdisposisi::create($data);

    // Redirect dengan pesan sukses
    return redirect()->route('suratdisposisi.index')->with('success', 'Data telah ditambahkan');
}

public function generatenmrsurat()
{
    $latestSurat = Suratdisposisi::orderBy('created_at', 'desc')->first();
    if (!$latestSurat) {
        return 'SRT-DSP-BJB-001'; // Jika belum ada data, mulai dari 001
    }

    $lastKode = $latestSurat->nmrsurat;
    $lastNumber = (int)substr($lastKode, -3); // Ambil angka terakhir dari kode surat
    $newNumber = $lastNumber + 1;
    $newKode = 'SRT-DSP-BJB-' . str_pad($newNumber, 3, '0', STR_PAD_LEFT); // Format kode baru

    return $newKode;
}



    public function show($id)
    {

    }


    public function edit(Suratdisposisi $suratdisposisi)
    {
        return view('suratdisposisi.edit', [
            'item' => $suratdisposisi
        ]);
    }


    public function update(Request $request, Suratdisposisi $suratdisposisi)
    {
        $data = $request->all();

        $suratdisposisi->update($data);

        //dd($data);

        return redirect()->route('suratdisposisi.index')->with('success', 'Data Telah diupdate');

    }


    public function destroy(Suratdisposisi $suratdisposisi)
    {
        $suratdisposisi->delete();
        return redirect()->route('suratdisposisi.index')->with('success', 'Data Telah dihapus');
    }

    public function suratdisposisipdf() {
        $data = Suratdisposisi::all();

        $pdf = PDF::loadview('suratdisposisi.suratdisposisipdf', ['suratdisposisi' => $data]);
        return $pdf->download('laporan_suratdisposisi.pdf');
    }

     // Laporan Buku suratdisposisi Filter
     public function cetakbarangpertanggal()
     {
         $suratdisposisi = Suratdisposisi::Paginate(10);

         return view('laporannya.laporansuratdisposisi', ['laporansuratdisposisi' => $suratdisposisi]);
     }

     public function filterdatebarang(Request $request)
     {
         $startDate = $request->input('dari');
         $endDate = $request->input('sampai');

          if ($startDate == '' && $endDate == '') {
             $laporansuratdisposisi = Suratdisposisi::paginate(10);
         } else {
             $laporansuratdisposisi = Suratdisposisi::whereDate('tanggal','>=',$startDate)
                                         ->whereDate('tanggal','<=',$endDate)
                                         ->paginate(10);
         }
         session(['filter_start_date' => $startDate]);
         session(['filter_end_date' => $endDate]);

         return view('laporannya.laporansuratdisposisi', compact('laporansuratdisposisi'));
     }


     public function laporansuratdisposisipdf(Request $request )
     {
         $startDate = session('filter_start_date');
         $endDate = session('filter_end_date');

         if ($startDate == '' && $endDate == '') {
             $laporansuratdisposisi = Suratdisposisi::all();
         } else {
             $laporansuratdisposisi = Suratdisposisi::whereDate('tanggal', '>=', $startDate)
                                             ->whereDate('tanggal', '<=', $endDate)
                                             ->get();
         }

         // Render view dengan menyertakan data laporan dan informasi filter
         $pdf = PDF::loadview('laporannya.laporansuratdisposisipdf', compact('laporansuratdisposisi'));
         return $pdf->download('laporan_laporansuratdisposisi.pdf');
     }
}
