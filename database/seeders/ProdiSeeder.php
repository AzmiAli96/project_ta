<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProdiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('prodis')->insert([
            [
                'kode_prodi' => 'TRPL',
                'jenjang' => 'D4',
                'nama_prodi' => 'Teknologi Rekayasa Perangkat Lunak',
                'jurusan_id' => 1, // Assuming '1' is the ID for the corresponding department
                'kaprodi' => 1, // Assuming '1' is the user_id for the head of the program
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode_prodi' => 'MI',
                'jenjang' => 'D3',
                'nama_prodi' => 'Manajemen Informatika',
                'jurusan_id' => 1, // Assuming '1' is the ID for the corresponding department
                'kaprodi' => 4, // Assuming '4' is the user_id for the head of the program
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
