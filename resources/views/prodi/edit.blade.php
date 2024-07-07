@extends('layout.main')
@section('title', 'Edit Prodi')
@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h2>Edit Prodi</h2>
</div>
@if (session()->has('pesan'))
<div class="alert alert-primary" role="alert">
    {{ session('pesan') }}
</div>
@endif
<div class="col-6">
    <form action="/prodi/{{ $prodi->id }}" method="post">
        @method('PUT')
        @csrf
        <div class="mb-3">
            <label class="form-label">Kode Prodi</label>
            <input type="text" class="form-control @error('kode_prodi') is-invalid @enderror" name="kode_prodi" value="{{old('kode_prodi',$prodi->kode_prodi)}}">
            @error('kode_prodi')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">jenjang</label>
            <input type="text" class="form-control @error('jenjang') is-invalid @enderror" name="jenjang" value="{{old('jenjang', $prodi->jenjang)}}">
            @error('jenjang')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Prodi</label>
            <input type="text" class="form-control @error('nama_prodi') is-invalid @enderror" name="nama_prodi" value="{{old('nama_prodi',$prodi->nama_prodi)}}">
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
                @if (old('jurusan_id',$prodi->jurusan_id)==$jurusan->id)
                <option value="{{$jurusan->id}}" selected>{{ $jurusan->nama_jurusan }}</option>
                @else
                <option value="{{ $jurusan->id }}">{{ $jurusan->nama_jurusan }}</option>
                @endif
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
                @if (old('kaprodi',$prodi->kaprodi)==$dosen->id)
                <option value="{{$dosen->id}}" selected>{{ $dosen->user->name }}</option>
                @else
                <option value="{{ $dosen->id }}">{{ $dosen->user->name }}</option>
                @endif
                @endforeach
            </select>
            @error('kaprodi')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary" value="update">submit</button>
    </form>
</div>

@endsection