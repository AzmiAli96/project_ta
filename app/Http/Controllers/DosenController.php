<?php

namespace App\Http\Controllers;


use App\Exports\DosenExport;
use App\Imports\DosenImport;
use App\Models\Dosen;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;


class DosenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dosen=Dosen::latest()->pencarian()->paginate(10);
        return view('dosen.index',['dosens'=>$dosen]);
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
        // if ($request->code == '1234') {
            
            $users = User::create([
                'name'=>$request->firstname.' '.$request->lastname,
                'email'=>$request->email,
                'level'=>$request->level,
                'password'=>Hash::make($request->password),
            ]);
    
            $dosen = Dosen::create([
                'nidn'=>$request->nidn,
                'user_id'=>$users->id,
                'no_telp'=>$request->no_telp,
                'alamat'=>$request->alamat,            
            ]);
            activity()->causedBy(Auth::user())->log('User ' . auth()->user()->name . ' berhasil menyimpan data dosen dengan ID ' . $dosen->id);

            return redirect('/dosen')->with('pesan', 'berhasil menyimpan data.');
        // }
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
    public function edit(string $id)
    {
        return view('dosen.edit',['dosen'=>Dosen::find($id)]);
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
        User::where('id',Dosen::findOrFail($id)->user->id)->update($validatedU);

        $validated = $request->validate([
            'nidn'=> 'required',
            'no_telp'=>'required',
            'alamat'=>'required',
        ]);

        Dosen::where('id',$id)->update($validated);
        activity()->causedBy(Auth::user())->log('User ' . auth()->user()->name . ' berhasil mengupdate data dosen dengan ID ' . $id);

        return redirect('/dosen')->with('pesan', 'berhasil menyimpan data.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // User::destroy(Dosen::findOrFail($id)->user->id);
        Dosen::destroy($id);
        activity()->causedBy(Auth::user())->log('User ' . auth()->user()->name . ' berhasil menghapus data dosen dengan ID ' . $id);

        return redirect('/dosen')->with('pesan', 'Berhasil Dihapuskan.');
    }

    public function export()
    {
        return Excel::download(new DosenExport(), 'Dosen.xlsx');
    }

    public function import()
    {
        try {
            Excel::import(new DosenImport, request()->file('file'));
            return redirect('/dosen')->with('pesan', 'Berhasil mengimpor data dosen.');
        } catch (\Exception $e) {
            // Tangani kesalahan dan tambahkan pesan ke dalam session
            return redirect('/dosen')->with('error', 'Gagal mengimpor data dosen: ' . $e->getMessage());
        }
    }
}
