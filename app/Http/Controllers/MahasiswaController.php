<?php

namespace App\Http\Controllers;

use App\Exports\MahasiswaExport;
use App\Imports\MahasiswaImport;
use App\Models\Mahasiswa;
use App\Models\prodi;
use App\Models\Status;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $mahasiswa=Mahasiswa::latest()->paginate(10);
        return view ('mahasiswa.index', ['mahasiswas'=>$mahasiswa]);
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('mahasiswa.create',['prodis'=>prodi::all()],['statuses'=>status::all()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'no_bp'=> 'required|unique:mahasiswas',
            'nama'=>'required|min:3',
            'email'=>'required',
            'password'=>'required',
            'prodi_id'=>'required',
            'ipk'=>'required',
            'status_id'=>'required',
        ]);

        Mahasiswa::create($validated);
        return redirect('/mahasiswa')->with('pesan', 'berhasil menyimpan data.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Mahasiswa $mahasiswa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('mahasiswa.edit',['prodis'=>prodi::all(),'statuses'=>status::all(),'mahasiswa'=>Mahasiswa::find($id)]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'no_bp'=> 'required',
            'nama'=>'required|min:3',
            'email'=>'required',
            'password'=>'required',
            'prodi_id'=>'required',
            'ipk'=>'required',
            'status_id'=>'required',
        ]);
        
        Mahasiswa::where('id',$id)->update($validated);
        return redirect('/mahasiswa')->with('pesan', 'Data Berhasil di-edit.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Mahasiswa::destroy($id);
        return redirect('/mahasiswa')->with('pesan', 'Berhasil Dihapuskan.');
    }

    public function export()
    {
        return Excel::download(new MahasiswaExport(), 'Mahasiswa.csv');
    }

    public function import()
    {
        Excel::import(new MahasiswaImport, request()->file('file'));
    }
}
