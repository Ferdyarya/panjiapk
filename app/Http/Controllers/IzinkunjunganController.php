<?php

namespace App\Http\Controllers;

use PDF;
use App\Models\Mastercabang;
use Illuminate\Http\Request;
use App\Models\Izinkunjungan;
use App\Models\Masterpegawai;

class IzinkunjunganController extends Controller
{
    public function index(Request $request)
    {
        if($request->has('search')){
            $izinkunjungan = Izinkunjungan::where('kodesurat', 'LIKE', '%' .$request->search.'%')->paginate(10);
        }else{
            $izinkunjungan = Izinkunjungan::paginate(10);
        }
        return view('izinkunjungan.index',[
            'izinkunjungan' => $izinkunjungan
        ]);
    }


    public function create()
    {
        $mastercabang = Mastercabang::all();
        $masterpegawai = Masterpegawai::all();
        return view('izinkunjungan.create', [
            'mastercabang' => $mastercabang,
            'masterpegawai' => $masterpegawai,
        ]);
        return view('izinkunjungan.create')->with('success', 'Data Telah ditambahkan');
    }


    public function store(Request $request)
{
    $data = $request->all();

    $data['kodesurat'] = $this->generateKodeSurat();

    Izinkunjungan::create($data);

    return redirect()->route('izinkunjungan.index')->with('success', 'Data telah ditambahkan');
}

public function generateKodeSurat()
{
    $latestSurat = Izinkunjungan::orderBy('created_at', 'desc')->first();

    if (!$latestSurat) {
        return 'SRT-KJN-001';
    }

    $lastKode = $latestSurat->kodesurat;
    $lastNumber = (int)substr($lastKode, -3);

    $newNumber = $lastNumber + 1;
    $newKode = 'SRT-KNJ-' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);

    return $newKode;
}


    public function show($id)
    {

    }

    public function edit(Izinkunjungan $izinkunjungan)
    {
        $mastercabang = Mastercabang::all();
        $masterpegawai = Masterpegawai::all();

        return view('izinkunjungan.edit', [
            'item' => $izinkunjungan,
            'mastercabang' => $mastercabang,
            'masterpegawai' => $masterpegawai,
        ]);
    }


    public function update(Request $request, $id)
{
    $izinkunjungan = Izinkunjungan::findOrFail($id);

    $data = $request->all();

    $izinkunjungan->update($data);

    return redirect()->route('izinkunjungan.index')->with('success', 'Data Telah diupdate');
}


    public function destroy(Izinkunjungan $izinkunjungan)
    {
        $izinkunjungan->delete();
        return redirect()->route('izinkunjungan.index')->with('success', 'Data Telah dihapus');
    }

    // public function izinkunjunganpdf() {
    //     $data = Izinkunjungan::all();

    //     $pdf = PDF::loadview('izinkunjungan/izinkunjunganpdf', ['izinkunjungan' => $data]);
    //     return $pdf->download('laporan_Bukuizinkunjungan.pdf');
    // }

    // Laporan Buku izinkunjungan Filter
    public function cetakizinkunjunganpertanggal()
    {
        $izinkunjungan = Izinkunjungan::Paginate(10);

        return view('laporannya.laporanizinkunjungan', ['laporanizinkunjungan' => $izinkunjungan]);
    }

    public function filterdateizinkunjungan(Request $request)
    {
        $startDate = $request->input('dari');
        $endDate = $request->input('sampai');

         if ($startDate == '' && $endDate == '') {
            $laporanizinkunjungan = Izinkunjungan::paginate(10);
        } else {
            $laporanizinkunjungan = Izinkunjungan::whereDate('tanggal','>=',$startDate)
                                        ->whereDate('tanggal','<=',$endDate)
                                        ->paginate(10);
        }
        session(['filter_start_date' => $startDate]);
        session(['filter_end_date' => $endDate]);

        return view('laporannya.laporanizinkunjungan', compact('laporanizinkunjungan'));
    }


    public function laporanizinkunjunganpdf(Request $request )
    {
        $startDate = session('filter_start_date');
        $endDate = session('filter_end_date');

        if ($startDate == '' && $endDate == '') {
            $laporanizinkunjungan = Izinkunjungan::all();
        } else {
            $laporanizinkunjungan = Izinkunjungan::whereDate('tanggal', '>=', $startDate)
                                            ->whereDate('tanggal', '<=', $endDate)
                                            ->get();
        }

        // Render view dengan menyertakan data laporan dan informasi filter
        $pdf = PDF::loadview('laporannya.laporanizinkunjunganpdf', compact('laporanizinkunjungan'));
        return $pdf->download('laporan_laporanizinkunjungan.pdf');
    }
}
