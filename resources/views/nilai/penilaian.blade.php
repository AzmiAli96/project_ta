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
        <h6 class="m-0 font-weight-bold text-primary">DataTables Penilaian</h6>
    </div>

    <div class="card-body">

        <div class="d-grid gap-2 d-md-flex justify-content-md-end mb-3">
            <!-- Topbar Search -->
            <form action="/nilai" method="GET" class="d-none d-sm-inline-block form-inline mr-auto md-3 my-2 my-md-0 mw-100 navbar-search">
                @csrf
                <div class="input-group">
                    <input type="text" name="search" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="submit">
                            <i class="fas fa-search fa-sm"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
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
                @foreach ($nilais as $nilai )
                    <tr>
                        <td>1</td>
                        <td>Ketua Sidang</td>
                        <td>{{ $nilai->sidang->validasi->ta->Dpembimbing1->user->name }} </td>
                        <td>nilai</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>{{ $nilai->sidang->validasi->ta->Dpembimbing2->user->name }}</td>
                        <td>Nama </td>
                        <td>nilai</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>Nilai Rata-rata Pembimbing :</td>
                        <td>nilai</td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Ketua</td>
                        <td>Nama </td>
                        <td>nilai</td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>Sekretaris</td>
                        <td>Nama </td>
                        <td>nilai</td>
                    </tr>
                    <tr>
                        <td>5</td>
                        <td>Anggota 1</td>
                        <td>Nama </td>
                        <td>nilai</td>
                    </tr>
                    <tr>
                        <td>6</td>
                        <td>Anggota 2</td>
                        <td>Nama </td>
                        <td>nilai</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>Nilai Rata-rata Penguji :</td>
                        <td></td>
                        <td>nilai</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>Nilai Akhir :</td>
                        <td></td>
                        <td>nilai</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>Hasil Akhir :</td>
                        <td></td>
                        <td>nilai</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection