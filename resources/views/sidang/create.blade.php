@extends('layout.main')
@section('title', 'create Jadwal Sidang')
@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h2>Create Jadwal Sidang</h2>
</div>
@if (session()->has('pesan'))    
<div class="alert alert-primary" role="alert">
    {{ session('pesan') }}
</div>
@endif
<div class="col-6">
    <form action="/sidang" method="post">
        @csrf
        <div class="mb-3">
            <label class="form-label @error('validasi_id') is-invalid @enderror">Mahasiswa TA</label>
            <select name="validasi_id" class="form-select">
                <option value="" hidden>--pilih Mahasiswa--</option>
                @foreach ($validasis as $validasi)
                <option value="{{$validasi->id}}">{{$validasi->id}}  -   {{$validasi->nama}}</option>
                @endforeach
            </select>
            @error('validasi_id')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label @error('tanggal_id') is-invalid @enderror">Tanggal Penjadwalan</label>
            <select name="tanggal_id" class="form-select">
                <option value="" hidden>--pilih Tanggal penjadwalan--</option>
                @foreach ($tanggals as $tanggal)
                <option value="{{$tanggal->id}}">{{$tanggal->id}}</option>
                @endforeach
            </select>
            @error('tanggal_id')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label @error('sekr_sidang') is-invalid @enderror">Sekretaris Sidang</label>
            <select name="sekr_sidang" class="form-select">
                <option value="" hidden>--pilih dosen--</option>
                @foreach ($dosens as $dosen)
                <option value="{{$dosen->id}}">{{$dosen->user->name}}</option>
                @endforeach
            </select>
            @error('sekr_sidang')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label @error('anggota_sidang') is-invalid @enderror">Anggota Sidang</label>
            <select name="anggota_sidang" class="form-select">
                <option value="" hidden>--pilih dosen pembimbing--</option>
                @foreach ($dosens as $dosen)
                <option value="{{$dosen->id}}">{{$dosen->user->name}}</option>
                @endforeach
            </select>
            @error('anggota_sidang')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">submit</button>
    </form>
</div>

@endsection