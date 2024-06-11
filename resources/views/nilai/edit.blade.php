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
<div class="col-6">
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
                        <td>Ketua Sidang</td>
                        <td>{{ $nilai->sidang->validasi->ta->Dpembimbing1->user->name }} </td>
                        <td>nilai</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>{{ $nilai->sidang->validasi->ta->Dpembimbing2->user->name }}</td>
                        <td>Nama </td>
                        <td>nilai</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>Nilai Rata-rata Pembimbing :</td>
                        <td>nilai</td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Ketua</td>
                        <td>Nama </td>
                        <td>nilai</td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>Sekretaris</td>
                        <td>Nama </td>
                        <td>nilai</td>
                    </tr>
                    <tr>
                        <td>5</td>
                        <td>Anggota 1</td>
                        <td>Nama </td>
                        <td>nilai</td>
                    </tr>
                    <tr>
                        <td>6</td>
                        <td>Anggota 2</td>
                        <td>Nama </td>
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