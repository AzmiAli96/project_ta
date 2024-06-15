@extends('layout.main')
@section('title', 'Prodi')
@section('content')

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Data Prodi</h1>
<!-- <p class="mb-4">Semua </p> -->
@if (session()->has('pesan'))
<div class="alert alert-primary" role="alert">
    {{ session('pesan') }}
</div>
@endif

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <!-- Topbar Search -->
            <form action="/prodi" method="GET" class="d-none d-sm-inline-block form-inline mr-auto md-3 my-2 my-md-0 mw-100 navbar-search">
                @csrf
                <div class="input-group">
                    <input type="text" name="search" class="form-control border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="submit">
                            <i class="fas fa-search fa-sm"></i>
                        </button>
                    </div>
                </div>
            </form>
            <a href="prodi/create" class="btn btn-primary">
                <i class="fas fa-solid fa-plus-circle"></i>
            </a>
        </div>
    </div>

    <div class="card-body">

        
        <div class="table-responsive">
            <table class="table table-striped" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode Prodi</th>
                        <th>jenjang</th>
                        <th>Prodi</th>
                        <th>Jurusan</th>
                        <th>Ketua Program Studi</th>
                        <th class="d-flex justify-content-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($prodis as $prodi )
                    <tr>
                        <td>{{ $prodis->firstItem()+$loop->index }}</td>
                        <td>{{ $prodi->kode_prodi }}</td>
                        <td>{{ $prodi->jenjang }}</td>
                        <td>{{ $prodi->nama_prodi }}</td>
                        <td>{{ $prodi->jurusan->nama_jurusan }}</td>
                        <td>{{ $prodi->pkaprodi->user->name }}</td>
                        <td class="gap-2 d-md-flex justify-content-md-end">
                            <form action="/prodi/{{$prodi->id}}" method="post" class="d-inline">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="btn btn-outline-danger btn-sm" onclick="return confirm('Yakin mau dihapus?')"><i class="fas fa-trash-alt"></i></button>
                            </form>
                            <a href="/prodi/{{$prodi->id}}/edit" class="btn btn-outline-warning btn-sm"><i class="fas fa-edit"></i></a>
                        </td>
                    </tr>
                    @endforeach
            </table>
            {{ $prodis->links() }}
        </div>
    </div>
</div>

@endsection