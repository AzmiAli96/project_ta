<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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
        return view('dosen.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $users = User::create([
            'name'=>$request->firstname.' '.$request->lastname,
            'email'=>$request->email,
            'level'=>$request->level,
            'password'=>Hash::make($request->password),
        ]);

        $dosen = Dosen::create([
            'no_bp'=>$request->no_bp,
            'user_id'=>$users->id,
            'no_telp'=>$request->no_telp,
            'sebagai'=>$request->sebagai,
            'alamat'=>$request->alamat,            
        ]);

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
        return view('dosen.edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'nidn'=> 'required|unique:dsn',
            'user_id'=>'required',
            'no_telp'=>'required',
            'sebagai'=>'required',
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
