<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        \App\Models\Mahasiswa::factory(20)->create();
        \App\Models\Dosen::factory(20)->create();

        \App\Models\prodi::create([
            'nama'=> 'Manajemen Informatika',
        ]);
        \App\Models\prodi::create([
            'nama'=> 'Teknik Komputer',
        ]);
        \App\Models\prodi::create([
            'nama'=> 'TRPL',
        ]);

        \App\Models\Status::create([
            'ket'=> 'Lulus',
        ]);
        \App\Models\Status::create([
            'ket'=> 'Persiapan',
        ]);
        \App\Models\Status::create([
            'ket'=> 'Belum Lengkap',
        ]);
        \App\Models\Status::create([
            'ket'=> 'Persidangan',
        ]);

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
