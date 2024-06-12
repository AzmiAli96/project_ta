@extends('layout.main')
@section('title', 'Edit Jadwal Sidang')
@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h2>Edit Jadwal Sidang</h2>
</div>
@if (session()->has('pesan'))
<div class="alert alert-primary" role="alert">
    {{ session('pesan') }}
</div>
@endif
<div class="col-6">
    <form action="/sidang/{{ $sidang->id }}" method="post">
        @method('PUT')
        @csrf
        <div class="mb-3">
            <label class="form-label @error('validasi_id') is-invalid @enderror">Mahasisawa</label>
            <select name="validasi_id" class="form-select">
                <option value="" hidden>--pilih Mahasiswa--</option>
                @foreach ($validasis as $validasi)
                @if (old('validasi_id',$sidang->validasi_id)==$validasi->id)
                <option value="{{$validasi->nobp}}" selected>{{ $validasi->nobp }} {{ $validasi->ta->mahasiswa->user->name }}</option>
                @else
                <option value="{{ $validasi->nobp }}">{{ $validasi->nobp }} {{ $validasi->ta->mahasiswa->user->name }}</option>
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
            <label class="form-label @error('tanggal_id') is-invalid @enderror">Tanggal Pejadwalan</label>
            <select name="tanggal_id" class="form-select" >
                <option value="" hidden>--pilih Tanggal, sesi dan ruang--</option>
                @foreach ($tanggals as $tanggal)
                @if (old('tanggal_id',$sidang->tanggal_id)==$tanggal->id)
                <option value="{{$tanggal->id}}" selected>{{ $tanggal->tanggal }} / {{ $tanggal->sesi->sesi }} / {{ $tanggal->ruangan->nama_ruangan }}</option>
                @else
                <option value="{{ $tanggal->id }}">{{ $tanggal->tanggal }} / {{ $tanggal->sesi->sesi }} / {{ $tanggal->ruangan->nama_ruangan }}s</option>
                @endif
                @endforeach
            </select>
            @error('tanggal_id')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label @error('sekr_sidang') is-invalid @enderror">Sekretaris Sidang</label>
            <select name="sekr_sidang" class="form-select">
                <option value="" hidden>--pilih dosen --</option>
                @foreach ($dosens as $dosen)
                @if (old('sekr_sidang',$sidang->sekr_sidang)==$dosen->id)
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
            <label class="form-label @error('anggota1') is-invalid @enderror">Anggota Sidang 1</label>
            <select name="anggota1" class="form-select">
                <option value="" hidden>--pilih dosen--</option>
                @foreach ($dosens as $dosen)
                @if (old('anggota1',$sidang->anggota1)==$dosen->id)
                <option value="{{$dosen->id}}" selected>{{ $dosen->user->name }}</option>
                @else
                <option value="{{ $dosen->id }}">{{ $dosen->user->name }}</option>
                @endif
                @endforeach
            </select>
            @error('anggota1')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label @error('anggota2') is-invalid @enderror">Anggota Sidang 2</label>
            <select name="anggota2" class="form-select">
                <option value="" hidden>--pilih dosen--</option>
                @foreach ($dosens as $dosen)
                @if (old('anggota2',$sidang->anggota2)==$dosen->id)
                <option value="{{$dosen->id}}" selected>{{ $dosen->user->name }}</option>
                @else
                <option value="{{ $dosen->id }}">{{ $dosen->user->name }}</option>
                @endif
                @endforeach
            </select>
            @error('anggota2')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary" value="update">submit</button>
    </form>
</div>

@endsection