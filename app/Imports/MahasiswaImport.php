<?php

namespace App\Imports;

use App\Models\Mahasiswa;
use Maatwebsite\Excel\Concerns\ToModel;

class MahasiswaImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        $data = Mahasiswa::where('no_bp', $row['nobp'])->first();
        if ($data) {
            return null;
        }

        return new Mahasiswa([
            "no_bp" => $row["nobp"],
            "nama" => $row["nama"],
            "email" => $row["email"],
            "password" => $row["password"],
            "prodi_id" => $row["prodi_id"],
            "ipk" => $row["ipk"],
            "status_id" => $row["status_id"],
        ]);
    }
}
