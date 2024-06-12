@extends('layout.main')
@section('title', 'create Tugas Akhir')
@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h2>Create Tugas Akhir</h2>
</div>
@if (session()->has('pesan'))    
<div class="alert alert-primary" role="alert">
    {{ session('pesan') }}
</div>
@endif
<div class="col-6">
    <form action="/ta" method="post">
        @csrf
        <div class="mb-3">
            <label class="form-label @error('nobp') is-invalid @enderror">NoBP</label>
            <select name="nobp" class="form-select">
                <option value="" hidden>--pilih Mahasiswa--</option>
                @foreach ($mahasiswas as $mahasiswa)
                <option value="{{$mahasiswa->nobp}}">{{$mahasiswa->nobp}}  -   {{$mahasiswa->nama}}</option>
                @endforeach
            </select>
            @error('sesi_id')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Judul</label>
            <input type="text" class="form-control @error('judul') is-invalid @enderror" name="judul" value="{{old('judul')}}">
            @error('judul')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="formFileMultiple" class="form-label">file tugas akhir</label>
            <input class="form-control" type="file" name="dokumen" value="{{ old('dokumen') }}" id="formFileMultiple" multiple>
            @error('dokumen')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label @error('pembimbing1') is-invalid @enderror">Pembimbing 1</label>
            <select name="pembimbing1" class="form-select">
                <option value="" hidden>--pilih dosen pembimbing--</option>
                @foreach ($dosens as $dosen)
                <option value="{{$dosen->id}}">{{$dosen->user->name}}</option>
                @endforeach
            </select>
            @error('pembimbing1')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label @error('pembimbing2') is-invalid @enderror">Pembimbing 2</label>
            <select name="pembimbing2" class="form-select">
                <option value="" hidden>--pilih dosen pembimbing--</option>
                @foreach ($dosens as $dosen)
                <option value="{{$dosen->id}}">{{$dosen->user->name}}</option>
                @endforeach
            </select>
            @error('pembimbing2')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">submit</button>
    </form>
</div>

@endsection