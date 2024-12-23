<?php

namespace App\Http\Controllers;

use PDF;
use App\Models\Mastercabang;
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
        $mastercabang = Mastercabang::all();
        return view('suratdisposisi.create', [
            'mastercabang' => $mastercabang,
        ]);
        return view('suratdisposisi.create')->with('success', 'Data Telah ditambahkan');
    }


    public function store(Request $request)
{
    // Validasi permintaan
    $request->validate([
        'id_mastercabang' => 'required|string',        // id_mastercabang surat
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
    $data = $request->only(['id_mastercabang', 'tglterima', 'sifat', 'perihal', 'diteruskan', 'catatan', 'disposisi']);
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
        $mastercabang = Mastercabang::all();

        return view('suratdisposisi.edit', [
            'item' => $suratdisposisi,
            'mastercabang' => $mastercabang,
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

    //Surat Masuk
    public function suratMasuk(Request $request)
    {
        // Cek apakah ada query search
        $search = $request->get('search');

        // Ambil data surat disposisi dengan pencarian (jika ada)
        $suratdisposisi = SuratDisposisi::when($search, function ($query) use ($search) {
            return $query->where('nmrsurat', 'like', '%' . $search . '%')
                         ->orWhere('id_mastercabang', 'like', '%' . $search . '%')
                         ->orWhere('perihal', 'like', '%' . $search . '%');
        })->paginate(10); // Menampilkan 10 data per halaman

        // Mengirim data ke view
        return view('suratdisposisi.suratmasuk', compact('suratdisposisi'));
    }

    // Function untuk melakukan verifikasi surat disposisi
    public function updateStatus(Request $request, $id)
{
    // Validate the incoming request to ensure a valid status is selected
    $validated = $request->validate([
        'status' => 'required|in:Terverifikasi,Ditolak', // Validating that status is either 'Terverifikasi' or 'Ditolak'
    ]);

    // Find the SuratDisposisi entry by ID
    $suratdisposisi = SuratDisposisi::findOrFail($id);

    // Update the status based on the form input
    $suratdisposisi->status = $validated['status'];
    $suratdisposisi->save();

    // Redirect back to the suratmasuk page with a success message
    return redirect()->route('suratmasuk')->with('success', 'Status surat berhasil diperbarui.');
}













    //Report
    // public function laporandisposisipdf() {
    //     $data = Suratdisposisi::all();

    //     $pdf = PDF::loadview('laporandisposisi.laporandisposisipdf', ['laporandisposisi' => $data]);
    //     return $pdf->download('laporan_laporandisposisi.pdf');
    // }

     // Laporan Buku suratdisposisi Filter
     public function cetakbarangpertanggal()
     {
         $suratdisposisi = Suratdisposisi::Paginate(10);

         return view('laporannya.laporandisposisi', ['laporandisposisi' => $suratdisposisi]);
     }

     public function filterdatebarang(Request $request)
     {
         $startDate = $request->input('dari');
         $endDate = $request->input('sampai');

          if ($startDate == '' && $endDate == '') {
             $laporandisposisi = Suratdisposisi::paginate(10);
         } else {
             $laporandisposisi = Suratdisposisi::whereDate('tglterima','>=',$startDate)
                                         ->whereDate('tglterima','<=',$endDate)
                                         ->paginate(10);
         }
         session(['filter_start_date' => $startDate]);
         session(['filter_end_date' => $endDate]);

         return view('laporannya.laporandisposisi', compact('laporandisposisi'));
     }


     public function laporandisposisipdf(Request $request )
     {
         $startDate = session('filter_start_date');
         $endDate = session('filter_end_date');

         if ($startDate == '' && $endDate == '') {
             $laporandisposisi = Suratdisposisi::all();
         } else {
             $laporandisposisi = Suratdisposisi::whereDate('tglterima', '>=', $startDate)
                                             ->whereDate('tglterima', '<=', $endDate)
                                             ->get();
         }

         // Render view dengan menyertakan data laporan dan informasi filter
         $pdf = PDF::loadview('laporannya.laporandisposisipdf', compact('laporandisposisi'));
         return $pdf->download('laporan_laporandisposisi.pdf');
     }

    //  Tampilan dan report Surat Terverifikasi
    public function tampilanterverifikasi()
    {
        $suratdisposisi = SuratDisposisi::where('status', 'Terverifikasi')->paginate(10);
        return view('laporannya.suratverif', compact('suratdisposisi'));
    }

    public function terverifikasipencariannomorsurat(Request $request)
    {
        $search = $request->get('search');
        $suratdisposisi = SuratDisposisi::where('nmrsurat', 'LIKE', "%$search%")
                                         ->where('status', 'Terverifikasi')
                                         ->paginate(10);
        return view('laporannya.suratverif', compact('suratdisposisi'));
    }

    public function terverifikasipdf()
    {
        // Fetch surat disposisi with status 'Terverifikasi'
        $laporansuratdisposisi = SuratDisposisi::where('status', 'Terverifikasi')->get();

        // Generate the PDF from the 'laporannya.suratverifpdf' view and pass the suratdisposisi data
        $pdf = PDF::loadView('laporannya.laporansuratverifpdf', compact('laporansuratdisposisi'));

        // Download the PDF with a specific filename
        return $pdf->download('suratverif.pdf');
    }



    //  Tampilan dan report Surat Ditolak
     public function tampilanditolak()
     {
         $suratdisposisi = SuratDisposisi::where('status', 'ditolak')->paginate(10);
         return view('laporannya.suratditolak', compact('suratdisposisi'));
     }

     public function ditolakpencariannomorsurat(Request $request)
     {
         $search = $request->get('search');
         $suratdisposisi = SuratDisposisi::where('nmrsurat', 'LIKE', "%$search%")
                                          ->where('status', 'ditolak')
                                          ->paginate(10);
         return view('laporannya.suratditolak', compact('suratdisposisi'));
     }

     public function ditolakpdf()
     {
         // Fetch surat disposisi with status 'ditolak'
         $laporansuratdisposisi = SuratDisposisi::where('status', 'ditolak')->get();

         // Generate the PDF from the 'laporannya.suratditolakpdf' view and pass the suratdisposisi data
         $pdf = PDF::loadView('laporannya.laporansuratditolakpdf', compact('laporansuratdisposisi'));

         // Download the PDF with a specific filename
         return $pdf->download('suratditolak.pdf');
     }
}
