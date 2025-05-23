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
            <input type="number" class="form-control @error('nobp') is-invalid @enderror" id="nobp" name="nobp" value="{{old('nobp',$mahasiswa->nobp)}}" readonly>
            @error('nobp')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Nama</label>
            <input type="text" class="form-control @error('namalengkap') is-invalid @enderror" id="namalengkap" name="namalengkap" value="{{old('namalengkap',$mahasiswa->namalengkap)}}">
            @error('namalengkap')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        {{-- <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{old('email',$mahasiswa->user->email)}}">
            @error('email')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Password</label>
            <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" value="{{old('password',$mahasiswa->user->password)}}">
            @error('password')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div> --}}
        <div class="mb-3">
            <label class="form-label @error('jurusan_id') is-invalid @enderror">Jurusan</label>
            <select name="jurusan_id" id="jurusan_id" class="form-select">
                <option value="" hidden>--pilih jurusan--</option>
                @foreach ($jurusans as $jurusan)
                @if (old('jurusan_id',$mahasiswa->jurusan_id)==$jurusan->id)
                <option value="{{$jurusan->id}}" selected>{{ $jurusan->nama_jurusan }}</option>
                @else
                <option value="{{ $jurusan->id }}">{{ $jurusan->nama_jurusan }}</option>
                @endif
                <!-- cara menampilkan nama di select versi bagaz -->
                <!-- {{ $jurusan->id == $mahasiswa->jurusan_id ? 'selected':'' }} -->
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
            <select name="prodi_id" id="prodi_id" class="form-select">
                <option value="" hidden>--pilih prodi--</option>
                @foreach ($prodis as $prodi)
                @if (old('prodi_id',$mahasiswa->prodi_id)==$prodi->id)
                <option value="{{$prodi->id}}" selected>{{ $prodi->nama_prodi }}</option>
                @else
                <option value="{{ $prodi->id }}">{{ $prodi->nama_prodi }}</option>
                @endif
                @endforeach
            </select>
            @error('prodi_id')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="col-2 mb-3">
            <label class="form-label">IPS</label>
            <input type="text" class="form-control @error('ips') is-invalid @enderror" id="ips" name="ips" value="{{old('ips',$mahasiswa->ips)}}">
            @error('ips')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <input type="hidden" name="level" id="level" value="Mahasiswa">
        <button type="submit" id="update" class="btn btn-primary" value="update">submit</button>
    </form>
</div>

@endsection