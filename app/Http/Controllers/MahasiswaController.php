<?php

namespace App\Http\Controllers;

use App\Exports\MahasiswaExport;
use App\Imports\MahasiswaImport;
use App\Models\Jurusan;
use App\Models\Mahasiswa;
use App\Models\prodi;
use App\Models\Status;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $mahasiswa=Mahasiswa::latest()->pencarian()->paginate(10);
        return view ('mahasiswa.index', ['mahasiswas'=>$mahasiswa]);
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('mahasiswa.create',['prodis'=>prodi::all(),'jurusans'=>Jurusan::all()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $validated = $request->validate([
        //     'no_bp'=> 'required|unique:mahasiswas',
        //     'user_id'=>'required',
        //     'prodi_id'=>'required',
        //     'ipk'=>'required',
        //     'status_id'=>'required',
        // ]);

        $users = User::create([
            'name'=>$request->firstname.' '.$request->lastname,
            'email'=>$request->email,
            'level'=>$request->level,
            'password'=>Hash::make($request->password),
        ]);
        $mahasiswa = Mahasiswa::create([
            'nobp'=>$request->nobp,
            'user_id'=>$users->id,
            'jurusan_id'=>$request->jurusan_id,
            'prodi_id'=>$request->prodi_id,
            
        ]);
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
        return view('mahasiswa.edit',['prodis'=>prodi::all(),'jurusans'=>Jurusan::all(),'mahasiswa'=>Mahasiswa::find($id)]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedU = $request->validate([
            'name'=> 'required',
            'email'=>'required',
            'password'=>'required',
        ]);
        User::where('id',Mahasiswa::findOrFail($id)->user->id)->update($validatedU);

        $validatedM = $request->validate([
            'nobp'=> 'required',
            'jurusan_id'=>'required',
            'prodi_id'=>'required',
            'ips'=>'nullable',
            // 'status_id'=>'required',
        ]);
        
        Mahasiswa::where('id',$id)->update($validatedM);
        return redirect('/mahasiswa')->with('pesan', 'Data Berhasil di-edit.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        User::destroy(Mahasiswa::findOrFail($id)->user->id);
        Mahasiswa::destroy($id);
        return redirect('/mahasiswa')->with('pesan', 'Berhasil Dihapuskan.');
    }

    public function export()
    {
        return Excel::download(new MahasiswaExport(), 'Mahasiswa.xlsx');
    }

    public function import()
    {
        Excel::import(new MahasiswaImport, request()->file('file'));
    }
}
