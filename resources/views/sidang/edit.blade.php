@extends('layout.main')
@section('title', 'Edit Tugas Akhir')
@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h2>Edit Tugas Akhir</h2>
</div>
@if (session()->has('pesan'))
<div class="alert alert-primary" role="alert">
    {{ session('pesan') }}
</div>
@endif
<div class="col-6">
    <form action="/ta/{{ $ta->id }}" method="post">
        @method('PUT')
        @csrf
        <div class="mb-3">
            <label class="form-label @error('validasi_id') is-invalid @enderror">sesi</label>
            <select name="validasi_id" class="form-select">
                <option value="" hidden>--pilih sesi--</option>
                @foreach ($validasis as $validasi)
                @if (old('nobp',$validasi->nobp)==$validasi->nobp)
                <option value="{{$validasi->nobp}}" selected>{{ $validasi->nobp }} {{ $validasi->user->name }}</option>
                @else
                <option value="{{ $validasi->nobp }}">{{ $validasi->nobp }} {{ $validasi->nama }}</option>
                @endif
                @endforeach
            </select>
            @error('validasi_id')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label @error('sekr_sidang') is-invalid @enderror">Sejretaris Sidang</label>
            <select name="sekr_sidang" class="form-select">
                <option value="" hidden>--pilih dosen --</option>
                @foreach ($dosens as $dosen)
                @if (old('dosen',$dosen->dosen)==$dosen->id)
                <option value="{{$dosen->id}}" selected>{{ $dosen->user->name }}</option>
                @else
                <option value="{{ $dosen->id }}">{{ $dosen->user->name }}</option>
                @endif
                @endforeach
            </select>
            @error('sekr_sidang')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label @error('anggota_sidang') is-invalid @enderror">Anggota Sidang</label>
            <select name="anggota_sidang" class="form-select">
                <option value="" hidden>--pilih dosen--</option>
                @foreach ($dosens as $dosen)
                @if (old('dosen',$dosen->dosen)==$dosen->id)
                <option value="{{$dosen->id}}" selected>{{ $dosen->user->name }}</option>
                @else
                <option value="{{ $dosen->id }}">{{ $dosen->user->name }}</option>
                @endif
                @endforeach
            </select>
            @error('anggota_sidang')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary" value="update">submit</button>
    </form>
</div>

@endsection