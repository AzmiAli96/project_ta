@extends('layout.main')
@section('title', 'Edit Jurusan')
@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h2>Edit Jurusan</h2>
</div>
@if (session()->has('pesan'))
<div class="alert alert-primary" role="alert">
    {{ session('pesan') }}
</div>
@endif
<div class="col-6">
    <form action="/jurusan/{{ $jurusan->id }}" method="post">
        @method('PUT')
        @csrf
        <div class="mb-3">
            <label class="form-label">Kode Jurusan</label>
            <input type="text" class="form-control @error('kode_jurusan') is-invalid @enderror" name="kode_jurusan" value="{{old('kode_jurusan',$jurusan->kode_jurusan)}}" readonly>
            @error('kode_jurusan')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Jurusan</label>
            <input type="text" class="form-control @error('nama_jurusan') is-invalid @enderror" name="nama_jurusan" value="{{old('nama_jurusan',$jurusan->nama_jurusan)}}">
            @error('nama_jurusan')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label @error('kajur') is-invalid @enderror">Ketua Jurusan</label>
            <select name="kajur" class="form-select">
                <option value="" hidden>--pilih ketua jurusan--</option>
                @foreach ($dosens as $dosen)
                @if (old('kajur',$jurusan->kajur)==$dosen->id)
                <option value="{{$dosen->id}}" selected>{{$dosen->user->name}} ({{ $dosen->nidn }})</option>
                @else
                <option value="{{$dosen->id}}">{{$dosen->user->name}} ({{ $dosen->nidn }})</option>
                @endif
                @endforeach
            </select>
            @error('kajur')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label @error('sekjur') is-invalid @enderror">Sekretaris Jurusan</label>
            <select name="sekjur" class="form-select">
                <option value="" hidden>--pilih Sekretaris jurusan--</option>
                @foreach ($dosens as $dosen)
                @if (old('sekjur',$jurusan->sekjur)==$dosen->id)
                <option value="{{$dosen->id}}" selected>{{$dosen->user->name}} ({{ $dosen->nidn }})</option>
                @else
                <option value="{{$dosen->id}}">{{$dosen->user->name}} ({{ $dosen->nidn }})</option>
                @endif
                @endforeach
            </select>
            @error('sekjur')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary" value="update">submit</button>
    </form>
</div>

@endsection