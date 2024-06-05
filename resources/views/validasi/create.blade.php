@extends('layout.main')
@section('title', 'create Validasi')
@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h2>Create Validasi</h2>
</div>
@if (session()->has('pesan'))    
<div class="alert alert-primary" role="alert">
    {{ session('pesan') }}
</div>
@endif
<div class="col-6">
    <form action="/validasi" method="post">
        @csrf
        <div class="mb-3">
            <label class="form-label @error('ta_id') is-invalid @enderror">Tugas Akhir Mahasiswa</label>
            <select name="ta_id" class="form-select">
                <option value="" hidden>--pilih Tugas Akhir Mahasiswa--</option>
                @foreach ($tas as $ta)
                <option value="{{$ta->id}}">{{$ta->nobp}}</option>
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
            <textarea class="form-control @error('komentar') is-invalid @enderror" rows="3" name="komentar">{{old('komentar')}}</textarea>
            @error('komentar')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label @error('status') is-invalid @enderror">status</label>
            <select name="status" class="form-select">
                <option value="" hidden>--pilih status--</option>
                <option value="1" >Lengkap</option>
                <option value="2" >Belum Lengkap</option>
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