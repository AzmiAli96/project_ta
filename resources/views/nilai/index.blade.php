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
            <h6 class="m-0 font-weight-bold text-primary">DataTables Nilai</h6>
        </div>

        <div class="card-body">

            <div class="d-grid gap-2 d-md-flex justify-content-md-end mb-3">
                <!-- Topbar Search -->
                <form action="/prodi" method="GET"
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
                            <th>Ketua Sidang</th>
                            <th>Sekretaris Sidang</th>
                            <th>Anggota Sidang</th>
                            {{-- <th>Nilai Akhir</th>
                            <th>Status</th> --}}
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($sidangs as $sidang)
                            <tr>
                                <td>{{ $sidangs->firstItem() + $loop->index }}</td>
                                <td>{{ $sidang->ta->nobp }} / {{ $sidang->ta->mahasiswa->user->name }}
                                </td>
                                <td>{{ $sidang->ta->mahasiswa->prodi->jenjang }} -
                                    {{ $sidang->ta->mahasiswa->prodi->kode_prodi }}</td>
                                <td>{{ $sidang->ta->Dpembimbing1->user->name }} &&
                                    {{ $sidang->ta->Dpembimbing2->user->name }}</td>
                                <td>{{ $sidang->psek_sidang->user->name }}</td>
                                <td>{{ $sidang->panggota1->user->name }} & {{ $sidang->panggota2->user->name }}</td>
                                {{-- @php

                                    $total_nilai = 0;
                                    $jumlah_penilai = $sidang->nilaiPembimbing1->count();

                                    
                                    if ($sidang->validasi->ta->mahasiswa->prodi->jenjang === 'D4') {
                                        // $rataPend = $sidang->nilaiPembimbing1
                                        foreach ($sidang->nilai as $value) {
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
                                    } else {
                                        foreach ($sidang->nilai as $value) {
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
                                    }
                                    // Menghitung rata-rata nilai akhir
                                    if ($sidang->nilai->count() != 0) {
                                        $nilai_akhir = $total_nilai / $sidang->nilai->count();
                                    }

                                    $status = 'Tidak Lulus';
                                    if ($nilai_akhir > 65) {
                                        $status = 'Lulus';
                                    }
                                @endphp
                                <td>{{ $nilai_akhir }}</td>
                                <td>{{ $status }}</td> --}}
                                <td>
                                    <a class="btn btn-sm btn-warning" href="/nilai/{{ $sidang->id }}/edit"><i
                                            class="fas fa-edit"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $sidangs->links() }}
            </div>
        </div>
    </div>

@endsection
