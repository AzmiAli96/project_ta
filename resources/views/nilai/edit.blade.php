@extends('layout.main')
@section('title', 'Masukkan Nilai')
@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h2>Masukkan Nilai</h2>
</div>
@if (session()->has('pesan'))
<div class="alert alert-primary" role="alert">
    {{ session('pesan') }}
</div>
@endif
<div class="col-6">
    <form action="/nilai/{{ $nilai->id }}" method="post">
        @method('PUT')
        @csrf
        <div class="mb-3">
            <label class="form-label @error('sidang_id') is-invalid @enderror">Mahasiswa Sidang</label>
            <select name="sidang_id" class="form-select" readonly>
                <option value="" hidden>--pilih sidang--</option>
                @foreach ($sidangs as $sidang)
                @if (old('sidang_id',$nilai->sidang_id)==$sidang->id)
                <option value="{{$sidang->id}}" selected>{{ $sidang->nama }}</option>
                @else
                <option value="{{ $sidang->id }}">{{ $sidang->nama }}</option>
                @endif
                @endforeach
            </select>
            @error('sidang_id')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Ketua Sidang</label>
            <input type="number" class="form-control @error('nilai_ketua') is-invalid @enderror" name="nilai_ketua" value="">
            @error('nilai_ketua')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Sekretaris Sidang</label>
            <input type="number" class="form-control @error('nilai_sekr') is-invalid @enderror" name="nilai_sekr" value="">
            @error('nilai_sekr')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Anggota Sidang 1</label>
            <input type="number" class="form-control @error('nilai_ang1') is-invalid @enderror" name="nilai_ang1" value="">
            @error('nilai_ang1')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Anggota Sidang 2</label>
            <input type="number" class="form-control @error('nilai_ang2') is-invalid @enderror" name="nilai_ang2" value="">
            @error('nilai_ang2')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">Nilai Akhir</label>
            <input type="number" class="form-control @error('nilai_ang2') is-invalid @enderror" name="nilai_ang2" value="{{ $nilai_ketua + nilai_sekr + nilai_ang1 + nilai_ang2 / 4 }}" readonly>
            @error('nilai_ang2')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label @error('status') is-invalid @enderror">status</label>
            <select name="status" class="form-select">
                <option value="" hidden>--pilih status--</option>
                @if ({{old('status',$nilai->status)}})
                <option value="1" >Lulus</option>
                <option value="0" >Belum Lulus</option>
                @endif
            </select>
            @error('status')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <input type="hidden" name="level" id="level" value="Mahasiswa">
        <button type="submit" class="btn btn-primary" value="update">submit</button>
    </form>
</div>

@endsection