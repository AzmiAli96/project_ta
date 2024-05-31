@extends('layout.main')
@section('title', 'create Ruangan')
@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h2>Create Ruangan</h2>
</div>
@if (session()->has('pesan'))    
<div class="alert alert-primary" role="alert">
    {{ session('pesan') }}
</div>
@endif
<div class="col-6">
    <form action="/ruangan" method="post">
        @csrf
        <div class="mb-3">
            <label class="form-label">Ruangan</label>
            <input type="text" class="form-control @error('nama_ruangan') is-invalid @enderror" name="nama_ruangan" value="{{old('nama_ruangan')}}">
            @error('nama_ruangan')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">submit</button>
    </form>
</div>

@endsection