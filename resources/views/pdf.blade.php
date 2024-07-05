<!DOCTYPE html>
<html>
<head>
    <title>Data PDF</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 15px;
            text-align: left;
        }
    </style>
</head>
<body>
    <h1>Data Nilai Mahasiswa</h1>
    <h4>
        <p><b>Mahasiswa :</b> {{ $sidang->ta->nobp }} /
            {{ $sidang->ta->mahasiswa->namalengkap }}</p>
    </h4>
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
