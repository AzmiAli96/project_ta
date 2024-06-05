@extends('layout.main')
@section('title', 'Edit Tanggal')
@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h2>Edit Tanggal</h2>
</div>
@if (session()->has('pesan'))
<div class="alert alert-primary" role="alert">
    {{ session('pesan') }}
</div>
@endif
<div class="col-6">
    <form action="/tanggal/{{ $tanggal->id }}" method="post">
        @method('PUT')
        @csrf
        <div class="mb-3">
            <label class="form-label @error('ta_id') is-invalid @enderror">Tugas Akhir Mahasiswa</label>
            <select name="ta_id" class="form-select">
                <option value="" hidden>--pilih Tugas Akhir Mahasiswa--</option>
                @foreach ($tas as $ta)
                @if (old('ta_id',$ta->ta_id)==$ta->id)
                <option value="{{$ta->id}}" selected>{{$ta->ta}}</option>
                @else
                <option value="{{$ta->id}}">{{$ta->ta}}</option>
                @endif
                @endforeach
            </select>
            @error('ta_id')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Komentar</label>
            <textarea class="form-control @error('komentar') is-invalid @enderror" rows="3" name="komentar">{{old('komentar'$validasi->komentar)}}</textarea>
            @error('komentar')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label @error('ruangan') is-invalid @enderror">Ruangan</label>
            <select name="ruangan" class="form-select">
                <option value="" hidden>--pilih Ruangan--</option>
                @foreach ($ruangans as $ruangan)
                @if (old('ruangan',$ruangan->ruangan)==$ruangan->id)
                <option value="{{$ruangan->id}}" selected>{{ $ruangan->nama_ruangan }}</option>
                @else
                <option value="{{ $ruangan->id }}">{{ $ruangan->nama_ruangan }}</option>
                @endif
                @endforeach
            </select>
            @error('ruangan')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary" value="update">submit</button>
    </form>
</div>

@endsection