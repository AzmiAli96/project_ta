<?php

namespace App\Http\Controllers;

use App\Models\Nilai;
use App\Models\Penjumlahan;
use App\Models\Sidang;
use Illuminate\Http\Request;

class NilayController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $nilai = Nilai::latest()->paginate(10);
        return view('nilay.index', ['nilais' => $nilai]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('nilai.create', ['sidangs' => Sidang::all()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'sidang_id' => 'required',
            'nilai_ketua' => 'nullable',
            'nilai_sekr' => 'nullable',
            'nilai_ang1' => 'nullable',
            'nilai_ang2' => 'nullable',
            'nilai_akhir' => 'nullable',
            'status' => 'required',
        ]);
        Nilai::create($validated);
        return redirect('/nilai')->with('pesan', 'berhasil menyimpan data.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Nilai $nilai)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $sidang = Sidang::all();
        $penjumlahan = Penjumlahan::all();
        $nilai = Nilai::find($id);
        return view('nilay.edit', [
            'sidangs' => $sidang,
            'penjumlahans' => $penjumlahan,
            'nilai' => $nilai,
            'jenjang' => $nilai->sidang->validasi->ta->mahasiswa->prodi->jenjang
        ]);
    }

    public function nilai(string $id)
    {
        return response()->json([
            'status' => 200,
            'data' => Penjumlahan::where('nilai_id',$id)->get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'sidang_id' => 'required',
            'nilai_ketua' => 'nullable',
            'nilai_sekr' => 'nullable',
            'nilai_ang1' => 'nullable',
            'nilai_ang2' => 'nullable',
            'nilai_akhir' => 'nullable',
            'status' => 'required',
        ]);
        Nilai::where('id', $id)->update($validated);
        return redirect('/nilay')->with('pesan', 'berhasil di-update.');
    }

    /**     
     * Remove the specified resource from storage.
     */
    public function destroy(String $id)
    {
        Nilai::destroy($id);
        return redirect('/nilai')->with('pesan', 'Berhasil Dihapuskan.');
    }
}
