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
            <input type="number" class="form-control @error('nidn') is-invalid @enderror" name="nidn" value="{{old('nidn',$mahasiswa->nidn)}}" readonly>
            @error('nidn')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Nama</label>
            <input type="text" class="form-control @error('nama') is-invalid @enderror" name="nama" value="{{old('nama',$mahasiswa->nama)}}">
            @error('nama')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{old('email',$mahasiswa->email)}}">
            @error('email')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Password</label>
            <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" value="{{old('password',$mahasiswa->password)}}">
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
            <label class="form-label @error('prodi_id') is-invalid @enderror">Prodi</label>
            <select name="prodi_id" class="form-select">
                <option value="" hidden>--pilih prodi--</option>
                @foreach ($prodis as $prodi)
                @if (old('prodi_id',$mahasiswa->prodi_id)==$prodi->id)
                    <option value="{{$prodi->id}}" selected>{{ $prodi->nama }}</option>
                    @else
                    <option value="{{ $prodi->id }}">{{ $prodi->nama }}</option>
                @endif
                @endforeach
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
        <button type="submit" class="btn btn-primary" value="update">submit</button>
    </form>
</div>

@endsection