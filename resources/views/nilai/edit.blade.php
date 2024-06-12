@extends('layout.main')
@section('title', 'Edit Penilaian')
@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h2>Edit Penilaian</h2>
</div>
@if (session()->has('pesan'))
<div class="alert alert-primary" role="alert">
    {{ session('pesan') }}
</div>
@endif
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">DataTables nilai</h6>
    </div>
<div class="card-body">
    <form action="/nilai/{{ $nilai->id }}" method="post">
        @method('PUT')
        @csrf
        <div class="table-responsive">
            <table class="table table-bordered" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Jabatan</th>
                        <th>Nama</th>
                        <th>Total Nilai</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($nilais as $nilai )
                    <tr>
                        <td>1</td>
                        <td>Pembimbing 1/td>
                        <td>{{ $nilai->sidang->validasi->ta->Dpembimbing1->user->name }} </td>
                        <td>nilai</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Pembimbing 2 </td>
                        <td>{{ $nilai->sidang->validasi->ta->Dpembimbing2->user->name }}</td>
                        <td>nilai</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>Nilai Rata-rata Pembimbing :</td>
                        <td></td>
                        <td>nilai</td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Ketua</td>
                        <td>{{ $nilai->sidang->validasi->ta->Dpembimbing1->user->name }} / {{ $nilai->sidang->validasi->ta->Dpembimbing2->user->name }} </td>
                        <td>nilai</td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>Sekretaris</td>
                        <td>{{ $nilai->sidang->psek_sidang->user->name }} </td>
                        <td>nilai</td>
                    </tr>
                    <tr>
                        <td>5</td>
                        <td>Anggota 1</td>
                        <td>{{ $nilai->sidang->panggota1->user->name }} </td>
                        <td>nilai</td>
                    </tr>
                    <tr>
                        <td>6</td>
                        <td>Anggota 2</td>
                        <td>{{ $nilai->sidang->panggota2->user->name }} </td>
                        <td>nilai</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>Nilai Rata-rata Penguji :</td>
                        <td></td>
                        <td>nilai</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>Nilai Akhir :</td>
                        <td></td>
                        <td>nilai</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>Hasil Akhir :</td>
                        <td></td>
                        <td>nilai</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <button type="submit" class="btn btn-primary" value="update">Save</button>
    </form>
</div>

@endsection