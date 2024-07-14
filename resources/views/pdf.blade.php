<!DOCTYPE html>
<html>
<head>
    <title>Data PDF</title>
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
    <h2 style="text-align: center">Data Nilai Mahasiswa</h2>
    <p>Berikut adalah data penilaian penguji untuk mahasiswa {{ $sidang->ta->mahasiswa->namalengkap }} dengan data-data pengujinya  </p>
    <p>
        <p><b>Mahasiswa :</b> {{ $sidang->ta->nobp }} /
            {{ $sidang->ta->mahasiswa->namalengkap }}</p>
    </p>
    <div class="table-responsive">
        <table class="table table-bordered" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Jabatan</th>
                    <th>Nama</th>
                    <th>Total Nilai</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Pembimbing 1</td>
                    <td>{{ $sidang->ta->Dpembimbing1->user->name }} </td>
                    <td>{{ $nilai_pembimbing1 }}</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Pembimbing 2 </td>
                    <td>{{ $sidang->ta->Dpembimbing2->user->name }}</td>
                    <td>{{ $nilai_pembimbing2 }}</td>
                </tr>
                <tr>
                    <td></td>
                    <td>Nilai Rata-rata Pembimbing :</td>
                    <td></td>
                    <td>{{ $rata_pendidikan }}</td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>Ketua</td>
                    <td>{{ $sidang->ta->Dpembimbing1->user->name }} /
                        {{ $sidang->ta->Dpembimbing2->user->name }} </td>
                    <td>{{ $nilai_ketua }}</td>
                </tr>
                <tr>
                    <td>4</td>
                    <td>Sekretaris</td>
                    <td>{{ $sidang->psek_sidang->user->name }} </td>
                    <td>{{ $nilai_sekretaris }}</td>
                <tr>
                    <td>5</td>
                    <td>Anggota 1</td>
                    <td>{{ $sidang->panggota1->user->name }} </td>
                    <td>{{ $nilai_anggota1 }}</td>
                <tr>
                    <td>6</td>
                    <td>Anggota 2</td>
                    <td>{{ $sidang->panggota2->user->name }} </td>
                    <td>{{ $nilai_anggota2 }}</td>
                <tr>
                    <td></td>
                    <td>Nilai Rata-rata Penguji :</td>
                    <td></td>
                    <td>{{ $rata_penguji }}</td>
                </tr>
                <tr>
                    <td></td>
                    <td>Nilai Akhir :</td>
                    <td></td>
                    <td>{{ $nilai_akhir }}</td>
                </tr>
                <tr>
                    <td></td>
                    <td>Hasil Akhir :</td>
                    <td></td>
                    <td>{{ $status }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</body>
</html>
