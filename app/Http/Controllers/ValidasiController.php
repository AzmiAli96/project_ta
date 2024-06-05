<?php

namespace App\Http\Controllers;

use App\Models\TA;
use App\Models\Validasi;
use Illuminate\Http\Request;

class ValidasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $validasi=Validasi::latest()->paginate(10);
        return view ('validasi.index', ['validasis'=>$validasi]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('validasi.create',['tas'=>TA::all()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'ta_id' => 'required',
            'komentar' => 'required',
            'status' => 'required',
            ]);
        Validasi::create($validated);
        return redirect('/validasi')->with('pesan', 'berhasil menyimpan data.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Validasi $validasi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(String $id)
    {
        return view('validasi.edit',['tas'=>TA::all(),'validasis'=>Validasi::find($id)]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, String $id)
    {
        $validated = $request->validate([
            'ta_id' => 'required',
            'komentar' => 'required',
            'status' => 'required',
            
        ]);
        Validasi::where('id',$id)->update($validated);
        return redirect('/validasi')->with('pesan', 'berhasil di-update.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Validasi::destroy($id);
        return redirect('/validasi')->with('pesan', 'Berhasil Dihapuskan.');
    }
}
