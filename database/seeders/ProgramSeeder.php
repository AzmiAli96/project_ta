<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProgramSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Jurusan::create([
            'kode_jurusan'=> 'TI',
            'nama_jurusan'=> 'Teknologi Informasi',
            'kajur'=> '2',
            'sekjur'=> '3',
        ]);

        \App\Models\prodi::create([
            'kode_prodi'=> 'TRPL',
            'jenjang'=> 'D4',
            'nama_prodi'=> 'Teknologi Rekayasa Perangkat Lunak',
            'jurusan_id'=> '1',
            'kaprodi'=> '4',
        ]);

        \App\Models\Ruangan::create([
            'nama_ruangan'=> 'E301',
        ]);

        \App\Models\Ruangan::create([
            'nama_ruangan'=> 'E302',
        ]);

        \App\Models\Ruangan::create([
            'nama_ruangan'=> 'E303',
        ]);

        \App\Models\Ruangan::create([
            'nama_ruangan'=> 'E304',
        ]);

        \App\Models\Ruangan::create([
            'nama_ruangan'=> 'E305',
        ]);

        \App\Models\Sesi::create([
            'sesi'=> 'Sesi 1',
            'waktu'=> '08:00 AM - 10:00 AM',
        ]);

        \App\Models\Sesi::create([
            'sesi'=> 'Sesi 2',
            'waktu'=> '10:00 AM - 12:00 AM',
        ]);

        \App\Models\Sesi::create([
            'sesi'=> 'Sesi 3',
            'waktu'=> '13:00 PM - 15:00 PM',
        ]);

        \App\Models\Sesi::create([
            'sesi'=> 'Sesi 4',
            'waktu'=> '15:00 PM - 17:00 PM',
        ]);
    }
}
