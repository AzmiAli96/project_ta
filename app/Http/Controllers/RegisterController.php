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

use App\Models\ActivityLog;
// use App\Models\User;
use Exception;
use Illuminate\Auth\Events\PasswordReset;
// use Illuminate\Http\Request;
use Illuminate\Log\Logger;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Str;
use Illuminate\Support\Facades\Password;
use Mews\Captcha\Facades\Captcha;

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
            'captcha' => 'required|captcha'
        ], [
            'firstname.required' => 'Nama wajib diisi',
            'email.required' => 'Email wajib diisi',
            'level.required' => 'kolom wajib diisi',
            'email.email' => 'silahkan masukkan email yang valid',
            'email.unique' => 'Email sudah pernah digunakan, Silahkan gunakan Email lain',
            'password.required' => 'Password wajib diisi',
            'password.min' => 'Minimum password yang dimasukkan adalah 8',
            'captcha.required' => 'Inputkan karakter captcha',
            'captcha.captcha' => 'input karakter salah'
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
                'namalengkap' =>$request->namalengkap,
                'user_id' => $users->id,
                'jurusan_id' => $request->jurusan_id,
                'prodi_id' => $request->prodi_id,
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

// class SessionController extends Controller
// {
//     public function index()
//     {
//         return view('pages.login');
//     }

//     public function login(Request $request)
//     {

//         $credentials = $request->validate([
//             "email" => "required",
//             "password" => "required"
//         ]);

//         if (Auth::attempt($credentials)) {
//             if (in_array(auth()->user()->role, ['3', '4', '5'])) {
//                 ActivityLog::createLog('Login', 'Login');
//                 return redirect('peminjamanUmum');
//             } elseif (Auth::user()->role == 1 || Auth::user()->role == 2) {
//                 ActivityLog::createLog('Login', 'Login');
//                 return redirect('/');
//             }
//         } else {
//             return redirect('login')->with('gagal', 'Login gagal, email atau password salah')->withInput();
//         }
//     }

//     public function logout()
//     {
//         ActivityLog::createLog('logout', 'Logout');
//         Auth::logout();
//         return redirect('login');
//     }

//     public function forgotShow()
//     {
//         return view('pages.forgotpass');
//     }

//     public function forgotSend(Request $request)
//     {
//         $request->validate(['email' => 'required|email']);

//         $status = Password::sendResetLink(
//             $request->only('email')
//         );

//         return $status === Password::RESET_LINK_SENT
//             ? back()->with(['status' => 'Token reset password berhasil terkirim, silahkan periksa email anda!'])
//             : back()->withErrors(['email' => __($status)]);
//     }

//     public function resetPass(Request $request)
//     {
//         $request->validate([
//             'token' => 'required',
//             'email' => 'required|email',
//             // 'password' => 'required|min:8|confirmed',
//             "password" => "required|min:8|regex:/[a-z]/|regex:/[A-Z]/|regex:/[0-9]/|regex:/[@!$%*?&]/|confirmed",
//         ]);

//         $status = Password::reset(
//             $request->only('email', 'password', 'password_confirmation', 'token'),
//             function (User $user, string $password) {
//                 $user->forceFill([
//                     'password' => bcrypt($password)
//                 ])->setRememberToken(Str::random(60));

//                 $user->save();

//                 event(new PasswordReset($user));
//             }
//         );

//         return $status === Password::PASSWORD_RESET
//             ? redirect()->route('login')->with('status', 'Password berhasil direset, silahkan login.')
//             : back()->withErrors(['email' => [__($status)]])->onlyInput('password');
//     }

//     public function register()
//     {
//         return view('pages.register');
//     }

//     public function prosesRegister(Request $rq)
//     {

//         $validator = Validator::make($rq->all(), [
//             'email' => "email|unique:users,email",
//             'capcha' => 'required|captcha',
//             'password' => 'regex:/[0-9]/|regex:/[a-z]/|regex:/[A-Z]/|regex:/[!@#$%]/'
//         ], [
//             "email.unique" => "Email sudah tersedia.",
//             "email.email" => "Masukkan email yang valid.",
//             'capcha.captcha' => 'captcha tidak sesuai.',
//             'password.regex' => 'Password harus terdapat huruf besar, huruf kecil, angka, dan karakter spesial (!@#$%)'
//         ]);

//         if ($validator->fails()) {
//             return response()->json($validator->errors(), 422);
//         }

//         $username = str_replace(' ', '_', strtolower($rq->username));
//         $data = [
//             "username" => $username,
//             "email" => $rq->email,
//             "password" => bcrypt($rq->password),
//         ];

//         $user = User::create($data);

//         // Kirim notifikasi verifikasi email
//         $user->sendEmailVerificationNotification();
//         // Pengguna telah memverifikasi email mereka, lakukan login
//         Auth::login($user);

//         // Ubah pesan respons
//         return response()->json([
//             "status" => 200,
//             "message" => "Email verifikasi telah dikirimkan ke email, Silahkan login ke akun Anda."
//         ]);
//     }

//     // public function reloadCapcha()
//     // {
//     //     return response()->json(Captcha::img('math'));
//     // }
// }
