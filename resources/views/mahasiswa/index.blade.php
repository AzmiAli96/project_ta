@extends('layout.main')
@section('title', 'Mahasiswa')
@section('content')

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Tables Data Mahasiswa</h1>
<!-- <p class="mb-4">Semua </p> -->
@if (session()->has('pesan'))
<div class="alert alert-primary" role="alert">
    {{ session('pesan') }}
</div>
@endif

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">DataTables Mahasiswa</h6>
    </div>

    <div class="card-body">

        <div class="d-grid gap-2 d-md-flex justify-content-md-end mb-3">
            <!-- Topbar Search -->
            <form action="/mahasiswa" method="GET" class="d-none d-sm-inline-block form-inline mr-auto md-3 my-2 my-md-0 mw-100 navbar-search">
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
            <a href="/exportMahasiswa" class="btn btn-primary mb-3 mr-1">
                <i class="fas fa-solid fa-plus"> Export</i>
            </a>
            <a href="/importMahasiswa" class="btn btn-primary mb-3 mr-1" data-toggle="modal" data-target="#importForm">
                <i class="fas fa-solid fa-plus"> Import</i>
            </a>
            <a href="mahasiswa/create" class="btn btn-primary mb-3">Create</a>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>NO BP</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Jurusan</th>
                        <th>Prodi</th>
                        <th>IPS</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($mahasiswas as $mahasiswa )
                    <tr>
                        <td>{{ $mahasiswas->firstItem()+$loop->index }}</td>
                        <td>{{$mahasiswa->nobp}}</td>
                        <td>{{ $mahasiswa->user->name }}</td>
                        <td>{{ $mahasiswa->user->email }}</td>
                        <td>{{ $mahasiswa->jurusan->nama_jurusan }}</td>
                        <td>{{ $mahasiswa->prodi->nama_prodi }}</td>
                        <td>{{ $mahasiswa->ips }}</td>
                        <td>
                            <form action="/mahasiswa/{{$mahasiswa->id}}" method="post" class="d-inline">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin mau dihapus?')"><i class="fas fa-trash-alt"></i></button>
                            </form>
                            <a href="/mahasiswa/{{$mahasiswa->id}}/edit" class="btn btn-warning"><i class="fas fa-edit"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $mahasiswas->links() }}
        </div>
    </div>
</div>

<div class="modal fade" id="importForm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Import Data Mahasiswa</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="/importMahasiswa" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <label for="formFile" class="form-label">Default file input example</label>
                    <input class="form-control" type="file" name="file" id="formFile">
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Import</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection