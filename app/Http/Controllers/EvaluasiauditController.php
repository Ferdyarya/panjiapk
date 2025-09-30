<?php

namespace App\Http\Controllers;

use PDF;
use App\Models\Mastercabang;
use Illuminate\Http\Request;
use App\Models\Evaluasiaudit;

class EvaluasiauditController extends Controller
{
    public function index(Request $request)
    {
        if ($request->has('search')) {
            $evaluasiaudit = Evaluasiaudit::where('nmrsurat', 'LIKE', '%' . $request->search . '%')->paginate(10);
        } else {
            $evaluasiaudit = Evaluasiaudit::paginate(10);
        }
        return view('evaluasiaudit.index', [
            'evaluasiaudit' => $evaluasiaudit,
        ]);
    }

    public function create()
    {
        $mastercabang = Mastercabang::all();
        return view('evaluasiaudit.create', [
            'mastercabang' => $mastercabang,
        ]);
        return view('evaluasiaudit.create')->with('success', 'Data Telah ditambahkan');
    }

    public function store(Request $request)
    {
        $data = $request->all();

        $data['nmrsurat'] = $this->generateKodeSurat();

        Evaluasiaudit::create($data);

        return redirect()->route('evaluasiaudit.index')->with('success', 'Data telah ditambahkan');
    }

    public function generateKodeSurat()
    {
        $latestSurat = Evaluasiaudit::orderBy('created_at', 'desc')->first();

        if (!$latestSurat) {
            return 'SRT-EVA-001';
        }

        $lastKode = $latestSurat->nmrsurat;
        $lastNumber = (int) substr($lastKode, -3);

        $newNumber = $lastNumber + 1;
        $newKode = 'SRT-EVA-' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);

        return $newKode;
    }

    public function show($id) {}

    public function edit(Evaluasiaudit $evaluasiaudit)
    {
        $mastercabang = Mastercabang::all();

        return view('evaluasiaudit.edit', [
            'item' => $evaluasiaudit,
            'mastercabang' => $mastercabang,
        ]);
    }

    public function update(Request $request, $id)
    {
        $evaluasiaudit = Evaluasiaudit::findOrFail($id);

        $data = $request->all();

        $evaluasiaudit->update($data);

        return redirect()->route('evaluasiaudit.index')->with('success', 'Data Telah diupdate');
    }

    public function destroy(Evaluasiaudit $evaluasiaudit)
    {
        $evaluasiaudit->delete();
        return redirect()->route('evaluasiaudit.index')->with('success', 'Data Telah dihapus');
    }

    // public function evaluasiauditpdf()
    // {
    //     $data = Evaluasiaudit::all();

    //     $pdf = PDF::loadview('evaluasiaudit/evaluasiauditpdf', ['evaluasiaudit' => $data]);
    //     return $pdf->download('laporan_Bukuevaluasiaudit.pdf');
    // }

    // Laporan Buku evaluasiaudit Filter
    public function cetakevaluasiauditpertanggal()
    {
        $evaluasiaudit = Evaluasiaudit::Paginate(10);

        return view('laporannya.laporanevaluasiaudit', ['laporanevaluasiaudit' => $evaluasiaudit]);
    }

    public function filterdateevaluasiaudit(Request $request)
    {
        $startDate = $request->input('dari');
        $endDate = $request->input('sampai');

        if ($startDate == '' && $endDate == '') {
            $laporanevaluasiaudit = Evaluasiaudit::paginate(10);
        } else {
            $laporanevaluasiaudit = Evaluasiaudit::whereDate('tanggal', '>=', $startDate)->whereDate('tanggal', '<=', $endDate)->paginate(10);
        }
        session(['filter_start_date' => $startDate]);
        session(['filter_end_date' => $endDate]);

        return view('laporannya.laporanevaluasiaudit', compact('laporanevaluasiaudit'));
    }

    public function laporanevaluasiauditpdf(Request $request)
    {
        $startDate = session('filter_start_date');
        $endDate = session('filter_end_date');

        if ($startDate == '' && $endDate == '') {
            $laporanevaluasiaudit = Evaluasiaudit::all();
        } else {
            $laporanevaluasiaudit = Evaluasiaudit::whereDate('tanggal', '>=', $startDate)->whereDate('tanggal', '<=', $endDate)->get();
        }

        // Render view dengan menyertakan data laporan dan informasi filter
        $pdf = PDF::loadview('laporannya.laporanevaluasiauditpdf', compact('laporanevaluasiaudit'));
        return $pdf->download('laporan_laporanevaluasiaudit.pdf');
    }
}
