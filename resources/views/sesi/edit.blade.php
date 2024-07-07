@extends('layout.main')
@section('title', 'Edit Sesi')
@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h2>Edit Sesi</h2>
</div>
@if (session()->has('pesan'))
<div class="alert alert-primary" role="alert">
    {{ session('pesan') }}
</div>
@endif
<div class="col-6">
    <form action="/sesi/{{ $sesi->id }}" method="post">
        @method('PUT')
        @csrf
        <div class="mb-3">
            <label class="form-label">Sesi</label>
            <input type="text" class="form-control @error('sesi') is-invalid @enderror" name="sesi" value="{{old('sesi',$sesi->sesi)}}">
            @error('sesi')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Waktu</label>
            <input type="text" class="form-control @error('waktu') is-invalid @enderror" name="waktu" value="{{old('waktu',$sesi->waktu)}}">
            @error('waktu')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary" value="update">submit</button>
    </form>
</div>

@endsection