<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JurusanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('jurusans')->insert([
            'kode_jurusan' => 'TI',
            'nama_jurusan' => 'Teknologi Informasi',
            'kajur' => 2, // Assuming '2' is the user_id for the head of the department
            'sekjur' => 3,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
