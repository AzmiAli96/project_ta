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
        if(in_array(auth()->user()->level, ['Admin', 'Kaprodi'])){
            $ta=TA::with(['mahasiswa', 'Dpembimbing1', 'Dpembimbing2'])->latest()->paginate(10);
            
        }else{
            $ta=TA::with(['mahasiswa', 'Dpembimbing1', 'Dpembimbing2'])->where('nobp', '=', auth()->user()->mahasiswa->nobp)->latest()->paginate(10);
        }
        return view ('ta.index', ['tas'=>$ta]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('ta.create',['mahasiswas'=>Mahasiswa::all(),'dosens'=>Dosen::all()]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nobp' => 'required|unique:t_a_s',
            'judul' => 'required',
            'dokumen' => 'required',
            'pembimbing1' => 'required|exists:dosens,id|different:pembimbing2',
            'pembimbing2' => 'required|exists:dosens,id|different:pembimbing1',
            // 'ket' => 'nullable',
            'komentar' => 'nullable',
            'status_p1' => 'required',
            'status_p2' => 'required',
            'status' => 'required',
        ]);

        if($request->hasFile('dokumen')){
            $file = $request->file('dokumen');
            $fileName = uniqid(). '-'. time().'.'. $file->getClientOriginalExtension();
            $file->storeAs('public/ta', $fileName);
        }

        TA::create([
            'nobp'=>$request->nobp,
            'judul'=>$request->judul,
            'dokumen'=>$fileName,
            'pembimbing1'=>$request->pembimbing1,
            'pembimbing2'=>$request->pembimbing2,
            // 'ket' => $request->ket,
            'komentar' => $request->komentar,
            'status_p1' => $request->status_p1,
            'status_p2' => $request->status_p2,
            'status' => $request->status,
        ]);
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
        return view('ta.edit',['mahasiswas'=>Mahasiswa::all(),'dosens'=>Dosen::all(),'ta'=>TA::find($id)]);
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
            'pembimbing1' => 'required|exists:dosens,id|different:pembimbing2',
            'pembimbing2' => 'required|exists:dosens,id|different:pembimbing1 ',
            // 'ket' => 'required',
            'komentar' => 'nullable',
            'status_p1' => 'required',
            'status_p2' => 'required',
            'status' => 'required',
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
