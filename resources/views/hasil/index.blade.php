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
        <h6 class="m-0 font-weight-bold text-primary">DataTables Prodi</h6>
    </div>

    <div class="card-body">

        <div class="d-grid gap-2 d-md-flex justify-content-md-end mb-3">
            <!-- Topbar Search -->
            <form action="/hasil" method="GET" class="d-none d-sm-inline-block form-inline mr-auto md-3 my-2 my-md-0 mw-100 navbar-search">
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
            <a href="hasil/create" class="btn btn-primary mb-3">Create</a>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Mahasiswa</th>
                        <th>Prodi</th>
                        <th>Ketua Sidang</th>
                        <th>Sekretaris Sidang</th>
                        <th>Anggota Sidang</th>
                        <th>Nilai Akhir</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($hasils as $hasil )
                    <tr>
                        <td>{{ $hasils->firstItem()+$loop->index }}</td>
                        <td>{{$hasil->sidang->validasi->ta->nobp}} / {{ $hasil->sidang->validasi->ta->mahasiswa->user->name }}</td>
                        <td>{{$hasil->sidang->validasi->ta->mahasiswa->prodi->jenjang}} - {{ $hasil->sidang->validasi->ta->mahasiswa->prodi->kode_prodi }}</td>
                        <td>{{ $hasil->sidang->validasi->ta->Dpembimbing1->user->name }} && {{ $hasil->sidang->validasi->ta->Dpembimbing2->user->name }}</td>
                        <td>{{ $hasil->sidang->psek_sidang->user->name }}</td>
                        <td>{{ $hasil->sidang->panggota1->user->name }} & {{ $hasil->sidang->panggota2->user->name }}</td>
                        <td>{{ $hasil->hasil_akhir }}</td>
                        <td>{{ $hasil->status ? 'Lulus':'Belum lulus' }}</td>
                        <td>
                            <form action="/hasil/{{$hasil->id}}" method="post" class="d-inline">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin mau dihapus?')"><i class="fas fa-trash-alt"></i></button>
                            </form>
                            {{-- <form action="/hasil/{{$hasil->id}}/edit" method="POST">
                                @method('PUT')
                                @csrf
                                <input type="hidden" name="jenjang" value="{{$hasil->sidang->validasi->ta->mahasiswa->prodi->jenjang}}">
                                <button type="submit" class="btn btn-warning"><i class="fas fa-edit"></i></button>
                            </form> --}}
                            <a class="btn btn-sm btn-warning" href="/hasil/{{ $hasil->id }}/edit"><i class="fas fa-edit"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $hasils->links() }}
        </div>
    </div>
</div>

@endsection