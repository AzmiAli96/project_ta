@extends('layout.main')
@section('title', 'Mahasiswa')
@section('content')

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Tables</h1>
<p class="mb-4">Semua Data Mahasiswa</p>
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
            <a href="mahasiswa/create" class="btn btn-primary mb-3">create</a>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>NO BP</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Prodi</th>
                        <th>status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($mahasiswas as $mahasiswa )
                    <tr>
                        <td>{{ $mahasiswas->firstItem()+$loop->index }}</td>
                        <td>{{$mahasiswa->no_bp}}</td>
                        <td>{{ $mahasiswa->nama }}</td>
                        <td>{{ $mahasiswa->email }}</td>
                        <td>{{ $mahasiswa->prodi_id }}</td>
                        <td>{{ $mahasiswa->status_id }}</td>
                        <td>
                            <form action="/mahasiswa/{{$mahasiswa->id}}" method="post" class="d-inline">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin mau dihapus?')">Delete</button>
                            </form>
                            <a href="/mahasiswa/{{$mahasiswa->id}}/edit" class="btn btn-warning">Edit</a>
                        </td>
                    </tr>
                    @endforeach
            </table>
            {{ $mahasiswas->links() }}
        </div>
    </div>
</div>

@endsection