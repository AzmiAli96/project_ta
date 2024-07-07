@extends('layout.main')
@section('title', 'Dosen')
@section('content')

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Data Dosen</h1>
@if (session()->has('pesan'))
<div class="alert alert-primary" role="alert">
    {{ session('pesan') }}
</div>
@endif

@if (session()->has('error'))
<div class="alert alert-danger" role="alert">
    {{ session('error') }}
</div>
@endif

<div class="card mb-4">
    <div class="card-header py-3">
        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <form action="/dosen" method="GET" class="d-none d-sm-inline-block form-inline mr-auto md-3 my-2 my-md-0 mw-100 navbar-search">
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
            <a href="/exportDosen" class="btn button-purple btn-sm">
                <i class="fas fa-solid fa-download"></i> Export
            </a>
            <a href="/importDosen" class="btn button-purple btn-sm" data-toggle="modal" data-target="#importForm">
                <i class="fas fa-solid fa-upload"></i> Import
            </a>
            <a href="dosen/create" class="btn button-purple">
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
                        <th>NIDN</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>NO Telp</th>
                        <th>alamat</th>
                        <th class="d-flex justify-content-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dosens as $dosen )
                    <tr>
                        <td>{{ $dosens->firstItem()+$loop->index }}</td>
                        <td>{{$dosen->nidn}}</td>
                        <td>{{ $dosen->user->name ?? 'belum ada akun' }}</td>
                        <td>{{ $dosen->user->email ?? 'belum ada akun' }}</td>
                        <td>{{ $dosen->no_telp }}</td>
                        <td>{{ $dosen->alamat }}</td>
                        <td class="gap-2 d-md-flex justify-content-md-end">
                            <form action="/dosen/{{$dosen->id}}" method="post" class="d-inline">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="btn btn-outline-danger btn-sm" onclick="return confirm('Yakin mau dihapus?')"><i class="fas fa-trash-alt"></i></button>
                            </form>
                            <a href="/dosen/{{$dosen->id}}/edit" class="btn btn-outline-warning btn-sm"><i class="fas fa-edit"></i></a>
                        </td>
                    </tr>
                    @endforeach
            </table>
            {{ $dosens->links() }}
        </div>
    </div>
</div>

<div class="modal fade" id="importForm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Import Data Dosen</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form action="/importDosen" method="POST" enctype="multipart/form-data">
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
