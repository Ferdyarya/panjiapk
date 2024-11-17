<?php

namespace App\Http\Controllers;

use App\Models\Suratpusat;
use Illuminate\Http\Request;

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
        return view('suratpusat.create')->with('success', 'Data Telah ditambahkan');
    }


    public function store(Request $request)
{
    // Validasi permintaan
    $request->validate([
        'asalsurat' => 'required|string',
        'tujuan_surat' => 'required|string',
        'tentangsurat' => 'required|string',
        'filesurat' => 'file|mimes:pdf',
        'klasifikasi' => 'required|string',
    ]);

    // Generate kode surat
    $kodeSurat = $this->generateKodeSurat();

    // Persiapkan data untuk disimpan
    $data = $request->all();
    $data['kodesurat'] = $kodeSurat;

    // Menangani file surat jika ada
    if ($request->hasFile('filesurat')) {
        $fileName = $request->file('filesurat')->getClientOriginalName();
        $request->file('filesurat')->move(public_path('filesurat'), $fileName);
        $data['filesurat'] = $fileName;
    }

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
        return view('suratpusat.edit', [
            'item' => $suratpusat
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
}
