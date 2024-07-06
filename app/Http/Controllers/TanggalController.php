<?php

namespace App\Http\Controllers;

use App\Models\Ruangan;
use App\Models\Sesi;
use App\Models\tanggal;
use Illuminate\Http\Request;

class TanggalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tanggal=tanggal::latest()->paginate(10);
        return view ('tanggal.index', ['tgls'=>$tanggal]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tanggal.create',['sesis'=>Sesi::all(),'ruangans'=>Ruangan::all()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'tanggal'=> 'required',
            'sesi_id'=> 'required',
            'ruangan_id'=> 'required',
            // 'status'=> 'required',
        ]);
        tanggal::create($validated);
        return redirect('/tanggal')->with('pesan', 'berhasil menyimpan data.');
    }

    /**
     * Display the specified resource.
     */
    public function show(tanggal $tanggal)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('tanggal.edit',['sesis'=>Sesi::all(),'ruangans'=>Ruangan::all(),'tanggal'=>tanggal::find($id)]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'tanggal'=> 'required',
            'sesi_id'=> 'required',
            'ruangan_id'=> 'required',
            // 'status'=> 'required',
        ]);
        tanggal::where('id',$id)->update($validated);
        return redirect('/tanggal')->with('pesan', 'berhasil di-update.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        tanggal::destroy($id);
        return redirect('/tanggal')->with('pesan', 'Berhasil Dihapuskan.');
    }
}
