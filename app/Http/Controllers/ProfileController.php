<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

// class ProfileController extends Controller
// {
//     public function index()
//     {
//         // $user = auth()->user();
//         // return view('profile.index', compact('user')); // Menggunakan profile.index untuk mengarahkan ke file yang benar

//         $title = 'My Profile';
//         $user = User::where('id', Auth::user()->id)->first();

//         return view('profile.index', compact('title','user'));
//     }
     
//     // public function update(Request $request, string $id)
//     // {
//     //     $validated = $request->validate([
//     //         'name' => 'required|min:3',
//     //         'email' => 'required',
//     //         'password' => 'required'
//     //     ]);
//     //     User::where('id',$id)->update($validated);
//     //     return redirect('/profile')->with('pesan','Data berhasil di update   !');
//     // }
// }

class ProfileController extends Controller
{
    public function index()
    {
        $title = 'My Profile';
        $user = Auth::user();
        return view('profile.index', compact('title', 'user'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|email',
            'password' => 'nullable|min:8|confirmed',
        ]);

        $user = Auth::user();

        if (!$user) {
            return redirect()->route('profile.index')->with('error', 'User not found.');
        }

        $updateData = [
            'name' => $validated['name'],
            'email' => $validated['email'],
        ];

        if (!empty($validated['password'])) {
            $updateData['password'] = Hash::make($validated['password']);
        }

        // Debugging: log informasi updateData
        Log::info('Update data:', ['data' => $updateData]);

        try {
            $user->update($updateData);
        } catch (\Exception $e) {
            Log::error('Error updating user:', ['error' => $e->getMessage()]);
            return redirect()->route('profile.index')->with('error', 'Failed to update profile.');
        }

        return redirect()->route('profile.index')->with('pesan', 'Data berhasil diupdate!');
    }
}
