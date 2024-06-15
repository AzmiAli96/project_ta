<?php

namespace App\Imports;

use App\Models\Jurusan;
use App\Models\Mahasiswa;
use App\Models\prodi;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class MahasiswaImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        // dd($row);
        $data = Mahasiswa::where('nobp', $row['nobp'])->first();
        if ($data) {
            return null;
        }

        $idJurusan = Jurusan::where('nama_jurusan', $row['jurusan'])->first();
        $idProdi = prodi::where('nama_prodi', '=', $row['prodi'])->first();
// dd($idJurusan);
        return new Mahasiswa([

            "nobp" => $row['nobp'],
            "jurusan_id" => $idJurusan->id,
            "prodi_id" => $idProdi->id,
            "ips" => $row['ips']
        ]);
    }
}
