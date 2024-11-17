<?php

namespace App\Http\Controllers;

use PDF;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Masteranggota;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class MasteranggotaController extends Controller
{
    public function index(Request $request)
    {
        $query = Masteranggota::query();

        // Filter pencarian
        if ($request->has('search')) {
            $query->where('judul', 'LIKE', '%' . $request->search . '%');
        }
        // Role-based filtering
        if (Auth::user()->roles == 'petugas') {
            $query->where('id_anggota', Auth::id());
        }

        $masteranggota = $query->paginate(10);

        return view('masteranggota.index', compact('masteranggota'));
    }


    public function create()
    {
         // Memfilter pengguna yang memiliki role 'petugas'
        $user = User::all();
        $user = User::where('roles', 'petugas')->get();

        return view('masteranggota.create', [
            'user' => $user,
        ]);
        return view('masteranggota.create');
    }


    public function store(Request $request)
    {
        $data = $request->all();

        Masteranggota::create($data);

        return redirect()->route('masteranggota.index')->with('success', 'Data Telah ditambahkan');
    }


    public function show($id)
    {

    }


    public function edit($id)
    {
        $user = User::all();
        // Memfilter pengguna yang memiliki role 'petugas'
        $user = User::where('roles', 'petugas')->get();
        $masteranggota = Masteranggota::find($id);
        return view('masteranggota.edit', [
            'item' => $masteranggota,
            'user' => $user,
        ]);

    }


    public function update(Request $request, $id)
{
    $masteranggota = Masteranggota::findOrFail($id);

    $data = $request->all();

    $masteranggota->update($data);

    return redirect()->route('masteranggota.index')->with('success', 'Data Telah diupdate');
}


    public function destroy($id)
    {
        $masteranggota = Masteranggota::find($id);
        $masteranggota->delete();

        return redirect()->route('masteranggota.index')->with('success', 'Data Telah dihapus');
    }

    // public function masteranggotapdf() {
    //     $data = Masteranggota::all();

    //     $pdf = PDF::loadview('masteranggota/masteranggotapdf', ['masteranggota' => $data]);
    //     return $pdf->download('laporan_masteranggota.pdf');
    // }

    public function verify($id)
{
    $item = Masteranggota::findOrFail($id);

    // Pastikan hanya bisa diverifikasi jika status belum diverifikasi
    if ($item->status !== 'verifikasi') {
        $item->status = 'verifikasi';
        $item->save();
    }

    return redirect()->route('masteranggota.index')->with('success', 'Data berhasil diverifikasi.');
}

    // Report Pernama
    public function perkelas(Request $request)
{
    // Ambil filter dari request, defaultnya adalah null
    $filter = $request->query('filter', null);

    // Ambil data peminjaman berdasarkan filter
    if ($filter === 'all' || empty($filter)) {
        $laporananggota = Masteranggota::paginate(10);
    } else {
        $laporananggota = Masteranggota::where('kelas', $filter)->paginate(10);
    }

    // Ambil data agregat
    $idAnggotaCounts = Masteranggota::select('kelas', DB::raw('count(*) as count'))
        ->groupBy('kelas')
        ->orderBy('kelas')
        ->get();

    // Ambil data master anggota
    $masteranggota = MasterAnggota::all();

    return view('laporannya.laporananggota', [
        'laporananggota' => $laporananggota,
        'idAnggotaCounts' => $idAnggotaCounts,
        'filter' => $filter,
        'masteranggota' => $masteranggota,
    ]);
}

    // Fungsi untuk mencetak PDF
    public function cetakPerkelasPdf(Request $request)
{
    $filter = $request->query('filter', null);

    // Handle filtering
    if ($filter === 'all' || empty($filter)) {
        $laporananggota = Masteranggota::all();
    } else {
        $laporananggota = Masteranggota::where('kelas', $filter)->get();
    }

    // Get aggregated data
    $idAnggotaCounts = Masteranggota::groupBy('kelas')
        ->orderBy('kelas')
        ->select(DB::raw('count(*) as count, kelas'))
        ->get();

    // Load view and convert to PDF
    $pdf = PDF::loadView('laporannya.laporananggotapdf', [
        'laporananggota' => $laporananggota,
        'idAnggotaCounts' => $idAnggotaCounts,
        'filter' => $filter,
    ]);

    // Return the generated PDF as a download
    return $pdf->download('laporan_pendaftaran_member_perpustakaan.pdf');
}

}
