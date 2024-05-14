<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function index(){
        return view('login.login');
    }

    public function login(Request $request){
       $data = $request->validate([
            'email'=>'required',
            'password'=>'required'
        ],[
            'email.required'=>'email wajib diisi',
            'password.required'=>'password wajib diisi',
        ]);

        // $infologin = [
        //     'email'=> $request->email,
        //     'password'=> bcrypt($request->password),
        // ];

        // if(Auth::attempt($infologin)){
        //     return redirect('/');
        // }else{
        //     return redirect('')->withErrors('username dan password yang dimasukkan tidak sesuai')->withInput();
        // }
    if(Auth::attempt($data)){
        return redirect('/');
    }else{
        echo "gagal";
    }

    // echo "ini coba saja";
    }

    public function createUser(){
        $pass = bcrypt('123');
        User::created([
            "email"=>"test@gmail.com",
            "password"=>$pass
        ]);
    }

    public function showRegister(){
        return view('login.registerM');
    }

    public function create(Request $request){
        $request->validate([
            'firstname'=>'required',
            'email'=>'required|string|email|unique:users|max:255',
            'password'=>'required|string|min:8',
            'level'=>'required|in:Admin,Kaprodi,Mahasiswa,Dosen',
        ],[
            'firstname.required'=>'Nama wajib diisi',
            'email.required'=>'Email wajib diisi',
            'level.required'=>'kolom wajib diisi',
            'email.email'=>'silahkan masukkan email yang valid',
            'email.unique'=>'Email sudah pernah digunakan, Silahkan gunakan Email lain',
            'password.required'=>'Password wajib diisi',
            'password.min'=>'Minimum password yang dimasukkan adalah 8',
        ]);

        $users = User::create([
            'name'=>$request->firstname.' '.$request->lastname,
            'email'=>$request->email,
            'level'=>$request->level,
            'password'=>Hash::make($request->password),
        ]);

        if ($users) {
            return redirect('login')->with('succes','Akun'. $users->name .'Berhasil dibuat');
        }else{
            return back()->withErrors('Terjadi kesalahan saat mebuat akun');
        }

        // echo $request->level;
        
    }

    function logout(){
        Auth::logout();
        return redirect('');
    }

}
