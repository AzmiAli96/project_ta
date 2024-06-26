<?php

namespace App\Imports;

use App\Models\Dosen;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class DosenImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        // dd($row);
        $data = Dosen::where('nidn', $row['nidn'])->first();
        if ($data) {
            return null;
        }

        return new Dosen([

            "nidn" => $row['nidn'],
            "no_telp" => $row['no_telp'],
            "alamat" => $row['alamat']
        ]);
    }
}
