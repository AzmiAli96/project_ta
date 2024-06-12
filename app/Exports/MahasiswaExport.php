<?php

namespace App\Exports;

use App\Models\Mahasiswa;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class MahasiswaExport implements FromQuery, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function query()
    {
        return Mahasiswa::with(['prodi', 'user',])
            ->select(['nobp', 'ips'])
            ->addSelect([
                'prodi_id as prodi_nama', 
                'user_id as user_email', 
            ]);
    }


   public function headings(): array
    {
        return [
            'No BP',
            'IPK',
            'Program Studi',
            'Email',
            'Status'
        ];
    }

    public function map($mahasiswa): array
    {
        return [
            $mahasiswa->nobp,
            $mahasiswa->ips,
            $mahasiswa->prodi_nama,
            $mahasiswa->user_email,
            $mahasiswa->status_ket
        ];
    }
}
