@extends('layout.main')
@section('title', 'Edit Mahasiswa')
@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h2>Edit Mahasiswa</h2>
</div>
@if (session()->has('pesan'))    
<div class="alert alert-primary" role="alert">
    {{ session('pesan') }}
</div>
@endif
<div class="col-6">
    <form action="/mahasiswa/{{ $mahasiswa->id }}" method="post">
    @method('PUT')    
    @csrf
        <div class="mb-3">
            <label class="form-label">NO_BP</label>
            <input type="number" class="form-control @error('no_bp') is-invalid @enderror" name="no_bp" value="{{old('no_bp')}}" readonly>
            @error('no_bp')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Nama</label>
            <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" value="{{old('nama')}}">
            @error('nama')
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
        <button type="submit" class="btn btn-primary" value="update">submit</button>
    </form>
</div>

@endsection