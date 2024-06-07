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
            'name'=> 'admin',
            'email'=> 'admin@gmail.com',
            'password'=> bcrypt('123123123'),
            'level'=> 'Admin',
        ]);
        
        \App\Models\User::create([
            'name'=> 'kaprodi',
            'email'=> 'kaprodi@gmail.com',
            'password'=> bcrypt('123123123'),
            'level'=> 'Kaprodi',
        ]);
        
        \App\Models\User::create([
            'name'=> 'azmi ali',
            'email'=> 'azmiali@gmail.com',
            'password'=> bcrypt('123123123'),
            'level'=> 'Dosen',
        ]);
        
        
        \App\Models\Dosen::create([
            'nidn'=> '2211081004',
            'user_id'=> '3',
            'no_telp'=> '082199175396',
            'alamat'=> 'taluak',
        ]);
        
        \App\Models\User::create([
            'name'=> 'farhan arya',
            'email'=> 'farhan@gmail.com',
            'password'=> bcrypt('123123123'),
            'level'=> 'Dosen',
        ]);

        \App\Models\Dosen::create([
            'nidn'=> '2211083017',
            'user_id'=> '4',
            'no_telp'=> '082155441234',
            'alamat'=> 'taluak',
        ]);

        \App\Models\User::create([
            'name'=> 'atul abiyyah',
            'email'=> 'atul@gmail.com',
            'password'=> bcrypt('123123123'),
            'level'=> 'Dosen',
        ]);

        \App\Models\Dosen::create([
            'nidn'=> '2211081017',
            'user_id'=> '5',
            'no_telp'=> '082199542112',
            'alamat'=> 'taluak',
        ]);
        \App\Models\User::create([
            'name'=> 'hans demberger',
            'email'=> 'hans@gmail.com',
            'password'=> bcrypt('123123123'),
            'level'=> 'Dosen',
        ]);

        \App\Models\Dosen::create([
            'nidn'=> '2211082052',
            'user_id'=> '6',
            'no_telp'=> '081352456525',
            'alamat'=> 'taluak',
        ]);

        

        // \App\Models\Jurusan::create([
        //     'nama_jurusan'=> 'Teknologi Informasi',
        //     'kajur'=> '2211083017',
        //     'sekjur'=> '2211081017',
        // ]);

        // \App\Models\prodi::create([
        //     'nama'=> 'TRPL',
        //     'jurusan_id'=> '1',
        //     'kaprodi'=> '2211081004',
        // ]);

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
