<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Mahasiswa;
use App\Models\TA;
use Illuminate\Http\Request;

class TAController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ta=TA::with(['mahasiswa', 'Dpembimbing1', 'Dpembimbing2'])->latest()->paginate(10);
        return view ('ta.index', ['tas'=>$ta]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $availableDosens = Dosen::whereDoesntHave('Ppembimbing1')
            ->whereDoesntHave('Ppembimbing2')
            ->get();
        return view('ta.create',compact('availableDosens'),['mahasiswas'=>Mahasiswa::all(),'dosens'=>Dosen::all()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nobp' => 'required',
            'judul' => 'required',
            'dokumen' => 'required',
            'pembimbing1' => 'required|exists:dosens,id|different:pembimbing2',
            'pembimbing2' => 'required|exists:dosens,id|different:pembimbing1',
        ]);
        $errors = [];

        $dosenp1 = Dosen::find($request->pembimbing1);
        if ($dosenp1 && ($dosenp1->Ppembimbing1 || $dosenp1->Ppembimbing2 )) {
            $errors['pembimbing1'] = 'Dosen ini sudah memiliki peran lain.';
        }
        $dosenp2 = Dosen::find($request->pembimbing2);
        if ($dosenp2 && ($dosenp2->Ppembimbing2 || $dosenp2->Ppembimbing1 )) {
            $errors['pembimbing2'] = 'Dosen ini sudah memiliki peran lain.';
        }
        if (!empty($errors)) {
            return redirect()->back()->withErrors($errors)->withInput();
        }


        TA::create($request->all());
        return redirect('/ta')->with('pesan', 'berhasil menyimpan data.');
    }

    /**
     * Display the specified resource.
     */
    public function show(TA $tA)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(String $id)
    {
        return view('ta.edit',['mahasiswas'=>Mahasiswa::all(),'dosen'=>Dosen::all(),'tas'=>TA::find($id)]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, String $id)
    {
        $validated = $request->validate([
            'nobp' => 'required',
            'judul' => 'required',
            'dokumen' => 'required',
            'pembimbing1' => 'required',
            'pembimbing2' => 'required',
        ]);
        TA::where('id',$id)->update($validated);
        return redirect('/ta')->with('pesan', 'berhasil di-update.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(String $id)
    {
        TA::destroy($id);
        return redirect('/ta')->with('pesan', 'Berhasil Dihapuskan.');
    }
}
