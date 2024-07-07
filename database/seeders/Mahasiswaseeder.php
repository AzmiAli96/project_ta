<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MahasiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\User::create([
            'name'=> 'Muhammad Farhan Arya',
            'email'=> 'mfarhanarya9@gmail.com',
            'password'=> bcrypt('123123123'),
            'level'=> 'Mahasiswa',
        ]);

        \App\Models\Mahasiswa::create([
            'nobp'=> '2211083036',
            'namalengkap'=> 'Muhammad Farhan Arya',
            'user_id'=> '7',
            'jurusan_id'=> '1',
            'prodi_id'=> '1',
        ]);

        \App\Models\User::create([
            'name'=> 'Hans Demberger S',
            'email'=> 'hansd@gmail.com',
            'password'=> bcrypt('123123123'),
            'level'=> 'Mahasiswa',
        ]);

        \App\Models\Mahasiswa::create([
            'nobp'=> '2211081012',
            'namalengkap'=> 'Hans Demberger S',
            'user_id'=> '8',
            'jurusan_id'=> '1',
            'prodi_id'=> '1',
        ]);

       

       

    }
}
