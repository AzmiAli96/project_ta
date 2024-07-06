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
            <label class="form-label @error('ta_id') is-invalid @enderror">Mahasisawa</label>
            <select name="ta_id" id="ta_id" class="form-select">
                <option value="" hidden>--pilih Mahasiswa--</option>
                @foreach ($tas as $ta)
                @if (old('ta_id',$sidang->ta_id)==$ta->id)
                <option value="{{$ta->nobp}}" selected>{{ $ta->nobp }} {{ $ta->mahasiswa->namalengkap }}</option>
                @else
                <option value="{{ $ta->nobp }}">{{ $ta->nobp }} {{ $ta->mahasiswa->namalengkap }}</option>
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
            <label class="form-label @error('ketua_sidang') is-invalid @enderror">Ketua Sidang</label>
            <select name="ketua_sidang" id="ketua_sidang" class="form-select">
                <option value="" hidden>--pilih dosen--</option>
            </select>
            @error('ketua_sidang')
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
        <input type="hidden" name="status" value="0">
        <button type="submit" class="btn btn-primary" value="update">submit</button>
    </form>
</div>

<script>
    document.getElementById('ta_id').addEventListener('change', function() {
        var taId = this.value;
        var ketuaSidangSelect = document.getElementById('ketua_sidang');

        // Clear previous options
        ketuaSidangSelect.innerHTML = '<option value="" hidden>--pilih dosen--</option>';

        if (taId) {
            fetch('/get-dosen/' + taId)
                .then(response => response.json())
                .then(data => {
                    if (data.length > 0) {
                        data.forEach(dosen => {
                            console.log(dosen);
                            var option = document.createElement('option');
                            option.value = dosen.id;
                            option.text = dosen.name;
                            ketuaSidangSelect.appendChild(option);
                        });
                    } else {
                        var option = document.createElement('option');
                        option.value = "";
                        option.text = "Tidak ada dosen yang tersedia";
                        ketuaSidangSelect.appendChild(option);
                    }
                })
                .catch(error => console.error('Error fetching dosen:', error));
        }
    });
</script>

@endsection