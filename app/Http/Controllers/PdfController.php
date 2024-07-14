<?php

namespace App\Http\Controllers;

use App\Models\Nilai;
use App\Models\Sidang;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class PdfController extends Controller
{
    public function generatePdf(string $id)
    {
        $gambar = [
            'logo' => public_path('/image/Logo_pnp.png')
        ];
        $sidang = Sidang::where('id', $id)->with(['ta.Dpembimbing1.user', 'ta.Dpembimbing2.user', 'nilaiPembimbing1', 'nilaiPembimbing2', 'nilaiketua', 'nilaisekretaris', 'psek_sidang.user', 'panggota1.user', 'panggota2.user'])->first(); // Adjust your query as needed
        $jenjang = $sidang->ta->mahasiswa->prodi->jenjang;


        // Calculate the values
        $nilai_pembimbing1 = $this->calculateNilai($sidang->nilaiPembimbing1 ?? [], $jenjang);
        $nilai_pembimbing2 = $this->calculateNilai($sidang->nilaiPembimbing2 ?? [], $jenjang);
        $nilai_ketua = $this->calculateNilai($sidang->nilaiketua ?? [], $jenjang);
        $nilai_sekretaris = $this->calculateNilai($sidang->nilaisekretaris ?? [], $jenjang);
        $nilai_anggota1 = $this->calculateNilai($sidang->nilaianggota1 ?? [], $jenjang);
        $nilai_anggota2 = $this->calculateNilai($sidang->nilaianggota2 ?? [], $jenjang);

        $rata_pendidikan = ($nilai_pembimbing1 + $nilai_pembimbing2) / 2;
        $rata_penguji = ($nilai_ketua + $nilai_sekretaris + $nilai_anggota1 + $nilai_anggota2) / 4;
        $nilai_akhir = ($rata_pendidikan + $rata_penguji) / 2;

        $status = 'Tidak Lulus';
        $count = 0;
        if ($nilai_ketua > 65) {
            $count++;
        }
        if ($nilai_sekretaris > 65) {
            $count++;
        }
        if ($nilai_anggota1 > 65) {
            $count++;
        }
        if ($nilai_anggota2 > 65) {
            $count++;
        }
        if ($count > 2) {
            $status = 'Lulus';
        }

        // Pass data to the view
        $data = compact('sidang', 'nilai_pembimbing1', 'nilai_pembimbing2', 'rata_pendidikan', 'nilai_ketua', 'nilai_sekretaris', 'nilai_anggota1', 'nilai_anggota2', 'rata_penguji', 'nilai_akhir', 'status');

        // Load the view and pass the data
        $pdf = PDF::loadView('pdf', $data, $gambar);

        return $pdf->download('data-nilai-mahasiswa.pdf');
    }

    private function calculateNilai($nilaiCollection, $jenjang)
    {
        $total_nilai = 0;
        $jumlah_penilai = $nilaiCollection ? $nilaiCollection->count() : 0;


        if ($jumlah_penilai > 0) {
            foreach ($nilaiCollection as $value) {
                if ($jenjang === 'D4') {
                    $total_nilai +=
                        ($value->n1 ?? 0) * 0.05 +
                        ($value->n2 ?? 0) * 0.05 +
                        ($value->n3 ?? 0) * 0.2 +
                        ($value->n4 ?? 0) * 0.05 +
                        ($value->n5 ?? 0) * 0.05 +
                        ($value->n6 ?? 0) * 0.1 +
                        ($value->n7 ?? 0) * 0.15 +
                        ($value->n8 ?? 0) * 0.05 +
                        ($value->n9 ?? 0) * 0.05 +
                        ($value->n10 ?? 0) * 0.25;
                } else {
                    $total_nilai +=
                        ($value->n1 ?? 0) * 0.05 +
                        ($value->n2 ?? 0) * 0.05 +
                        ($value->n3 ?? 0) * 0.1 +
                        ($value->n4 ?? 0) * 0.1 +
                        ($value->n5 ?? 0) * 0.2 +
                        ($value->n6 ?? 0) * 0.05 +
                        ($value->n7 ?? 0) * 0.15 +
                        ($value->n8 ?? 0) * 0.15 +
                        ($value->n9 ?? 0) * 0.15;
                }
            }

            return $total_nilai / $jumlah_penilai;
        }

        return 0;
    }

    public function exportPDF(Request $request)
    {
        $prodi = $request->input('prodi');

        $data = [
            'logo' => public_path('/image/Logo_pnp.png')
        ];

        $sidangsQuery = Sidang::with([
            'ta.mahasiswa.prodi',
            'nilaiPembimbing1',
            'nilaiPembimbing2',
            'nilaiketua',
            'nilaisekretaris',
            'nilaianggota1',
            'nilaianggota2'
        ]);
        if ($prodi && $prodi !== 'all') {
            $sidangsQuery->whereHas('ta.mahasiswa.prodi', function ($query) use ($prodi) {
                $query->where('kode_prodi', $prodi);
            });
        }
        $sidangs = $sidangsQuery->get();

        $pdf = Pdf::loadView('rekapnilai.rekap_nilai_pdf', $data, compact('sidangs'));
        return $pdf->download('rekap_nilai.pdf');
    }
}
