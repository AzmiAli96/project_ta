@extends('layout.main')
@section('title', 'Edit User')
@section('scriptpages')
<script src="/js/adduser.js"></script>
@endsection
@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h2>Edit User</h2>
</div>
@if (session()->has('pesan'))    
<div class="alert alert-primary" role="alert">
    {{ session('pesan') }}
</div>
@endif
<div class="col-6">
    <form action="/user/{{ $user->id }}" method="post">
        @method('PUT')
        @csrf
        <div class="mb-3">
            <label class="form-label">Nama</label>
            <input type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username', $user->name) }}">
            @error('username')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email', $user->email) }}">
            @error('email')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Password (Kosongkan jika tidak ingin mengubah)</label>
            <input type="password" class="form-control @error('password') is-invalid @enderror" name="password">
            @error('password')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Level</label>
                <select class="form-select form-control" name="level" id="level">
                    <option selected hidden>Roll anda</option>
                    <option value="Admin" {{ old('level', $user->level) == 'Admin' ? 'selected' : '' }}>Admin</option>
                    <option value="Kaprodi" {{ old('level', $user->level) == 'Kaprodi' ? 'selected' : '' }}>Kaprodi</option>
                    <option value="Dosen" {{ old('level', $user->level) == 'Dosen' ? 'selected' : '' }}>Dosen</option>
                    <option value="Mahasiswa" {{ old('level', $user->level) == 'Mahasiswa' ? 'selected' : '' }}>Mahasiswa</option>
                </select>
            @error('level')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div id="apabila"></div>
                
        <button type="submit" class="btn btn-primary">submit</button>
    </form>
</div>

@endsection
