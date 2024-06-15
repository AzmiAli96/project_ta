<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Mahasiswa;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = User::latest()->paginate(10);
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
            'email' => 'required|email',
            'password' => 'required|min:8',
            'level' => 'required|exists:users,level'
        ];
        $request->validate($rules);
        $data = [
            'name' => str_replace('', '_', strtolower($request->username)),
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
            if (User::create($data)) {
                Mahasiswa::find($request->nobp)->update(['user_id' => $userID->id]);
            }
        }

        return redirect('/user')->with('success', 'berhasil menambahkan user');
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
