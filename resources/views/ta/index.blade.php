@extends('layout.main')
@section('title', 'Tugas Akhir')
@section('content')

<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Tables Data Tugas Akhir</h1>
<!-- <p class="mb-4">Semua </p> -->
@if (session()->has('pesan'))
<div class="alert alert-primary" role="alert">
    {{ session('pesan') }}
</div>
@endif

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">DataTables Tugas Akhir</h6>
    </div>

    <div class="card-body">

        <div class="d-grid gap-2 d-md-flex justify-content-md-end mb-3">
            <!-- Topbar Search -->
            <form action="/ta" method="GET" class="d-none d-sm-inline-block form-inline mr-auto md-3 my-2 my-md-0 mw-100 navbar-search">
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
            @if (auth()->user()->level == 'Admin' )
            <a href="ta/create" class="btn btn-primary mb-3">Create</a>
            @endif
        </div>
        <div class="table-responsive">
            <table class="table table-bordered" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>NoBP</th>
                        <th>Judul</th>
                        <th>Dokumen</th>
                        <th>Pembimbing 1</th>
                        <th>Pembimbing 2</th>
                        {{-- <th>Keterangan</th> --}}
                        <th>Komentar</th>
                        <th>Status P1</th>
                        <th>Status P2</th>
                        <th>Status Kaprodi</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- @dd() --}}
                    @foreach ($tas as $ta )
                    <tr>
                        <td>{{ $tas->firstItem()+$loop->index }}</td>
                        <td>{{ $ta->nobp }}</td>
                        <td>{{ $ta->judul }}</td>
                        <td> <a href="/download-dokumen/{{ $ta->id }}" >{{ $ta->dokumen }}</a> </td>
                        <td>{{ $ta->Dpembimbing1->user->name }}</td>
                        <td>{{ $ta->Dpembimbing2->user->name }}</td>
                        {{-- <td>{{ $ta->ket }}</td> --}}
                        <td>{{ $ta->komentar }}</td>
                        <td>{{ $ta->status_p1 ? 'ACC':'Revisi' }}</td>
                        <td>{{ $ta->status_p2 ? 'ACC':'Revisi' }}</td>
                        <td>{{ $ta->status ? 'ACC':'Revisi' }}</td>
                        <td>
                            <form action="/ta/{{$ta->id}}" method="post" class="d-inline">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin mau dihapus?')"><i class="fas fa-trash-alt"></i></button>
                            </form>
                            <a href="/ta/{{$ta->id}}/edit" class="btn btn-warning"><i class="fas fa-edit"></i></a>
                        </td>
                    </tr>
                    @endforeach
            </table>
            {{ $tas->links() }}
        </div>
    </div>
</div>

@endsection