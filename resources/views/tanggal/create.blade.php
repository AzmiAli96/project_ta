@extends('layout.main')
@section('title', 'create Tanggal')
@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h2>Create Tanggal</h2>
</div>
@if (session()->has('pesan'))    
<div class="alert alert-primary" role="alert">
    {{ session('pesan') }}
</div>
@endif
<div class="col-6">
    <form action="/tanggal" method="post">
        @csrf
        <div class="mb-3">
            <label class="form-label">Tanggal</label>
            <input type="date" class="form-control @error('tanggal') is-invalid @enderror" name="tanggal" value="{{old('tanggal')}}">
            @error('tanggal')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label @error('sesi_id') is-invalid @enderror">sesi</label>
            <select name="sesi_id" class="form-select">
                <option value="" hidden>--pilih Sesi--</option>
                @foreach ($sesis as $sesi)
                <option value="{{$sesi->id}}">{{$sesi->sesi}}</option>
                @endforeach
            </select>
            @error('sesi_id')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label @error('ruangan_id') is-invalid @enderror">Ruangan</label>
            <select name="ruangan_id" class="form-select">
                <option value="" hidden>--pilih Ruangan--</option>
                @foreach ($ruangans as $ruangan)
                <option value="{{$ruangan->id}}">{{$ruangan->nama_ruangan}}</option>
                @endforeach
            </select>
            @error('ruangan_id')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label @error('status') is-invalid @enderror">status</label>
            <select name="status" class="form-select">
                <option value="" hidden>--pilih status--</option>
                <option value="0" >Isi</option>
                <option value="1" >Kosong</option>
            </select>
            @error('status')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">submit</button>
    </form>
</div>

@endsection