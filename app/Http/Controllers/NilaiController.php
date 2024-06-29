<?php

namespace App\Http\Controllers;

use App\Models\Nilai;
use App\Models\Penjumlahan;
use App\Models\Sidang;
use Illuminate\Http\Request;

class NilaiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sidang=Sidang::latest()->paginate(10);
        return view ('nilai.index', ['sidangs'=>$sidang]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // return view('nilai.create',['sidangs'=>Sidang::all()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $validated = $request->validate([
        //     'sidang_id'=> 'required',
        //     'nilai_ketua'=> 'nullable',
        //     'nilai_sekr'=> 'nullable',
        //     'nilai_ang1'=> 'nullable',
        //     'nilai_ang2'=> 'nullable',
        //     'nilai_akhir'=> 'nullable',
        //     'status'=> 'required',
        // ]);
        // Nilai::create($validated);
        // return redirect('/nilai')->with('pesan', 'berhasil menyimpan data.');
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
        // $sidang = Sidang::all();
        // $penjumlahan = Penjumlahan::all();
        $sidang = Sidang::find($id);
//  dd($sidang->validasi->ta->mahasiswa->prodi->jenjang);
        return view('nilai.edit',['sidang'=>$sidang, 'jenjang'=>$sidang->validasi->ta->mahasiswa->prodi->jenjang]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $nilai_id)
    {
        $validated = $request->validate([
            'sidang_id'=> 'required',
            'penilai'=> 'nullable',
            'n1'=> 'numeric',
            'n2'=> 'numeric',
            'n3'=> 'numeric',
            'n4'=> 'numeric',
            'n5'=> 'numeric',
            'n6'=> 'numeric',
            'n7'=> 'numeric',
            'n8'=> 'numeric',
            'n9'=> 'numeric',
            'n10'=> 'nullable',
        ],[
            'sidang_id'=> 'salah id',
            'penilai'=> 'salah penilai',
            'n1'=> 'salah 1',
            'n2'=> 'salah 2',
            'n3'=> 'salah 3',
            'n4'=> 'salah 4',
            'n5'=> 'salah 5',
            'n6'=> 'salah 6',
            'n7'=> 'salah 7',
            'n8'=> 'salah 8',
            'n9'=> 'salah 9',
            'n10'=> 'salah 10'
        ]);
        Nilai::where('id',$nilai_id)->update($validated);
        return redirect('/nilai')->with('pesan', 'berhasil di-update.');
    }

    public function berinilai($sidang_id, $penilai, $jenjang)
    {
        // Create a new Nilai record
        $nilai = Nilai::firstOrCreate(
            ['sidang_id' => $sidang_id, 'penilai' => $penilai],['status' => false]
        );
        // Return different views based on the jenjang value
        if ($jenjang == 'D4') {
            return view('nilai.D4', ['nilai' => $nilai]);
        } else {
            return view('nilai.D3', ['nilai' => $nilai]);
        }
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
