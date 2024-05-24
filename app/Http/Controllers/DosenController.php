<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use Illuminate\Http\Request;

class DosenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dosens=Dosen::latest()->paginate(10);
        return view('dosen.index',['dsn'=>$dosens]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('mahasiswa.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nidn'=> 'required|unique:dsn',
            'nama'=>'required|min:3',
            'email'=>'required',
            'password'=>'required',
            'no_telp'=>'required',
            'level'=>'required',
            'alamat'=>'required',
        ]);

        Dosen::create($validated);
        return redirect('/dosen')->with('pesan', 'berhasil menyimpan data.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Dosen $dosen)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Dosen $dosen)
    {
        return view('mahasiswa.edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'nidn'=> 'required|unique:dsn',
            'nama'=>'required|min:3',
            'email'=>'required',
            'password'=>'required',
            'no_telp'=>'required',
            'level'=>'required',
            'alamat'=>'required',
        ]);

        Dosen::where('id',$id)->update($validated);
        return redirect('/dosen')->with('pesan', 'berhasil menyimpan data.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Dosen::destroy($id);
        return redirect('/dosen')->with('pesan', 'Berhasil Dihapuskan.');
    }
}
