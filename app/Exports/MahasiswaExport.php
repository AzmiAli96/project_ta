<?php

namespace App\Exports;

use App\Models\Mahasiswa;
use Maatwebsite\Excel\Concerns\FromCollection;

class MahasiswaExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $mahasiswa = Mahasiswa::select([
            'no_bp',
            'nama',
            'prodi_id',
            'ipk',
            'status_id',
        ])->get();
        return $mahasiswa;
    }

    public function headings(): array{
        return [
            "no_bp",
            "nama",
            "prodi_id",
            "ipk",
            "status_id",
        ];
    }
}
