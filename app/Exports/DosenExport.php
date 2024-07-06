<?php

namespace App\Exports;

use App\Models\Dosen;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class DosenExport implements WithHeadings, FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
   


   public function headings(): array
    {
        return [
            'NIDN',
            'Nama',
            'Email',
            'No_Telp',
            'Alamat'
        ];
    }

    public function collection()
    {
        
        return Dosen::all()->map(function($dosen){
            return [
                'nidn' => $dosen->nidn,
                'nama' => $dosen->user->name,
                'email' => $dosen->user->email,
                'no_telp' => $dosen->no_telp,
                'alamat' => $dosen->alamat

            ];
        });
    }
}
