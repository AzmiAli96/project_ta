@extends('layout.main')
@section('title', 'Edit Dosen')
@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h2>Edit Dosen</h2>
</div>
@if (session()->has('pesan'))    
<div class="alert alert-primary" role="alert">
    {{ session('pesan') }}
</div>
@endif
<div class="col-6">
    <form action="/dosen/{{ $dosen->id }}" method="post">
    @method('PUT')    
    @csrf
        <div class="mb-3">
            <label class="form-label">NIDN</label>
            <input type="number" class="form-control @error('nidn') is-invalid @enderror" name="nidn" value="{{old('nidn',$dosen->nidn)}}" readonly>
            @error('nidn')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Nama</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{old('name',$dosen->user->name)}}">
            @error('nama')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{old('email',$dosen->user->email)}}">
            @error('email')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Password</label>
            <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" value="{{old('password',$dosen->user->password)}}">
            @error('password')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">No Telp</label>
            <input type="number" class="form-control @error('no_telp') is-invalid @enderror" name="no_telp" value="{{old('no_telp'$dosen->no_telp)}}">
            @error('no_telp')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label @error('sebagai') is-invalid @enderror">Roll</label>
            <select name="sebagai" class="form-select" value="{{ old('sebagai',$dosen->sebagai) }}">
                <option value="" hidden>--Roll anda--</option>
                <option value="Penguji">Penguji</option>
                <option value="Pembimbing">Pembimbing</option>
            </select>
            @error('prodi_id')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Alamat</label>
            <textarea class="form-control @error('alamat') is-invalid @enderror" rows="3" name="alamat">{{old('alamat',$dosen->alamat)}}</textarea>
            @error('alamat')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <input type="hidden" name="level" id="level" value="Dosen">
        <button type="submit" class="btn btn-primary" value="update">submit</button>
    </form>
</div>

@endsection