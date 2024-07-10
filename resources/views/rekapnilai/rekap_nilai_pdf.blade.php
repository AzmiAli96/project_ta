<!DOCTYPE html>
<html>

<head>
    <title>Rekap Nilai Sidang</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid black;
            padding: 5px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }


        .header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 2px solid #000;
            padding: 10px;
        }

        .header-table {
            width: 100%;
            border-collapse: collapse;
        }

        .header-table,
        .header-table td {
            border: none;
        }

        .header-logo img {
            height: 100px;
        }

        .header-content {
            text-align: center;
        }

        .header-content h1,
        .header-content h2 {
            margin: 0;
            padding: 0;
            line-height: 1.2;
        }

        .header-content p {
            margin: 0;
            padding: 0;
            line-height: 1.2;
        }
    </style>
</head>
<header>
    <div class="header">
        <table class="header-table" >
            <tr>
                <td>
                    <div class="header-logo">
                        <img src="{{ $logo }}" alt="Logo">
                    </div>
                </td>
                <td>
                    <div class="header-content">
                        <h2 style="font-weight: 50">KEMENTERIAN PENDIDIKAN, KEBUDAYAAN, RISET DAN TEKNOLOGI</h2>
                        <h2>POLITEKNIK NEGERI PADANG</h2>
                        <p>Kampus Politeknik Negeri Padang Limau Manis, Padang, Sumatera Barat</p>
                        <p>Telepon: (0751) 72590, Faksimile: (0751) 72576</p>
                        <p>Laman: <a href="https://www.pnp.ac.id">https://www.pnp.ac.id</a>, Surel: <a
                                href="mailto:info@pnp.ac.id">info@pnp.ac.id</a></p>
                    </div>
                </td>
            </tr>
        </table>


    </div>
</header>

<body>
    <h1>Rekap Nilai Sidang</h1>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Mahasiswa</th>
                <th>Prodi</th>
                <th>Nilai Akhir</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($sidangs as $sidang)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $sidang->ta->nobp }} / {{ $sidang->ta->mahasiswa->namalengkap }}</td>
                    <td>{{ $sidang->ta->mahasiswa->prodi->jenjang }} - {{ $sidang->ta->mahasiswa->prodi->kode_prodi }}
                    </td>
                    @php
                        $total_nilai_pembimbing1 = 0;
                        $jumlah_penilai_pembimbing1 = $sidang->nilaiPembimbing1->count();
                        $total_nilai_pembimbing2 = 0;
                        $jumlah_penilai_pembimbing2 = $sidang->nilaiPembimbing2->count();
                        $total_nilai_ketua = 0;
                        $jumlah_penilai_ketua = $sidang->nilaiketua->count();
                        $total_nilai_sekretaris = 0;
                        $jumlah_penilai_sekretaris = $sidang->nilaisekretaris->count();
                        $total_nilai_anggota1 = 0;
                        $jumlah_penilai_anggota1 = $sidang->nilaianggota1->count();
                        $total_nilai_anggota2 = 0;
                        $jumlah_penilai_anggota2 = $sidang->nilaianggota2->count();
                        $jenjang = $sidang->ta->mahasiswa->prodi->jenjang;

                        if ($jenjang === 'D4') {
                            if ($jumlah_penilai_pembimbing1 > 0) {
                                foreach ($sidang->nilaiPembimbing1 as $value) {
                                    $total_nilai_pembimbing1 +=
                                        $value->n1 * 0.05 +
                                        $value->n2 * 0.05 +
                                        $value->n3 * 0.2 +
                                        $value->n4 * 0.05 +
                                        $value->n5 * 0.05 +
                                        $value->n6 * 0.1 +
                                        $value->n7 * 0.15 +
                                        $value->n8 * 0.05 +
                                        $value->n9 * 0.05 +
                                        $value->n10 * 0.25;
                                }
                                $nilai_pembimbing1 = $total_nilai_pembimbing1 / $jumlah_penilai_pembimbing1;
                            } else {
                                $nilai_pembimbing1 = 0;
                            }

                            if ($jumlah_penilai_pembimbing2 > 0) {
                                foreach ($sidang->nilaiPembimbing2 as $value) {
                                    $total_nilai_pembimbing2 +=
                                        $value->n1 * 0.05 +
                                        $value->n2 * 0.05 +
                                        $value->n3 * 0.2 +
                                        $value->n4 * 0.05 +
                                        $value->n5 * 0.05 +
                                        $value->n6 * 0.1 +
                                        $value->n7 * 0.15 +
                                        $value->n8 * 0.05 +
                                        $value->n9 * 0.05 +
                                        $value->n10 * 0.25;
                                }
                                $nilai_pembimbing2 = $total_nilai_pembimbing2 / $jumlah_penilai_pembimbing2;
                            } else {
                                $nilai_pembimbing2 = 0;
                            }
                            if ($jumlah_penilai_ketua > 0) {
                                foreach ($sidang->nilaiketua as $value) {
                                    $total_nilai_ketua +=
                                        $value->n1 * 0.05 +
                                        $value->n2 * 0.05 +
                                        $value->n3 * 0.2 +
                                        $value->n4 * 0.05 +
                                        $value->n5 * 0.05 +
                                        $value->n6 * 0.1 +
                                        $value->n7 * 0.15 +
                                        $value->n8 * 0.05 +
                                        $value->n9 * 0.05 +
                                        $value->n10 * 0.25;
                                }
                                $nilai_ketua = $total_nilai_ketua / $jumlah_penilai_ketua;
                            } else {
                                $nilai_ketua = 0;
                            }
                            if ($jumlah_penilai_sekretaris > 0) {
                                foreach ($sidang->nilaisekretaris as $value) {
                                    $total_nilai_sekretaris +=
                                        $value->n1 * 0.05 +
                                        $value->n2 * 0.05 +
                                        $value->n3 * 0.2 +
                                        $value->n4 * 0.05 +
                                        $value->n5 * 0.05 +
                                        $value->n6 * 0.1 +
                                        $value->n7 * 0.15 +
                                        $value->n8 * 0.05 +
                                        $value->n9 * 0.05 +
                                        $value->n10 * 0.25;
                                }
                                $nilai_sekretaris = $total_nilai_sekretaris / $jumlah_penilai_sekretaris;
                            } else {
                                $nilai_sekretaris = 0;
                            }
                            if ($jumlah_penilai_anggota1 > 0) {
                                foreach ($sidang->nilaianggota1 as $value) {
                                    $total_nilai_anggota1 +=
                                        $value->n1 * 0.05 +
                                        $value->n2 * 0.05 +
                                        $value->n3 * 0.2 +
                                        $value->n4 * 0.05 +
                                        $value->n5 * 0.05 +
                                        $value->n6 * 0.1 +
                                        $value->n7 * 0.15 +
                                        $value->n8 * 0.05 +
                                        $value->n9 * 0.05 +
                                        $value->n10 * 0.25;
                                }
                                $nilai_anggota1 = $total_nilai_anggota1 / $jumlah_penilai_anggota1;
                            } else {
                                $nilai_anggota1 = 0;
                            }
                            if ($jumlah_penilai_anggota2 > 0) {
                                foreach ($sidang->nilaianggota2 as $value) {
                                    $total_nilai_anggota2 +=
                                        $value->n1 * 0.05 +
                                        $value->n2 * 0.05 +
                                        $value->n3 * 0.2 +
                                        $value->n4 * 0.05 +
                                        $value->n5 * 0.05 +
                                        $value->n6 * 0.1 +
                                        $value->n7 * 0.15 +
                                        $value->n8 * 0.05 +
                                        $value->n9 * 0.05 +
                                        $value->n10 * 0.25;
                                }
                                $nilai_anggota2 = $total_nilai_anggota2 / $jumlah_penilai_anggota2;
                            } else {
                                $nilai_anggota2 = 0;
                            }
                        } else {
                            if ($jumlah_penilai_pembimbing1 > 0) {
                                foreach ($sidang->nilaiPembimbing1 as $value) {
                                    $total_nilai_pembimbing1 +=
                                        $value->n1 * 0.05 +
                                        $value->n2 * 0.05 +
                                        $value->n3 * 0.1 +
                                        $value->n4 * 0.1 +
                                        $value->n5 * 0.2 +
                                        $value->n6 * 0.05 +
                                        $value->n7 * 0.15 +
                                        $value->n8 * 0.15 +
                                        $value->n9 * 0.15;
                                }
                                $nilai_pembimbing1 = $total_nilai_pembimbing1 / $jumlah_penilai_pembimbing1;
                            } else {
                                $nilai_pembimbing1 = 0;
                            }

                            if ($jumlah_penilai_pembimbing2 > 0) {
                                foreach ($sidang->nilaiPembimbing2 as $value) {
                                    $total_nilai_pembimbing2 +=
                                        $value->n1 * 0.05 +
                                        $value->n2 * 0.05 +
                                        $value->n3 * 0.1 +
                                        $value->n4 * 0.1 +
                                        $value->n5 * 0.2 +
                                        $value->n6 * 0.05 +
                                        $value->n7 * 0.15 +
                                        $value->n8 * 0.15 +
                                        $value->n9 * 0.15;
                                }
                                $nilai_pembimbing2 = $total_nilai_pembimbing2 / $jumlah_penilai_pembimbing2;
                            } else {
                                $nilai_pembimbing2 = 0;
                            }
                            if ($jumlah_penilai_ketua > 0) {
                                foreach ($sidang->nilaiketua as $value) {
                                    $total_nilai_ketua +=
                                        $value->n1 * 0.05 +
                                        $value->n2 * 0.05 +
                                        $value->n3 * 0.1 +
                                        $value->n4 * 0.1 +
                                        $value->n5 * 0.2 +
                                        $value->n6 * 0.05 +
                                        $value->n7 * 0.15 +
                                        $value->n8 * 0.15 +
                                        $value->n9 * 0.15;
                                }
                                $nilai_ketua = $total_nilai_ketua / $jumlah_penilai_ketua;
                            } else {
                                $nilai_ketua = 0;
                            }
                            if ($jumlah_penilai_sekretaris > 0) {
                                foreach ($sidang->nilaisekretaris as $value) {
                                    $total_nilai_sekretaris +=
                                        $value->n1 * 0.05 +
                                        $value->n2 * 0.05 +
                                        $value->n3 * 0.1 +
                                        $value->n4 * 0.1 +
                                        $value->n5 * 0.2 +
                                        $value->n6 * 0.05 +
                                        $value->n7 * 0.15 +
                                        $value->n8 * 0.15 +
                                        $value->n9 * 0.15;
                                }
                                $nilai_sekretaris = $total_nilai_sekretaris / $jumlah_penilai_sekretaris;
                            } else {
                                $nilai_sekretaris = 0;
                            }
                            if ($jumlah_penilai_anggota1 > 0) {
                                foreach ($sidang->nilaianggota1 as $value) {
                                    $total_nilai_anggota1 +=
                                        $value->n1 * 0.05 +
                                        $value->n2 * 0.05 +
                                        $value->n3 * 0.1 +
                                        $value->n4 * 0.1 +
                                        $value->n5 * 0.2 +
                                        $value->n6 * 0.05 +
                                        $value->n7 * 0.15 +
                                        $value->n8 * 0.15 +
                                        $value->n9 * 0.15;
                                }
                                $nilai_anggota1 = $total_nilai_anggota1 / $jumlah_penilai_anggota1;
                            } else {
                                $nilai_anggota1 = 0;
                            }
                            if ($jumlah_penilai_anggota2 > 0) {
                                foreach ($sidang->nilaianggota2 as $value) {
                                    $total_nilai_anggota2 +=
                                        $value->n1 * 0.05 +
                                        $value->n2 * 0.05 +
                                        $value->n3 * 0.1 +
                                        $value->n4 * 0.1 +
                                        $value->n5 * 0.2 +
                                        $value->n6 * 0.05 +
                                        $value->n7 * 0.15 +
                                        $value->n8 * 0.15 +
                                        $value->n9 * 0.15;
                                }
                                $nilai_anggota2 = $total_nilai_anggota2 / $jumlah_penilai_anggota2;
                            } else {
                                $nilai_anggota2 = 0;
                            }
                        }
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
                            // $sidang->update(["status"=>true]);
                        }
                    @endphp

                    <td>{{ $nilai_akhir }}</td>
                    <td>{{ $status }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
