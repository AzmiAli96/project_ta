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
        // \App\Models\Mahasiswa::factory(20)->create();
        // \App\Models\Dosen::factory(20)->create();

        // \App\Models\prodi::create([
        //     'nama'=> 'Manajemen Informatika',
            
        // ]);
        // \App\Models\prodi::create([
        //     'nama'=> 'Teknik Komputer',
        // ]);
        

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
        \App\Models\User::create([
            'name'=> 'Azmi Ali',
            'email'=> 'azmiali@gmail.com',
            'password'=> bcrypt('123123123'),
            'level'=> 'Dosen',
        ]);
        \App\Models\Dosen::create([
            'nidn'=> '2211081004',
            'user_id'=> '1',
            'no_telp'=> '082199175396',
            'alamat'=> 'taluak',
        ]);

        \App\Models\Jurusan::create([
            'nama_jurusan'=> 'Teknologi Informasi',
            'kajur'=> '1',
            'sekjur'=> '1',
        ]);

        \App\Models\prodi::create([
            'nama'=> 'TRPL',
            'jurusan_id'=> '1',
            'kaprodi'=> '1',
        ]);

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
