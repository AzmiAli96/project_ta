<?php

namespace App\Http\Controllers;

use App\Models\Ruangan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RuanganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ruangan=Ruangan::latest()->paginate(10);
        return view ('ruangan.index', ['ruangans'=>$ruangan]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('ruangan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_ruangan'=> 'required',
        ]);
        $ruang=Ruangan::create($validated);
        activity()->causedBy(Auth::user())->log('User ' . auth()->user()->name . ' berhasil menambahkan ruangan dengan ID ' . $ruang->id);

        return redirect('/ruangan')->with('pesan', 'berhasil menyimpan data.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Ruangan $ruangan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('ruangan.edit',['ruangan'=>ruangan::find($id)]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'nama_ruangan'=> 'required',
        ]);
        Ruangan::where('id',$id)->update($validated);
        activity()->causedBy(Auth::user())->log('User ' . auth()->user()->name . ' berhasil mengupdate ruangan dengan ID ' . $id);

        return redirect('/ruangan')->with('pesan', 'berhasil di-update.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Ruangan::destroy($id);
        activity()->causedBy(Auth::user())->log('User ' . auth()->user()->name . ' berhasil menghapus ruangan dengan ID ' . $id);

        return redirect('/ruangan')->with('pesan', 'Berhasil Dihapuskan.');
    }
}
