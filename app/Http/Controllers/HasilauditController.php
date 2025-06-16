<?php

namespace App\Http\Controllers;

use PDF;
use App\Models\Hasilaudit;
use App\Models\Mastercabang;
use Illuminate\Http\Request;

class HasilauditController extends Controller
{
    public function index(Request $request)
    {
        if ($request->has('search')) {
            $hasilaudit = Hasilaudit::where('nmrsurat', 'LIKE', '%' . $request->search . '%')->paginate(10);
        } else {
            $hasilaudit = Hasilaudit::paginate(10);
        }
        return view('hasilaudit.index', [
            'hasilaudit' => $hasilaudit,
        ]);
    }

    public function create()
    {
        $mastercabang = Mastercabang::all();
        return view('hasilaudit.create', [
            'mastercabang' => $mastercabang,
        ]);
        return view('hasilaudit.create')->with('success', 'Data Telah ditambahkan');
    }

    public function store(Request $request)
    {
        $data = $request->all();

        $data['nmrsurat'] = $this->generateKodeSurat();

        Hasilaudit::create($data);

        return redirect()->route('hasilaudit.index')->with('success', 'Data telah ditambahkan');
    }

    public function generateKodeSurat()
    {
        $latestSurat = Hasilaudit::orderBy('created_at', 'desc')->first();

        if (!$latestSurat) {
            return 'SRT-HSL-001';
        }

        $lastKode = $latestSurat->nmrsurat;
        $lastNumber = (int) substr($lastKode, -3);

        $newNumber = $lastNumber + 1;
        $newKode = 'SRT-HSL-' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);

        return $newKode;
    }

    public function show($id) {}

    public function edit(Hasilaudit $hasilaudit)
    {
        $mastercabang = Mastercabang::all();

        return view('hasilaudit.edit', [
            'item' => $hasilaudit,
            'mastercabang' => $mastercabang,
        ]);
    }

    public function update(Request $request, $id)
    {
        $hasilaudit = Hasilaudit::findOrFail($id);

        $data = $request->all();

        $hasilaudit->update($data);

        return redirect()->route('hasilaudit.index')->with('success', 'Data Telah diupdate');
    }

    public function destroy(Hasilaudit $hasilaudit)
    {
        $hasilaudit->delete();
        return redirect()->route('hasilaudit.index')->with('success', 'Data Telah dihapus');
    }


    // Laporan Buku hasilaudit Filter
    public function cetakhasilauditpertanggal()
    {
        $hasilaudit = Hasilaudit::Paginate(10);

        return view('laporannya.laporanhasilaudit', ['laporanhasilaudit' => $hasilaudit]);
    }

    public function filterdatehasilaudit(Request $request)
    {
        $startDate = $request->input('dari');
        $endDate = $request->input('sampai');

        if ($startDate == '' && $endDate == '') {
            $laporanhasilaudit = Hasilaudit::paginate(10);
        } else {
            $laporanhasilaudit = Hasilaudit::whereDate('tanggal', '>=', $startDate)->whereDate('tanggal', '<=', $endDate)->paginate(10);
        }
        session(['filter_start_date' => $startDate]);
        session(['filter_end_date' => $endDate]);

        return view('laporannya.laporanhasilaudit', compact('laporanhasilaudit'));
    }

    public function laporanhasilauditpdf(Request $request)
    {
        $startDate = session('filter_start_date');
        $endDate = session('filter_end_date');

        if ($startDate == '' && $endDate == '') {
            $laporanhasilaudit = Hasilaudit::all();
        } else {
            $laporanhasilaudit = Hasilaudit::whereDate('tanggal', '>=', $startDate)->whereDate('tanggal', '<=', $endDate)->get();
        }

        // Render view dengan menyertakan data laporan dan informasi filter
        $pdf = PDF::loadview('laporannya.laporanhasilauditpdf', compact('laporanhasilaudit'));
        return $pdf->download('laporan_laporanhasilaudit.pdf');
    }
}
