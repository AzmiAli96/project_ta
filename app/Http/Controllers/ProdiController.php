<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Jurusan;
use App\Models\prodi;
use Illuminate\Http\Request;

class ProdiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $prodi=prodi::latest()->paginate(10);
        return view ('prodi.index', ['prodis'=>$prodi]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $availableDosens = Dosen::whereDoesntHave('Dkaprodi')
            ->whereDoesntHave('Dsekjur')
            ->whereDoesntHave('Dkajur')
            ->get();
        return view('prodi.create',['jurusans'=>Jurusan::all(),'dosens'=>Dosen::all()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_prodi' => 'required|unique:prodis',
            'jenjang' => 'required',
            'nama_prodi' => 'required',
            'jurusan_id' => 'required',
            'kaprodi' => 'nullable|exists:dosens,id|different:kajur,',
        ]);

        $errors = [];

        $kaprodiDosen = Dosen::find($request->kaprodi);
        if ($kaprodiDosen && ($kaprodiDosen->Dkaprodi || $kaprodiDosen->Dsekjur || $kaprodiDosen->Dkajur)) {
            $errors['kaprodi'] = 'Dosen ini sudah memiliki peran lain.';
        }

        if (!empty($errors)) {
            return redirect()->back()->withErrors($errors)->withInput();
        }

        prodi::create($request->all());
        return redirect()->route('prodi.index')->with('success', 'prodi berhasil dibuat.');

    }

    /**
     * Display the specified resource.
     */
    public function show(prodi $prodi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('prodi.edit',['jurusan'=>Jurusan::all(),'dosen'=>Dosen::all(),'prodi'=>prodi::find($id)]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'nama'=> 'required',
            'jurusan_id'=>'required',
            'kaprodi'=>'required',
        ]);
        prodi::where('id',$id)->update($validated);
        return redirect('/prodi')->with('pesan', 'berhasil di-update.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        prodi::destroy($id);
        return redirect('/prodi')->with('pesan', 'Berhasil Dihapuskan.');
    }
}
