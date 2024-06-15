@extends('layout.main')
@section('title', 'Jurusan')
@section('content')

<!-- <p class="mb-4">Semua </p> -->
@if (session()->has('pesan'))
<div class="alert alert-primary" role="alert">
    {{ session('pesan') }}
</div>
@endif

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">DataTables Jurusan</h6>
    </div>

    <div class="card-body">

        <div class="d-grid gap-2 d-md-flex justify-content-md-end mb-3">
            <!-- Topbar Search -->
            <form action="/jurusan" method="GET" class="d-none d-sm-inline-block form-inline mr-auto md-3 my-2 my-md-0 mw-100 navbar-search">
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
            <a href="jurusan/create" class="btn btn-primary">
                <i class="fas fa-solid fa-plus-circle"></i>
            </a>
        </div>
        <div class="table-responsive">
            <table class="table table-striped" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode Jurusan</th>
                        <th>Jurusan</th>
                        <th>Ketua Jurusan</th>
                        <th>Sekretaris Jurusan</th>
                        <th class=" d-flex justify-content-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($jurusans as $jurusan )
                    <tr>
                        <td>{{ $jurusans->firstItem()+$loop->index }}</td>
                        <td>{{ $jurusan->kode_jurusan }}</td>
                        <td>{{ $jurusan->nama_jurusan }}</td>
                        <td>{{ $jurusan->pkajur->user?->name }}</td>
                        <td>{{ $jurusan->psekjur->user?->name }}</td>
                        <td class="gap-2 d-md-flex justify-content-md-end">
                            <form action="/jurusan/{{$jurusan->id}}" method="post" class="d-inline">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Yakin mau dihapus?')"><i class="fas fa-trash-alt"></i></button>
                            </form>
                            <a href="/jurusan/{{$jurusan->id}}/edit" class="btn btn-sm btn-outline-warning"><i class="fas fa-edit"></i></a>
                        </td>
                    </tr>
                    @endforeach
            </table>
            {{ $jurusans->links() }}
        </div>
    </div>
</div>

@endsection