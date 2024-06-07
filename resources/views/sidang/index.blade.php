@extends('layout.main')
@section('title', 'Jadwal Sidang')
@section('content')

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Tables Data Jadwal Sidang</h1>
<!-- <p class="mb-4">Semua </p> -->
@if (session()->has('pesan'))
<div class="alert alert-primary" role="alert">
    {{ session('pesan') }}
</div>
@endif

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">DataTables Jadwal Sidang</h6>
    </div>

    <div class="card-body">

        <div class="d-grid gap-2 d-md-flex justify-content-md-end mb-3">
            <!-- Topbar Search -->
            <form action="/sidang" method="GET" class="d-none d-sm-inline-block form-inline mr-auto md-3 my-2 my-md-0 mw-100 navbar-search">
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
            <a href="sidang/create" class="btn btn-primary mb-3">Create</a>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>NoBP</th>
                        <th>Mahasiswa</th>
                        <th>Judul</th>
                        <th>Dokumen</th>
                        <th>Tanggal</th>
                        <th>Ruangan</th>
                        <th>Sesi</th>
                        <th>Ketua Sidang</th>
                        <th>Sekretaris Sidang</th>
                        <th>Anggota sidang 1</th>
                        <th>Anggota sidang 2</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($sidangs as $sidang )
                    <tr>
                        <td>{{ $sidangs->firstItem()+$loop->index }}</td>
                        <td>{{ $sidang->validasi->ta->nobp }}</td>
                        <td>{{ $sidang->validasi->ta->mahasiswa->user->name }}</td>
                        <td>{{ $sidang->validasi->ta->judul }}</td>
                        <td>{{ $sidang->validasi->ta->dokumen }}</td>
                        <td>{{ $sidang->jadwal->tanggal }}</td>
                        <td>{{ $sidang->jadwal->ruangan->nama_ruangan }}</td>
                        <td>{{ $sidang->jadwal->sesi->sesi }}</td>
                        <td>{{ $sidang->validasi->ta->Dpembimbing1->user->name }} && {{ $sidang->validasi->ta->Dpembimbing2->user->name }}</td>
                        <td>{{ $sidang->psek_sidang->user->name }}</td>
                        <td>{{ $sidang->panggota1->user->name }}</td>
                        <td>{{ $sidang->panggota2->user->name }}</td>
                        <td>
                            <form action="/sidang/{{$sidang->id}}" method="post" class="d-inline">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin mau dihapus?')"><i class="fas fa-trash-alt"></i></button>
                            </form>
                            <a href="/sidang/{{$sidang->id}}/edit" class="btn btn-warning"><i class="fas fa-edit"></i></a>
                        </td>
                    </tr>
                    @endforeach
            </table>
            {{ $sidangs->links() }}
        </div>
    </div>
</div>

@endsection