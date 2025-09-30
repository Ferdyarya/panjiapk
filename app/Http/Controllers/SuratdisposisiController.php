<?php

namespace App\Http\Controllers;
use PDF;

use Carbon\Carbon;
use App\Models\Mastercabang;
use Illuminate\Http\Request;
use App\Models\Masterpegawai;
use App\Models\Suratdisposisi;
use Spatie\GoogleCalendar\Event;

class SuratdisposisiController extends Controller
{
    public function index(Request $request)
{
    $query = Suratdisposisi::query();

    if ($request->has('search') && $request->search != '') {
        $query->where('nmrsurat', 'LIKE', '%' . $request->search . '%');
    }

    if ($request->has('perihal') && $request->perihal != '') {
        $query->where('perihal', $request->perihal);
    }

    $suratdisposisi = $query->paginate(10)->appends($request->all());

    // Asumsikan kamu sudah menyiapkan variable $perihal untuk filter dropdown
    $perihal = Suratdisposisi::select('perihal')->distinct()->pluck('perihal');

    return view('suratdisposisi.index', [
        'suratdisposisi' => $suratdisposisi,
        'perihal' => $perihal,
    ]);
}



    public function create()
    {
        $mastercabang = Mastercabang::all();
        $masterpegawai = Masterpegawai::all();
        return view('suratdisposisi.create', [
            'mastercabang' => $mastercabang,
            'masterpegawai' => $masterpegawai,
        ]);
        return view('suratdisposisi.create')->with('success', 'Data Telah ditambahkan');
    }


    public function store(Request $request)
{
    $request->validate([
        'id_mastercabang'   => 'required|string',
        'id_masterpegawai'  => 'required|string',
        'tglterima'         => 'required|date',
        'sifat'             => 'required|string',
        'perihal'           => 'required|string',
        'diteruskan'        => 'required|string',
        'catatan'           => 'nullable|string',
        'disposisi'         => 'nullable|string',
        'lampiran'         => 'file|mimes:pdf',
    ]);

    // Generate nomor surat
    $nmrsurat = $this->generatenmrsurat();

    // Ambil data request
    $data = $request->only([
        'id_mastercabang',
        'id_masterpegawai',
        'tglterima',
        'sifat',
        'perihal',
        'diteruskan',
        'catatan',
        'disposisi',
        'lampiran'
    ]);
    $data['nmrsurat'] = $nmrsurat;

    // Menangani file surat jika ada
    if ($request->hasFile('lampiran')) {
        $fileName = $request->file('lampiran')->getClientOriginalName();
        $request->file('lampiran')->move(public_path('lampiran'), $fileName);
        $data['lampiran'] = $fileName;
    }

    // Buat entri di database dan simpan ke variabel model
    $surat = Suratdisposisi::create($data);

    // Buat event Google Calendar
    $event = new Event;
    $event->name = "Surat: " . $request->perihal;
    $event->description = "Sifat: {$request->sifat}\nDiteruskan: {$request->diteruskan}\nCatatan: {$request->catatan}";
    $event->startDateTime = Carbon::parse($request->tglterima)->startOfDay();
    $event->endDateTime   = Carbon::parse($request->tglterima)->endOfDay();
    $googleEvent = $event->save();

    // Update kolom google_event_id di database
    $surat->update(['google_event_id' => $googleEvent->id]);

    return redirect()->route('suratdisposisi.index')
        ->with('success', 'Data berhasil ditambahkan & masuk ke Google Calendar');
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
        $masterpegawai = Masterpegawai::all();

        return view('suratdisposisi.edit', [
            'item' => $suratdisposisi,
            'mastercabang' => $mastercabang,
            'masterpegawai' => $masterpegawai,
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
        // hapus di Google Calendar
        if ($suratdisposisi->google_event_id) {
            $event = Event::find($suratdisposisi->google_event_id);
            if ($event) {
                $event->delete();
            }
        }
        $suratdisposisi->delete();
        return redirect()->route('suratdisposisi.index')->with('success', 'Data Telah dihapus');
    }

    //Surat Masuk
    public function suratMasuk(Request $request)
{
    $search = $request->get('search');
    $filterPerihal = $request->get('perihal');

    $suratdisposisi = SuratDisposisi::when($search, function ($query) use ($search) {
        return $query->where('nmrsurat', 'like', '%' . $search . '%')
                     ->orWhere('id_mastercabang', 'like', '%' . $search . '%')
                     ->orWhere('perihal', 'like', '%' . $search . '%');
    })
    ->when($filterPerihal, function ($query) use ($filterPerihal) {
        return $query->where('perihal', $filterPerihal);
    })
    ->paginate(10)
    ->appends($request->all()); // agar parameter tetap dibawa di pagination

    // Jika ingin menampilkan pilihan perihal di filter, ambil distinct perihal juga
    $perihal = SuratDisposisi::select('perihal')->distinct()->pluck('perihal');

    return view('suratdisposisi.suratmasuk', compact('suratdisposisi', 'perihal'));
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
    return redirect()->route('suratdisposisi.suratmasuk')->with('success', 'Status surat berhasil diperbarui.');
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

     public function filterlaporandisposisi(Request $request)
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
