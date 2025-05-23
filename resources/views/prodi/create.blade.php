@extends('layout.main')
@section('title', 'create Prodi')
@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h2>Create Prodi</h2>
</div>
@if (session()->has('pesan'))    
<div class="alert alert-primary" role="alert">
    {{ session('pesan') }}
</div>
@endif
<div class="col-6">
    <form action="/prodi" method="post">
        @csrf
        <div class="mb-3">
            <label class="form-label">Kode Prodi</label>
            <input type="text" class="form-control @error('kode_prodi') is-invalid @enderror" name="kode_prodi" value="{{old('kode_prodi')}}">
            @error('kode_prodi')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">jenjang</label>
            <input type="text" class="form-control @error('jenjang') is-invalid @enderror" name="jenjang" value="{{old('jenjang')}}">
            @error('jenjang')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Prodi</label>
            <input type="text" class="form-control @error('nama_prodi') is-invalid @enderror" name="nama_prodi" value="{{old('nama_prodi')}}">
            @error('nama_prodi')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label @error('jurusan_id') is-invalid @enderror">Jurusan</label>
            <select name="jurusan_id" class="form-select">
                <option value="" hidden>--pilih jurusan--</option>
                @foreach ($jurusans as $jurusan)
                <option value="{{$jurusan->id}}">{{$jurusan->nama_jurusan}}</option>
                @endforeach
            </select>
            @error('jurusan_id')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label @error('kaprodi') is-invalid @enderror">Ketua Program Studi</label>
            <select name="kaprodi" class="form-select">
                <option value="" hidden>--pilih ketua program studi--</option>
                @foreach ($dosens as $dosen)
                <option value="{{$dosen->id}}">{{$dosen->user->name}}</option>
                @endforeach
            </select>
            @error('kaprodi')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">submit</button>
    </form>
</div>

@endsection