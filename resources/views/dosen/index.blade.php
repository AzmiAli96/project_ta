@extends('layout.main')
@section('title', 'Dosen')
@section('content')

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Tables</h1>
<p class="mb-4">Semua Data Dosen</p>
@if (session()->has('pesan'))
<div class="alert alert-primary" role="alert">
    {{ session('pesan') }}
</div>
@endif

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">DataTables Dosen</h6>
    </div>

    <div class="card-body">

        <div class="d-grid gap-2 d-md-flex justify-content-md-end mb-3">
            <a href="/exportDosen" class="btn btn-primary mb-3 mr-1">
                <i class="fas fa-solid fa-plus"> Export</i>
            </a>
            <a href="/importDosen" class="btn btn-primary mb-3 mr-1" data-toggle="modal" data-target="#importForm">
                <i class="fas fa-solid fa-plus"> Import</i>
            </a>
            <a href="dosen/create" class="btn btn-primary mb-3">Create</a>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>NIDN</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>NO Telp</th>
                        <th>Roll</th>
                        <th>alamat</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dsn as $dosen )
                    <tr>
                        <td>{{ $dsn->firstItem()+$loop->index }}</td>
                        <td>{{$dosen->nidn}}</td>
                        <td>{{ $dosen->user->name }}</td>
                        <td>{{ $dosen->user->email }}</td>
                        <td>{{ $dosen->no_telp }}</td>
                        <td>{{ $dosen->sebagai }}</td>
                        <td>{{ $dosen->alamat }}</td>
                        <td>
                            <form action="/dosen/{{$dosen->id}}" method="post" class="d-inline">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin mau dihapus?')"><i class="fas fa-trash-alt"></i></button>
                            </form>
                            <a href="/dosen/{{$dosen->id}}/edit" class="btn btn-warning"><i class="fas fa-edit"></i></a>
                        </td>
                    </tr>
                    @endforeach
            </table>
            {{ $dsn->links() }}
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