<?php

namespace App\Http\Controllers;

use App\Models\Nilai;
use App\Models\Penjumlahan;
use Illuminate\Http\Request;

class PenjumlahanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $penjumlahan=Penjumlahan::latest()->paginate(10);
        return view ('nilai.index', ['penjumlahans'=>$penjumlahan]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(string $id)
    {
        return view('nilai.D4',['nilais'=>Nilai::all(),'penjumlahan'=>Penjumlahan::find($id)]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nilai_id'=> 'required',
            'n1'=> 'nullable',
            'n2'=> 'nullable',
            'n3'=> 'nullable',
            'n4'=> 'nullable',
            'n5'=> 'nullable',
            'n6'=> 'nullable',
            'n7'=> 'nullable',
            'n8'=> 'nullable',
            'n9'=> 'nullable',
            'n10'=> 'nullable',
            'ket'=> 'required',
        ]);
        Penjumlahan::create($validated);
        return redirect('/nilai')->with('pesan', 'berhasil menyimpan data.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Penjumlahan $penjumlahan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('nilai.D3')->with(['nilais'=>Nilai::all(),'penjumlahan'=>Penjumlahan::find($id)]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, String $id)
    {
        $validated = $request->validate([
            'nilai_id'=> 'required',
            'n1'=> 'nullable',
            'n2'=> 'nullable',
            'n3'=> 'nullable',
            'n4'=> 'nullable',
            'n5'=> 'nullable',
            'n6'=> 'nullable',
            'n7'=> 'nullable',
            'n8'=> 'nullable',
            'n9'=> 'nullable',
            'n10'=> 'nullable',
            'ket'=> 'required',
        ]);
        Penjumlahan::where('id',$id)->update($validated);
        return redirect('/nilai')->with('pesan', 'berhasil di-update.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Penjumlahan::destroy($id);
        return redirect('/nilai')->with('pesan', 'Berhasil Dihapuskan.');
    }
}
