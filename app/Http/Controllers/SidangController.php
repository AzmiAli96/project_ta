<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Sidang;
use App\Models\TA;
use App\Models\tanggal;
use App\Models\Validasi;
use Illuminate\Http\Request;

class SidangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sidang=Sidang::with([
            'validasi'
        ])->latest()->paginate(10);
        return view ('sidang.index', ['sidangs'=>$sidang]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       $taTervalidasi = Validasi::with(['ta'])->where('status', '=', true)->get();

        return view('sidang.create',['validasis'=>$taTervalidasi,'tanggals'=>tanggal::all(),'dosens'=> Dosen::all()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'validasi_id' => 'required',
            'tanggal_id' => 'required',
            'sekr_sidang' => 'required',
            'anggota1' => 'required',
            'anggota2' => 'required',
        ]);

// $data = [
//     "validasi_id	tanggal_id	sekr_sidang	anggota1	anggota2"
// ];
        Sidang::create($validated);
        return redirect('/sidang')->with('pesan', 'berhasil menyimpan data.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Sidang $sidang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('sidang.edit',['validasis'=>Validasi::all(),'dosens'=>Dosen::all(),'tanggals'=>tanggal::all(),'sidang'=>Sidang::find($id)]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, String $id)
    {
        $validated = $request->validate([
            'validasi_id' => 'required',
            'tanggal_id' => 'required',
            'sekr_sidang' => 'required',
            'anggota_sidang' => 'required',
        ]);
        Sidang::where('id',$id)->update($validated);
        return redirect('/sidang')->with('pesan', 'berhasil di-update.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(String $id)
    {
        Sidang::destroy($id);
        return redirect('/sidang')->with('pesan', 'Berhasil Dihapuskan.');
    }
}
