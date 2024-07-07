<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class ProfileController extends Controller
{
    public function index()
    {
        $title = 'My Profile';
        $user = Auth::user();
        $mahasiswa = $user->mahasiswa; // Ambil data mahasiswa jika ada
        return view('profile.index', compact('title', 'user', 'mahasiswa'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|email',
            'password' => 'nullable|min:8|confirmed',
            'ips' => 'nullable|numeric|min:0|max:4',
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

        try {
            $user->update($updateData);

            // Jika user adalah mahasiswa, update IPS mereka
            if ($user->mahasiswa && isset($validated['ips'])) {
                $user->mahasiswa->update(['ips' => $validated['ips']]);
            }

        } catch (\Exception $e) {
            Log::error('Error updating user:', ['error' => $e->getMessage()]);
            return redirect()->route('profile.index')->with('error', 'Failed to update profile.');
        }

        activity()->causedBy(Auth::user())->log('User ' . auth()->user()->name . ' berhasil mengubah data profile ');

        return redirect()->route('profile.index')->with('pesan', 'Data berhasil diupdate!');
    }

    public function store(Request $request)
    {
        $request->validate([
            'avatar' => 'required|image',
        ]);

        $avatarName = time().'.'.$request->avatar->getClientOriginalExtension();
        $request->avatar->move(public_path('avatars'), $avatarName);

        Auth()->user()->update(['avatar' => $avatarName]);

        activity()->causedBy(Auth::user())->log('User ' . auth()->user()->name . ' berhasil mengganti foto profile ');

        return back()->with('success', 'Avatar updated successfully.');
    }
}
