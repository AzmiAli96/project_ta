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
            <label class="form-label">Prodi</label>
            <input type="text" class="form-control @error('nama') is-invalid @enderror" nama="nama" value="{{old('nama',$prodi->nama)}}">
            @error('nama')
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
                @if (old('jurusan_id',$jurusan->jurusan_id)==$jurusan->id)
                <option value="{{$jurusan->id}}" selected>{{ $jurusan->nama }}</option>
                @else
                <option value="{{ $jurusan->id }}">{{ $jurusan->nama }}</option>
                @endif
                @endforeach
            </select>
            @error('prodi_id')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary" value="update">submit</button>
    </form>
</div>

@endsection