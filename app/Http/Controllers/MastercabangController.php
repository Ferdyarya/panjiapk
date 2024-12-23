<?php

namespace App\Http\Controllers;

use App\Models\Mastercabang;
use Illuminate\Http\Request;

class MastercabangController extends Controller
{
    public function index(Request $request)
    {
        if($request->has('search')){
            $mastercabang = Mastercabang::where('cabang', 'LIKE', '%' .$request->search.'%')->paginate(10);
        }else{
            $mastercabang = Mastercabang::paginate(10);
        }
        return view('mastercabang.index',[
            'mastercabang' => $mastercabang
        ]);
    }


    public function create()
    {
        return view('mastercabang.create');
    }

    public function store(Request $request)
    {
        $data = $request->all();

        Mastercabang::create($data);

        return redirect()->route('mastercabang.index')->with('success','Data Telah Ditambahkan');
    }


    public function show($id)
    {

    }


    public function edit(Mastercabang $mastercabang)
    {
        return view('mastercabang.edit', [
            'item' => $mastercabang
        ]);
    }


    public function update(Request $request, Mastercabang $mastercabang)
    {
        $data = $request->all();

        $mastercabang->update($data);

        //dd($data);

        return redirect()->route('mastercabang.index')->with('success', 'Data Telah diupdate');

    }


    public function destroy(Mastercabang $mastercabang)
    {
        $mastercabang->delete();
        return redirect()->route('mastercabang.index')->with('success', 'Data Telah dihapus');
    }
}
