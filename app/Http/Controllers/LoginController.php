<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Jurusan;
use App\Models\Mahasiswa;
use App\Models\prodi;
use App\Models\Status;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function index()
    {
        return view('login.login');
    }

    public function login(Request $request)
    {
        $data = $request->validate([
            'email' => 'required',
            'password' => 'required'
        ], [
            'email.required' => 'email wajib diisi',
            'password.required' => 'password wajib diisi',
        ]);

        if (Auth::attempt($data)) {
            activity()->causedBy(Auth::user())->log('User ' . auth()->user()->name . ' Berhasil melakukan login');
            return redirect('/');
        } else {
            return back()->withErrors('username dan password yang dimasukkan tidak sesuai')->withInput();
        }
    }


    

    function logout()
    {
        activity()->causedBy(Auth::user())->log('user ' . auth()->user()->name . ' melakukan logout');
        Auth::logout();
        return redirect('');
    }
}
