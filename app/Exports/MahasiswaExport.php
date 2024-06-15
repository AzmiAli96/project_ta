<?php

namespace App\Exports;

use App\Models\Mahasiswa;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class MahasiswaExport implements WithHeadings, FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
   


   public function headings(): array
    {
        return [
            'NoBP',
            'Nama',
            'Jurusan',
            'Program Studi',
            'Email',
            'Status',
            'IPS'
        ];
    }

    public function collection()
    {
        // return Mahasiswa::with(['jurusan','prodi'])->get()->map(function($mahasiswa){
        //     return [
        //         $mahasiswa->nobp,
        //         $mahasiswa->ips,
                
        //         $mahasiswa->prodi_nama,
        //         $mahasiswa->user_email,
        //         $mahasiswa->status_ket
        //     ];
        // });
        return Mahasiswa::with(['jurusan', 'prodi','user'])->get()->map(function($mahasiswa){
            return [
                'nobp' => $mahasiswa->nobp,
                'nama' => $mahasiswa->user->name,
                'nama_jurusan' => $mahasiswa->jurusan->nama_jurusan,
                'nama_prodi' => $mahasiswa->prodi->nama_prodi,
                'email' => $mahasiswa->user->email,
                'status' => $mahasiswa->status,
                'IPS' => $mahasiswa->ips

            ];
        });
    }
}
