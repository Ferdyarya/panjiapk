<?php

namespace App\Http\Controllers;

use PDF;
use App\Models\Mastercabang;
use Illuminate\Http\Request;
use App\Models\Pengadaanaudit;

class PengadaanauditController extends Controller
{
    public function index(Request $request)
    {
        if ($request->has('search')) {
            $pengadaanaudit = Pengadaanaudit::where('nmrsurat', 'LIKE', '%' . $request->search . '%')->paginate(10);
        } else {
            $pengadaanaudit = Pengadaanaudit::paginate(10);
        }
        return view('pengadaanaudit.index', [
            'pengadaanaudit' => $pengadaanaudit,
        ]);
    }

    public function create()
    {
        $mastercabang = Mastercabang::all();
        return view('pengadaanaudit.create', [
            'mastercabang' => $mastercabang,
        ]);
        return view('pengadaanaudit.create')->with('success', 'Data Telah ditambahkan');
    }

    public function store(Request $request)
    {
        $data = $request->all();

        $data['nmrsurat'] = $this->generateKodeSurat();

        Pengadaanaudit::create($data);

        return redirect()->route('pengadaanaudit.index')->with('success', 'Data telah ditambahkan');
    }

    public function generateKodeSurat()
    {
        $latestSurat = Pengadaanaudit::orderBy('created_at', 'desc')->first();

        if (!$latestSurat) {
            return 'SRT-AUD-001';
        }

        $lastKode = $latestSurat->nmrsurat;
        $lastNumber = (int) substr($lastKode, -3);

        $newNumber = $lastNumber + 1;
        $newKode = 'SRT-AUD-' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);

        return $newKode;
    }

    public function show($id) {}

    public function edit(Pengadaanaudit $pengadaanaudit)
    {
        $mastercabang = Mastercabang::all();

        return view('pengadaanaudit.edit', [
            'item' => $pengadaanaudit,
            'mastercabang' => $mastercabang,
        ]);
    }

    public function update(Request $request, $id)
    {
        $pengadaanaudit = Pengadaanaudit::findOrFail($id);

        $data = $request->all();

        $pengadaanaudit->update($data);

        return redirect()->route('pengadaanaudit.index')->with('success', 'Data Telah diupdate');
    }

    public function destroy(Pengadaanaudit $pengadaanaudit)
    {
        $pengadaanaudit->delete();
        return redirect()->route('pengadaanaudit.index')->with('success', 'Data Telah dihapus');
    }

    // public function pengadaanauditpdf()
    // {
    //     $data = Pengadaanaudit::all();

    //     $pdf = PDF::loadview('pengadaanaudit/pengadaanauditpdf', ['pengadaanaudit' => $data]);
    //     return $pdf->download('laporan_Bukupengadaanaudit.pdf');
    // }

    // Laporan Buku pengadaanaudit Filter
    public function cetakpengadaanauditpertanggal()
    {
        $pengadaanaudit = Pengadaanaudit::Paginate(10);

        return view('laporannya.laporanpengadaanaudit', ['laporanpengadaanaudit' => $pengadaanaudit]);
    }

    public function filterdatepengadaanaudit(Request $request)
    {
        $startDate = $request->input('dari');
        $endDate = $request->input('sampai');

        if ($startDate == '' && $endDate == '') {
            $laporanpengadaanaudit = Pengadaanaudit::paginate(10);
        } else {
            $laporanpengadaanaudit = Pengadaanaudit::whereDate('tanggal', '>=', $startDate)->whereDate('tanggal', '<=', $endDate)->paginate(10);
        }
        session(['filter_start_date' => $startDate]);
        session(['filter_end_date' => $endDate]);

        return view('laporannya.laporanpengadaanaudit', compact('laporanpengadaanaudit'));
    }

    public function laporanpengadaanauditpdf(Request $request)
    {
        $startDate = session('filter_start_date');
        $endDate = session('filter_end_date');

        if ($startDate == '' && $endDate == '') {
            $laporanpengadaanaudit = Pengadaanaudit::all();
        } else {
            $laporanpengadaanaudit = Pengadaanaudit::whereDate('tanggal', '>=', $startDate)->whereDate('tanggal', '<=', $endDate)->get();
        }

        // Render view dengan menyertakan data laporan dan informasi filter
        $pdf = PDF::loadview('laporannya.laporanpengadaanauditpdf', compact('laporanpengadaanaudit'));
        return $pdf->download('laporan_laporanpengadaanaudit.pdf');
    }
}
