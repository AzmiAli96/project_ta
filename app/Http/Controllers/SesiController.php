<?php

namespace App\Http\Controllers;

use App\Models\Sesi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SesiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sesi=Sesi::latest()->paginate(10);
        return view ('sesi.index', ['sesis'=>$sesi]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('sesi.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'sesi'=> 'required',
            'waktu'=> 'required',
        ]);
        $sesi=Sesi::create($validated);
        activity()->causedBy(Auth::user())->log('User ' . auth()->user()->name . ' berhasil menambahkan sesi dengan ID ' . $sesi->id);

        return redirect('/sesi')->with('pesan', 'berhasil menyimpan data.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Sesi $sesi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('sesi.edit',['sesi'=>sesi::find($id)]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'sesi'=> 'required',
            'waktu'=> 'required',
        ]);
        Sesi::where('id',$id)->update($validated);
        activity()->causedBy(Auth::user())->log('User ' . auth()->user()->name . ' berhasil mengupdate sesi dengan ID ' . $id);

        return redirect('/sesi')->with('pesan', 'berhasil di-update.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Sesi::destroy($id);
        activity()->causedBy(Auth::user())->log('User ' . auth()->user()->name . ' berhasil menghapus sesi dengan ID ' . $id);

        return redirect('/sesi')->with('pesan', 'Berhasil Dihapuskan.');
    }
}
