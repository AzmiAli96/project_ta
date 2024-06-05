<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Jurusan;
use App\Models\Mahasiswa;
use App\Models\prodi;
use App\Models\Status;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    public function register()
    {
        return view('login.registerM', ['prodis' => prodi::all(), 'statuses' => Status::all(), 'jurusans' => Jurusan::all()]);
    }

    public function create(Request $request)
    {
        $validated = $request->validate([
            'firstname' => 'required',
            'email' => 'required|string|email|unique:users|max:255',
            'password' => 'required|string|min:8',
            'level' => 'required|in:Admin,Kaprodi,Mahasiswa,Dosen',
            // 'mahasiswa_id'=>'required',
            // 'dosen_id'=>'required',
        ], [
            'firstname.required' => 'Nama wajib diisi',
            'email.required' => 'Email wajib diisi',
            'level.required' => 'kolom wajib diisi',
            'email.email' => 'silahkan masukkan email yang valid',
            'email.unique' => 'Email sudah pernah digunakan, Silahkan gunakan Email lain',
            'password.required' => 'Password wajib diisi',
            'password.min' => 'Minimum password yang dimasukkan adalah 8',
        ]);

        $users = User::create([
            'name' => $request->firstname . ' ' . $request->lastname,
            'email' => $request->email,
            'level' => $request->level,
            'password' => Hash::make($request->password),
        ]);

        // if(!empty($request->nobp) || !empty($request->nidn)){
        //     $data['mahasiswa_id'] = $request->nim;
        //     $data['dosen_id'] = $request->nim;
        // }

        if ($request->level == 'Mahasiswa') {
            Mahasiswa::create([
                'nobp' => $request->nobp,
                'user_id' => $users->id,
                'jurusan_id' => $request->jurusan_id,
                'prodi_id' => $request->prodi_id,
                'judul' => $request->judul,
                'dokumen' => $request->dokumen,
                'status_id' => $request->status_id,
            ]);
        } else if ($request->level == 'Dosen') {
            Dosen::create([
                'nidn' => $request->nidn,
                'user_id' => $users->id,
                'no_telp' => $request->no_telp,
                'alamat' => $request->alamat,
            ]);
        }

        $validated['password']=bcrypt($validated['password']);
        $validated['email_verivited_at']=now();
        $validated['remember_token']=Str::random(10);



        if ($users) {
            return redirect('login')->with('succes', 'Akun' . $users->name . 'Berhasil dibuat');
        } else {
            return back()->withErrors('Terjadi kesalahan saat mebuat akun');
        }

        // echo $request->level;

    }
}
