@extends('layout.main')
@section('title', 'Penilaian')
@section('content')

    <!-- <p class="mb-4">Semua </p> -->
    @if (session()->has('pesan'))
        <div class="alert alert-primary" role="alert">
            {{ session('pesan') }}
        </div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">DataTables Rekap Nilai</h6>
        </div>

        <div class="card-body">

            <div class="d-grid gap-2 d-md-flex justify-content-md-end mb-3">
                <!-- Topbar Search -->
                <form action="/sidang" method="GET"
                    class="d-none d-sm-inline-block form-inline mr-auto md-3 my-2 my-md-0 mw-100 navbar-search">
                    @csrf
                    <div class="input-group">
                        <input type="text" name="search" class="form-control bg-light border-0 small"
                            placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="submit">
                                <i class="fas fa-search fa-sm"></i>
                            </button>
                        </div>
                    </div>
                </form>
                {{-- <a href="nilai/create" class="btn btn-primary mb-3">Create</a> --}}
            </div>
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
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
                                <td>{{ $sidangs->firstItem() + $loop->index }}</td>
                                <td>{{ $sidang->ta->nobp }} / {{ $sidang->ta->mahasiswa->namalengkap }}
                                </td>
                                <td>{{ $sidang->ta->mahasiswa->prodi->jenjang }} -
                                    {{ $sidang->ta->mahasiswa->prodi->kode_prodi }}</td>
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
                                    $rata_penguji =
                                        ($nilai_ketua + $nilai_sekretaris + $nilai_anggota1 + $nilai_anggota2) / 4;
                                    $nilai_akhir = ($rata_pendidikan + $rata_penguji) / 2;

                                    // $status = 'Tidak Lulus';
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
                                        // $status = 'Lulus';
                                        $sidang->update(["status"=>true]);
                                    } else {
                                        $sidang->update(["status"=>false]);
                                    }
                                @endphp
                                <td>{{ $nilai_akhir }}</td>
                                <td>{{ $sidang->status == 1 ? 'Lulus' : 'Belum Lulus' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $sidangs->links() }}
            </div>
        </div>
    </div>

@endsection
