@extends('layout.main')
@section('title', 'Edit Penilaian')
@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h2>Edit Penilaian</h2>
    </div>
    @if (session()->has('pesan'))
        <div class="alert alert-primary" role="alert">
            {{ session('pesan') }}
        </div>
    @endif
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">DataTables nilai</h6>
        </div>
        <div class="card-body">
            <!-- <form action="/nilai/penilai" method="post">
                                                @method('PUT')
                                                @csrf -->
            <div class="table-responsive">
                <div class="container d-flex ">
                    <div class="col-md-8">
                        <h4>
                            <p><b>Mahasiswa :</b> {{ $sidang->ta->nobp }} /
                                {{ $sidang->ta->mahasiswa->user->name }}</p>
                        </h4>
                    </div>
                    <div class="col-md-4 text-md-right">
                        <a href="/pdf/{{ $sidang->id }}" class="btn btn-primary mb-3 "> Download</a>
                    </div>
                </div>
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Jabatan</th>
                            <th>Nama</th>
                            <th>Total Nilai</th>
                            @if (auth()->user()->level == 'Dosen')
                                <th>Action</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Pembimbing 1</td>
                            <td>{{ $sidang->ta->Dpembimbing1->user->name }} </td>
                            @php
                                $total_nilai = 0;
                                $jumlah_penilai = $sidang->nilaiPembimbing1->count();

                                if ($jenjang === 'D4') {
                                    if ($jumlah_penilai > 0) {
                                        foreach ($sidang->nilaiPembimbing1 as $value) {
                                            $total_nilai +=
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
                                        $nilai_pembimbing1 = $total_nilai / $jumlah_penilai;
                                    } else {
                                        $nilai_pembimbing1 = 0;
                                    }
                                } else {
                                    if ($jumlah_penilai > 0) {
                                        foreach ($sidang->nilaiPembimbing1 as $value) {
                                            $total_nilai +=
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
                                        $nilai_pembimbing1 = $total_nilai / $jumlah_penilai;
                                    } else {
                                        $nilai_pembimbing1 = 0;
                                    }
                                }
                            @endphp
                            <td>{{ $nilai_pembimbing1 }}</td>
                            <td>
                                @if (auth()->user()->level == 'Dosen')
                                    <a href="/berinilai/{{ $sidang->id }}/pembimbing1/{{ $jenjang }}" type="submit"
                                        class="btn btn-warning"><i class="fas fa-edit"></i></a>
                                    {{-- <button class="btn btn-success btn-sm">beri nilai</button> --}}
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Pembimbing 2 </td>
                            <td>{{ $sidang->ta->Dpembimbing2->user->name }}</td>
                            @php
                                $total_nilai = 0;
                                $jumlah_penilai = $sidang->nilaiPembimbing2->count();

                                if ($jenjang === 'D4') {
                                    if ($jumlah_penilai > 0) {
                                        foreach ($sidang->nilaiPembimbing2 as $value) {
                                            $total_nilai +=
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
                                        $nilai_pembimbing2 = $total_nilai / $jumlah_penilai;
                                    } else {
                                        $nilai_pembimbing2 = 0;
                                    }
                                } else {
                                    if ($jumlah_penilai > 0) {
                                        foreach ($sidang->nilaiPembimbing2 as $value) {
                                            $total_nilai +=
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
                                        $nilai_pembimbing2 = $total_nilai / $jumlah_penilai;
                                    } else {
                                        $nilai_pembimbing2 = 0;
                                    }
                                }
                            @endphp
                            <td>{{ $nilai_pembimbing2 }}</td>
                            @if (auth()->user()->level == 'Dosen')
                                <td><a href="/berinilai/{{ $sidang->id }}/pembimbing2/{{ $jenjang }}"
                                        class="btn btn-warning"><i class="fas fa-edit"></i></a></td>
                            @endif
                        </tr>
                        <tr>
                            <td></td>
                            <td>Nilai Rata-rata Pembimbing :</td>
                            <td></td>
                            @php
                                $rata_pendidikan = ($nilai_pembimbing1 + $nilai_pembimbing2) / 2;
                            @endphp
                            <td>{{ $rata_pendidikan }}</td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>Ketua</td>
                            <td>{{ $sidang->ta->Dpembimbing1->user->name }} /
                                {{ $sidang->ta->Dpembimbing2->user->name }} </td>
                            @php
                                $total_nilai = 0;
                                $jumlah_penilai = $sidang->nilaiketua->count();

                                if ($jenjang === 'D4') {
                                    if ($jumlah_penilai > 0) {
                                        foreach ($sidang->nilaiketua as $value) {
                                            $total_nilai +=
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
                                        $nilai_ketua = $total_nilai / $jumlah_penilai;
                                    } else {
                                        $nilai_ketua = 0;
                                    }
                                } else {
                                    if ($jumlah_penilai > 0) {
                                        foreach ($sidang->nilaiketua as $value) {
                                            $total_nilai +=
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
                                        $nilai_ketua = $total_nilai / $jumlah_penilai;
                                    } else {
                                        $nilai_ketua = 0;
                                    }
                                }
                            @endphp
                            <td>{{ $nilai_ketua }}</td>
                            @if (auth()->user()->level == 'Dosen')
                                <td><a href="/berinilai/{{ $sidang->id }}/ketua/{{ $jenjang }}"
                                        class="btn btn-warning"><i class="fas fa-edit"></i></a></td>
                            @endif
                        </tr>
                        <tr>
                            <td>4</td>
                            <td>Sekretaris</td>
                            <td>{{ $sidang->psek_sidang->user->name }} </td>
                            @php
                                $total_nilai = 0;
                                $jumlah_penilai = $sidang->nilaisekretaris->count();

                                if ($jenjang === 'D4') {
                                    if ($jumlah_penilai > 0) {
                                        foreach ($sidang->nilaisekretaris as $value) {
                                            $total_nilai +=
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
                                        $nilai_sekretaris = $total_nilai / $jumlah_penilai;
                                    } else {
                                        $nilai_sekretaris = 0;
                                    }
                                } else {
                                    if ($jumlah_penilai > 0) {
                                        foreach ($sidang->nilaisekretaris as $value) {
                                            $total_nilai +=
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
                                        $nilai_sekretaris = $total_nilai / $jumlah_penilai;
                                    } else {
                                        $nilai_sekretaris = 0;
                                    }
                                }
                            @endphp
                            <td>{{ $nilai_sekretaris }}</td>
                            @if (auth()->user()->level == 'Dosen')
                                <td><a href="/berinilai/{{ $sidang->id }}/sekretaris/{{ $jenjang }}"
                                        class="btn btn-warning"><i class="fas fa-edit"></i></a></td>
                            @endif
                        </tr>
                        <tr>
                            <td>5</td>
                            <td>Anggota 1</td>
                            <td>{{ $sidang->panggota1->user->name }} </td>
                            @php
                                $total_nilai = 0;
                                $jumlah_penilai = $sidang->nilaianggota1->count();

                                if ($jenjang === 'D4') {
                                    if ($jumlah_penilai > 0) {
                                        foreach ($sidang->nilaianggota1 as $value) {
                                            $total_nilai +=
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
                                        $nilai_anggota1 = $total_nilai / $jumlah_penilai;
                                    } else {
                                        $nilai_anggota1 = 0;
                                    }
                                } else {
                                    if ($jumlah_penilai > 0) {
                                        foreach ($sidang->nilaianggota1 as $value) {
                                            $total_nilai +=
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
                                        $nilai_anggota1 = $total_nilai / $jumlah_penilai;
                                    } else {
                                        $nilai_anggota1 = 0;
                                    }
                                }
                            @endphp
                            <td>{{ $nilai_anggota1 }}</td>
                            @if (auth()->user()->level == 'Dosen')
                                <td><a href="/berinilai/{{ $sidang->id }}/anggota1/{{ $jenjang }}"
                                        class="btn btn-warning"><i class="fas fa-edit"></i></a></td>
                            @endif
                        </tr>
                        <tr>
                            <td>6</td>
                            <td>Anggota 2</td>
                            <td>{{ $sidang->panggota2->user->name }} </td>
                            @php
                                $total_nilai = 0;
                                $jumlah_penilai = $sidang->nilaianggota2->count();

                                if ($jenjang === 'D4') {
                                    if ($jumlah_penilai > 0) {
                                        foreach ($sidang->nilaianggota2 as $value) {
                                            $total_nilai +=
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
                                        $nilai_anggota2 = $total_nilai / $jumlah_penilai;
                                    } else {
                                        $nilai_anggota2 = 0;
                                    }
                                } else {
                                    if ($jumlah_penilai > 0) {
                                        foreach ($sidang->nilaianggota2 as $value) {
                                            $total_nilai +=
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
                                        $nilai_anggota2 = $total_nilai / $jumlah_penilai;
                                    } else {
                                        $nilai_anggota2 = 0;
                                    }
                                }
                            @endphp
                            <td>{{ $nilai_anggota2 }}</td>
                            @if (auth()->user()->level == 'Dosen')
                                <td><a href="/berinilai/{{ $sidang->id }}/anggota2/{{ $jenjang }}"
                                        class="btn btn-warning"><i class="fas fa-edit"></i></a></td>
                            @endif
                        </tr>
                        <tr>
                            <td></td>
                            <td>Nilai Rata-rata Penguji :</td>
                            <td></td>
                            @php
                                $rata_penguji =
                                    ($nilai_ketua + $nilai_sekretaris + $nilai_anggota1 + $nilai_anggota2) / 4;
                            @endphp
                            <td>{{ $rata_penguji }}</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>Nilai Akhir :</td>
                            <td></td>
                            @php
                                $nilai_akhir = ($rata_pendidikan + $rata_penguji) / 2;

                                $status = 'Tidak Lulus';
                                if ($nilai_akhir > 65) {
                                    $status = 'Lulus';
                                }

                            @endphp
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
            <!-- <button type="submit" class="btn btn-primary" value="update">Save</button> -->
            <!-- </form> -->
        </div>

    @endsection
