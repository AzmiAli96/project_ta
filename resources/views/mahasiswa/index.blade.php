@extends('layout.main')
@section('title', 'Mahasiswa')
@section('content')

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Data Mahasiswa</h1>
<!-- <p class="mb-4">Semua </p> -->
@if (session()->has('pesan'))
<div class="alert alert-primary" role="alert">
    {{ session('pesan') }}
</div>
@endif

<div class="card mb-4">
    <div class="card-header py-3">
        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <!-- Topbar Search -->
            <form action="/mahasiswa" method="GET" class="d-none d-sm-inline-block form-inline mr-auto md-3 my-2 my-md-0 mw-100 navbar-search">
                @csrf
                <div class="input-group">
                    <input type="text" name="search" class="form-control border-0 small" placeholder="Cari mahasiswa" aria-label="Search" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="submit">
                        <i class="fas fa-search fa-sm"></i>
                        </button>
                    </div>
                </div>
            </form>
            <a href="/exportMahasiswa" class="btn btn-dark btn-sm">
                <i class="fas fa-solid fa-download"></i> Export
            </a>
            <a href="/importMahasiswa" class="btn btn-dark btn-sm" data-toggle="modal" data-target="#importForm">
                <i class="fas fa-solid fa-upload"></i> Import
            </a>
            <a href="mahasiswa/create" class="btn btn-primary">
                <i class="fas fa-plus-circle"></i>
            </a>
        </div>
    </div>

    <div class="card-body">

      
        <div class="table-responsive">
            <table class="table table-striped" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>NO BP</th>
                        <th>Nama</th>
                        <th>Jurusan</th>
                        <th>Prodi</th>
                        <th>IPS</th>
                        <th class="d-flex justify-content-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($mahasiswas as $mahasiswa )
                    <tr>
                        <td>{{ $mahasiswas->firstItem()+$loop->index }}</td>
                        <td>{{$mahasiswa->nobp}}</td>
                        <td>{{ $mahasiswa->namalengkap }}</td>
                        <td>{{ $mahasiswa->jurusan->nama_jurusan }}</td>
                        <td>{{ $mahasiswa->prodi->nama_prodi }}</td>
                        <td>{{ $mahasiswa->ips }}</td>
                        <td class="gap-2 d-md-flex justify-content-md-end">
                            <form action="/mahasiswa/{{$mahasiswa->id}}" method="post" class="d-inline">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="btn btn-outline-danger btn-sm" onclick="return confirm('Yakin mau dihapus?')"><i class="fas fa-trash-alt"></i></button>
                            </form>
                            <a href="/mahasiswa/{{$mahasiswa->id}}/edit" class="btn btn-outline-warning btn-sm"><i class="fas fa-edit"></i></a>
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
                    <input class="form-control" type="file" name="file" id="formFile">
                </div>
                <div class="modal-footer">
                    <button class="btn btn-danger" type="button" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Import</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection