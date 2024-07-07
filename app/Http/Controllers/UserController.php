<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Mahasiswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if($request->has('search')){
            $user=User::latest()
            ->where('name','LIKE','%'.$request->search.'%')
            ->orWhere('email','LIKE','%'.$request->search.'%')
            ->orWhere('level','LIKE','%'.$request->search.'%')

            ->paginate(10);
        }
        else{
        $user = User::latest()->paginate(10);
        }
        return view('user.index', ['users' => $user]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'username' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
            'level' => 'required'
        ];

        $request->validate($rules);

        $data = [
            'name' => str_replace(' ', '_', strtolower($request->username)),
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'level' => $request->level,
        ];

        User::create($data);
        $userID = User::latest()->first();

        if (in_array($request->level, ['Dosen', 'Kaprodi'])) {
            Dosen::find($request->nidn)->update(['user_id' => $userID->id]);
        }

        if ($request->level == 'Mahasiswa') {
            Mahasiswa::where('id', $request->nobp)->update(['user_id' => $userID->id]);
        }

        activity()->causedBy(Auth::user())->log('User ' . auth()->user()->name . ' berhasil menyimpan data user dengan ID ' . $userID->id);

        return redirect('/user')->with('success', 'Berhasil menambahkan user');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $rules = [
            'username' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'level' => 'required'
        ];

        if ($request->password) {
            $rules['password'] = 'required|min:8';
        }

        $request->validate($rules);

        $data = [
            'name' => str_replace(' ', '_', strtolower($request->username)),
            'email' => $request->email,
            'level' => $request->level,
        ];

        if ($request->password) {
            $data['password'] = bcrypt($request->password);
        }

        $user->update($data);

        if (in_array($request->level, ['Dosen'])) {
            Dosen::where('nidn', $request->nidn)->update(['user_id' => $user->id]);
        }

        if ($request->level == 'Mahasiswa') {
            Mahasiswa::where('id', $request->nobp)->update(['user_id' => $user->id]);
        }

        activity()->causedBy(Auth::user())->log('User ' . auth()->user()->name . ' berhasil mengupdate data user dengan ID ' . $user->id);

        return redirect('/user')->with('success', 'Berhasil mengupdate user');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        User::destroy($id);
        activity()->causedBy(Auth::user())->log('User ' . auth()->user()->name . ' berhasil menghapus data user dengan ID ' . $id);

        return redirect('/user')->with('pesan', 'Berhasil Dihapuskan.');
    }
}
