<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Jurusan;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class JurusanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jurusan=Jurusan::latest()->paginate(10);
        return view ('jurusan.index', ['jurusans'=>$jurusan]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('jurusan.create',['dosens'=>Dosen::all()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode_jurusan'=>'required',
            'nama_jurusan'=>'required',
            'kajur'=>'nullable|exists:dosens,id|different:sekjur',
            'sekjur'=>'nullable|exists:dosens,id|different:kajur',
        ]);
        Jurusan::create($validated);
        return redirect('/jurusan')->with('pesan', 'berhasil menyimpan data.');

    }

    /**
     * Display the specified resource.
     */
    public function show(Jurusan $jurusan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('jurusan.edit',['dosens'=>Dosen::all()],['jurusan'=>Jurusan::find($id)]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, String $id)
    {
        $data = Jurusan::find($id);
        $validated = $request->validate([
            'kode_jurusan' => 'required|'. Rule::unique('jurusans')->ignore($data),
            'nama_jurusan' => 'required',
            'kajur' => 'nullable|exists:dosens,id|different:sekjur',
            'sekjur' => 'nullable|exists:dosens,id|different:kajur',
        ]);
        Jurusan::where('id',$id)->update($validated);
        return redirect('/jurusan')->with('pesan', 'Data Berhasil di-update.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(String $id)
    {
        Jurusan::destroy($id);
        return redirect('/jurusan')->with('pesan', 'Berhasil Dihapuskan.');
    }
}
