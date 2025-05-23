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
            <select name="ta_id" id="ta_id" class="form-select">
                <option value="" hidden>--pilih Mahasiswa--</option>
                @foreach ($tas as $ta)
                <option value="{{$ta->id}}">{{$ta->mahasiswa->namalengkap}}  -   {{$ta->nobp}}</option>
                @endforeach
            </select>
            @error('ta_id')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>
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
        <input type="hidden" name="status" value="0">
        <button type="submit" class="btn btn-primary">submit</button>
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