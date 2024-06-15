@extends('layout.main')
@section('title', 'create User')
@section('scriptpages')
<script src="/js/adduser.js"></script>
@endsection
@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h2>Create User</h2>
</div>
@if (session()->has('pesan'))    
<div class="alert alert-primary" role="alert">
    {{ session('pesan') }}
</div>
@endif
<div class="col-6">
    <form action="/user" method="post">
        @csrf
        <div class="mb-3">
            <label class="form-label">Nama</label>
            <input type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{old('username')}}">
            @error('username')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <input type="hidden" name="lastname" value="">
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
            <label class="form-label">Level</label>
                <select class="form-select form-control" name="level" id="level">
                    <option selected hidden>Roll anda</option>
                    <option value="Admin" hidden>Admin</option>
                    <option value="Kaprodi">Kaprodi</option>
                    <option value="Dosen">Dosen</option>
                    <option value="Mahasiswa">Mahasiswa</option>
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