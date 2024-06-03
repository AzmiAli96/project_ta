<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Jurusan;
use Illuminate\Http\Request;

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
        $availableDosens = Dosen::whereDoesntHave('Dkajur')
            ->whereDoesntHave('Dsekjur')
            ->whereDoesntHave('Dkaprodi')
            ->get();
        return view('jurusan.create',compact('availableDosens'),['dosens'=>Dosen::all()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $validated = $request->validate([
        //     'nama_jurusan'=>'required',
        //     'kajur'=>'required',
        //     'sekjur'=>'required',
        // ]);
        // Jurusan::create($validated);
        // return redirect('/jurusan')->with('pesan', 'berhasil menyimpan data.');

        $request->validate([
            'kode_jurusan' => 'required|unique:jurusans',
            'nama_jurusan' => 'required',
            'kajur' => 'nullable|exists:dosens,id|different:sekjur',
            'sekjur' => 'nullable|exists:dosens,id|different:kajur',
        ]);

        // // Ensure the dosen is not already assigned a different role
        // $kajurDosen = Dosen::find($request->kajur);
        // if ($kajurDosen && ($kajurDosen->Dsekjur || $kajurDosen->Dkajur)) {
        //     return back()->withErrors(['kajur' => 'Dosen ini sudah memiliki peran lain.']);
        // }

        // $sekjurDosen = Dosen::find($request->sekjur);
        // if ($sekjurDosen && ($sekjurDosen->Dsekjur || $sekjurDosen->Dkajur)) {
        //     return back()->withErrors(['sekjur' => 'Dosen ini sudah memiliki peran lain.']);
        // }
        $errors = [];

        // Ensure the dosen is not already assigned a different role
        $kajurDosen = Dosen::find($request->kajur);
        if ($kajurDosen && ($kajurDosen->Dkajur || $kajurDosen->Dsekjur || $kajurDosen->Dkaprodi)) {
            $errors['kajur'] = 'Dosen ini sudah memiliki peran lain.';
        }

        $sekjurDosen = Dosen::find($request->sekjur);
        if ($sekjurDosen && ($sekjurDosen->Dkajur || $sekjurDosen->Dsekjur || $sekjurDosen->Dkaprodi)) {
            $errors['sekjur'] = 'Dosen ini sudah memiliki peran lain.';
        }

        if (!empty($errors)) {
            return redirect()->back()->withErrors($errors)->withInput();
        }

        Jurusan::create($request->all());

        // return redirect('/jurusan')->back()->with('success', 'Jurusan berhasil dibuat.');
        return redirect()->route('jurusan.index')->with('success', 'Jurusan berhasil dibuat.');
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
        $validated = $request->validate([
            'kode_jurusan' => 'required|unique:jurusans',
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
