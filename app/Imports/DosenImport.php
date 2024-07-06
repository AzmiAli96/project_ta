<?php

namespace App\Imports;

use App\Models\Dosen;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class DosenImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        // Cari atau buat user berdasarkan email
        $user = User::where('email', $row['email'])->first();

        // Jika user belum ada, buat user baru
        if (!$user) {
            $user = User::create([
                'name' => $row['nama'],
                'email' => $row['email'],
                'password' => Hash::make($row['password']), // Sesuaikan dengan kolom password di file Excel
                'level' => 'Dosen', // Sesuaikan level sesuai kebutuhan
            ]);
        }

        // Simpan data dosen
        return new Dosen([
            'nidn' => $row['nidn'],
            'user_id' => $user->id, // Gunakan user_id yang sudah ada atau baru dibuat
            'no_telp' => $row['no_telp'],
            'alamat' => $row['alamat'],
        ]);
    }
}
