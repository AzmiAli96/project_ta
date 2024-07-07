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
        $this->call([
            ProgramSeeder::class,
            MahasiswaSeeder::class
        ]);

        // User::factory(10)->create();
        // \App\Models\Mahasiswa::factory(20)->create();
        // \App\Models\Dosen::factory(20)->create();

        // \App\Models\Status::create([
        //     'ket'=> 'Tugas Akhir',
        // ]);
        // \App\Models\Status::create([
        //     'ket'=> 'Sidang',
        // ]);
        // \App\Models\Status::create([
        //     'ket'=> 'Lulus',
        // ]);
        // \App\Models\Status::create([
        //     'ket'=> 'Belum Daftar',
        // ]);
        
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
            'name'=> 'Meri Azmi',
            'email'=> 'azmimeri@gmail.com',
            'password'=> bcrypt('123123123'),
            'level'=> 'Dosen',
        ]);
        
        
        \App\Models\Dosen::create([
            'nidn'=> '0215576889',
            'user_id'=> '3',
            'no_telp'=> '082199175396',
            'alamat'=> 'Padang',
        ]);
        
        \App\Models\User::create([
            'name'=> 'Ronal Hadi',
            'email'=> 'HadiRon@gmail.com',
            'password'=> bcrypt('123123123'),
            'level'=> 'Dosen',
        ]);

        \App\Models\Dosen::create([
            'nidn'=> '0231083017',
            'user_id'=> '4',
            'no_telp'=> '082155441234',
            'alamat'=> 'taluak',
        ]);

        \App\Models\User::create([
            'name'=> 'Ainil Mardiyah',
            'email'=> 'Ainil333@gmail.com',
            'password'=> bcrypt('123123123'),
            'level'=> 'Dosen',
        ]);

        \App\Models\Dosen::create([
            'nidn'=> '0218881017',
            'user_id'=> '5',
            'no_telp'=> '082199542112',
            'alamat'=> 'Ampang',
        ]);
        \App\Models\User::create([
            'name'=> 'Fazrol Rozi',
            'email'=> 'Fazrozi@gmail.com',
            'password'=> bcrypt('123123123'),
            'level'=> 'Dosen',
        ]);

        \App\Models\Dosen::create([
            'nidn'=> '0234433552',
            'user_id'=> '6',
            'no_telp'=> '081352456525',
            'alamat'=> 'Limau Manis',
        ]);

        // \App\Models\User::create([
        //     'name'=> 'bagaz tra',
        //     'email'=> 'bagaz@gmail.com',
        //     'password'=> bcrypt('123123123'),
        //     'level'=> 'Mahasiswa',
        // ]);

        // \App\Models\Mahasiswa::create([
        //     'nobp'=> '2211081005',
        //     'user_id'=> '7',
        //     'jurusan_id'=> '1',
        //     'prodi'=> '1',
        // ]);

        // \App\Models\User::create([
        //     'name'=> 'bagaz tra',
        //     'email'=> 'bagaz@gmail.com',
        //     'password'=> bcrypt('123123123'),
        //     'level'=> 'Mahasiswa',
        // ]);

        // \App\Models\Mahasiswa::create([
        //     'nobp'=> '2211081005',
        //     'user_id'=> '7',
        //     'jurusan_id'=> '1',
        //     'prodi'=> '1',
        // ]);

        

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
