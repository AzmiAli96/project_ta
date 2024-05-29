@extends('layout.main')
@section('title', 'create Mahasiswa')
@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h2>Create Mahasiswa</h2>
</div>
@if (session()->has('pesan'))    
<div class="alert alert-primary" role="alert">
    {{ session('pesan') }}
</div>
@endif
<div class="col-6">
    <form action="/mahasiswa" method="post">
        @csrf
        <div class="mb-3">
            <label class="form-label">NO BP</label>
            <input type="number" class="form-control @error('nobp') is-invalid @enderror" name="nobp" value="{{old('nobp')}}">
            @error('nobp')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Nama</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{old('name')}}">
            @error('name')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{old('email')}}">
            @error('email')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Password</label>
            <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" value="{{old('password')}}">
            @error('password')
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
                <option value="{{$jurusan->id}}">{{$jurusan->nama}}</option>
                @endforeach
            </select>
            @error('jurusan_id')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label @error('prodi_id') is-invalid @enderror">Prodi</label>
            <select name="prodi_id" class="form-select">
                <option value="" hidden>--pilih prodi--</option>
                @foreach ($prodis as $prodi)
                <option value="{{$prodi->id}}">{{$prodi->nama}}</option>
                @endforeach
            </select>
            @error('prodi_id')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Judul</label>
            <input type="text" class="form-control" name="judul" value="{{old('judul')}}">
            @error('judul')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="formFile" class="form-label">file tugas akhir</label>
            <input class="form-control" type="file" name="dokumen" value="{{ old('judul') }}" id="formFile">
            @error('dokumen')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label @error('status_id') is-invalid @enderror">Prodi</label>
            <select name="status_id" class="form-select">
                <option value="" hidden>-- status --</option>
                @foreach ($statuses as $status)
                <option value="{{$status->id}}">{{$status->ket}}</option>
                @endforeach
            </select>
            @error('status_id')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <input type="hidden" name="level" id="level" value="Mahasiswa">
        <button type="submit" class="btn btn-primary">submit</button>
    </form>
</div>

@endsection