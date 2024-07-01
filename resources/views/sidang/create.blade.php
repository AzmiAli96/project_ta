@extends('layout.main')
@section('title', 'create Jadwal Sidang')
@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h2>Create Jadwal Sidang</h2>
</div>
@if (session()->has('pesan'))    
<div class="alert alert-primary" role="alert">
    {{ session('pesan') }}
</div>
@endif
<div class="col-6">
    <form action="/sidang" method="post">
        @csrf
        <div class="mb-3">
            <label class="form-label @error('ta_id') is-invalid @enderror">Mahasiswa TA</label>
            <select name="ta_id" class="form-select">
                <option value="" hidden>--pilih Mahasiswa--</option>
                @foreach ($tas as $ta)
                <option value="{{$ta->id}}">{{$ta->mahasiswa->user->name}}  -   {{$ta->nobp}}</option>
                @endforeach
            </select>
            @error('ta_id')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label @error('tanggal_id') is-invalid @enderror">Tanggal Penjadwalan</label>
            <select name="tanggal_id" class="form-select">
                <option value="" hidden>--pilih Tanggal penjadwalan--</option>
                @foreach ($tanggals as $tanggal)
                <option value="{{$tanggal->id}}">{{$tanggal->tanggal}} / {{$tanggal->sesi->sesi}} / {{$tanggal->ruangan->nama_ruangan}} </option>
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
                <option value="" hidden>--pilih dosen--</option>
                @foreach ($dosens as $dosen)
                <option value="{{$dosen->id}}">{{$dosen->user->name}}</option>
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
                <option value="" hidden>--pilih dosen pembimbing--</option>
                @foreach ($dosens as $dosen)
                <option value="{{$dosen->id}}">{{$dosen->user->name}}</option>
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
                <option value="" hidden>--pilih dosen pembimbing--</option>
                @foreach ($dosens as $dosen)
                <option value="{{$dosen->id}}">{{$dosen->user->name}}</option>
                @endforeach
            </select>
            @error('anggota2')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">submit</button>
    </form>
</div>

@endsection