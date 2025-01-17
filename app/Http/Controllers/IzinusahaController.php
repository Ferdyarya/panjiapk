<?php

namespace App\Http\Controllers;

use PDF;
use App\Models\Izinusaha;
use Illuminate\Http\Request;

class IzinusahaController extends Controller
{
    public function index(Request $request)
    {
        if($request->has('search')){
            $izinusaha = Izinusaha::where('kodesurat', 'LIKE', '%' .$request->search.'%')->paginate(10);
        }else{
            $izinusaha = Izinusaha::paginate(10);
        }
        return view('izinusaha.index',[
            'izinusaha' => $izinusaha
        ]);
    }


    public function create()
    {
        return view('izinusaha.create')->with('success', 'Data Telah ditambahkan');
    }


    public function store(Request $request)
{
    $data = $request->all();

    $data['kodesurat'] = $this->generateKodeSurat();

    Izinusaha::create($data);

    return redirect()->route('izinusaha.index')->with('success', 'Data telah ditambahkan');
}

public function generateKodeSurat()
{
    $latestSurat = Izinusaha::orderBy('created_at', 'desc')->first();

    if (!$latestSurat) {
        return 'SRT-USH-001';
    }

    $lastKode = $latestSurat->kodesurat;
    $lastNumber = (int)substr($lastKode, -3);

    $newNumber = $lastNumber + 1;
    $newKode = 'SRT-USH-' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);

    return $newKode;
}


    public function show($id)
    {

    }

    public function edit(Izinusaha $izinusaha)
    {
        return view('izinusaha.edit', [
            'item' => $izinusaha
        ]);
    }


    public function update(Request $request, $id)
{
    $izinusaha = Izinusaha::findOrFail($id);

    $data = $request->all();

    $izinusaha->update($data);

    return redirect()->route('izinusaha.index')->with('success', 'Data Telah diupdate');
}


    public function destroy(Izinusaha $izinusaha)
    {
        $izinusaha->delete();
        return redirect()->route('izinusaha.index')->with('success', 'Data Telah dihapus');
    }

    public function izinusahapdf() {
        $data = Izinusaha::all();

        $pdf = PDF::loadview('izinusaha/izinusahapdf', ['izinusaha' => $data]);
        return $pdf->download('laporan_Bukuizinusaha.pdf');
    }

    // Laporan Buku izinusaha Filter
    public function cetakizinpertanggal()
    {
        $izinusaha = Izinusaha::Paginate(10);

        return view('laporannya.laporanizinusaha', ['laporanizinusaha' => $izinusaha]);
    }

    public function filterdateizin(Request $request)
    {
        $startDate = $request->input('dari');
        $endDate = $request->input('sampai');

         if ($startDate == '' && $endDate == '') {
            $laporanizinusaha = Izinusaha::paginate(10);
        } else {
            $laporanizinusaha = Izinusaha::whereDate('tanggal','>=',$startDate)
                                        ->whereDate('tanggal','<=',$endDate)
                                        ->paginate(10);
        }
        session(['filter_start_date' => $startDate]);
        session(['filter_end_date' => $endDate]);

        return view('laporannya.laporanizinusaha', compact('laporanizinusaha'));
    }


    public function laporanizinusahapdf(Request $request )
    {
        $startDate = session('filter_start_date');
        $endDate = session('filter_end_date');

        if ($startDate == '' && $endDate == '') {
            $laporanizinusaha = Izinusaha::all();
        } else {
            $laporanizinusaha = Izinusaha::whereDate('tanggal', '>=', $startDate)
                                            ->whereDate('tanggal', '<=', $endDate)
                                            ->get();
        }

        // Render view dengan menyertakan data laporan dan informasi filter
        $pdf = PDF::loadview('laporannya.laporanizinusahapdf', compact('laporanizinusaha'));
        return $pdf->download('laporan_laporanizinusaha.pdf');
    }
}
