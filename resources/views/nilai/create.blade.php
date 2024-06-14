@extends('layout.main')
@section('title', 'create Nilai')
@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h2>Create Nilai</h2>
</div>
@if (session()->has('pesan'))    
<div class="alert alert-primary" role="alert">
    {{ session('pesan') }}
</div>
@endif
<div class="col-6">
    <form action="/nilai" method="post">
        @csrf
        <div class="mb-3">
            <label class="form-label @error('sidang_id') is-invalid @enderror">Mahasiswa</label>
            <select name="sidang_id" class="form-select">
                <option value="" hidden>--pilih Mahasiswa--</option>
                @foreach ($sidangs as $sidang)
                <option value="{{$sidang->id}}">{{$sidang->validasi->ta->nobp}} / {{ $sidang->validasi->ta->mahasiswa->user->name }}</option>
                @endforeach
            </select>
            @error('sidang_id')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
        <input type="hidden" name="status" value="0">
        <button type="submit" class="btn btn-primary">submit</button>
    </form>
</div>

@endsection