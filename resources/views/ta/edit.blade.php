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
                <label class="form-label @error('nobp') is-invalid @enderror">sesi</label>
                <select name="nobp" class="form-select" readonly>
                    <option value="" hidden>--pilih sesi--</option>
                    @foreach ($mahasiswas as $mahasiswa)
                        @if (old('nobp', $ta->nobp) == $mahasiswa->nobp)
                            <option value="{{ $mahasiswa->nobp }}" selected>{{ $mahasiswa->nobp }} -
                                {{ $mahasiswa->namalengkap }}</option>
                        @else
                            <option value="{{ $mahasiswa->nobp }}">{{ $mahasiswa->nobp }} - {{ $mahasiswa->namalengkap }}
                            </option>
                        @endif
                    @endforeach
                </select>
                @error('nobp')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Judul</label>
                <input type="text" class="form-control @error('judul') is-invalid @enderror" name="judul"
                    value="{{ old('judul', $ta->judul) }}">
                @error('judul')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="formFileMultiple" class="form-label">File tugas akhir (ZIP)</label>
                <input class="form-control @error('dokumen') is-invalid @enderror" type="file" name="dokumen" value="{{ old('dokumen', $ta->dokumen) }}"
                accept=".zip" id="formFileMultiple" multiple>
                @error('dokumen')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label @error('pembimbing1') is-invalid @enderror">Pembimbing 1</label>
                <select name="pembimbing1" class="form-select">
                    <option value="" hidden>--pilih dosen pembimbing--</option>
                    @foreach ($dosens as $dosen)
                        @if (old('pembimbing1', $ta->pembimbing1) == $dosen->id)
                            <option value="{{ $dosen->id }}" selected>{{ $dosen->user->name }} </option>
                        @else
                            <option value="{{ $dosen->id }}">{{ $dosen->user->name }}</option>
                        @endif
                    @endforeach
                </select>
                @error('pembimbing1')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label @error('pembimbing2') is-invalid @enderror">Pembimbing 2</label>
                <select name="pembimbing2" class="form-select">
                    <option value="" hidden>--pilih dosen pembimbing--</option>
                    @foreach ($dosens as $dosen)
                        @if (old('pembimbing2', $ta->pembimbing2) == $dosen->id)
                            <option value="{{ $dosen->id }}" selected>{{ $dosen->user->name }}</option>
                        @else
                            <option value="{{ $dosen->id }}">{{ $dosen->user->name }}</option>
                        @endif
                    @endforeach
                </select>
                @error('pembimbing2')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            {{-- <div class="mb-3">
                <label class="form-label">Keterangan</label>
                <textarea class="form-control @error('ket') is-invalid @enderror" rows="3" name="ket">{{ old('ket', $ta->ket) }}</textarea>
                @error('ket')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div> --}}
                <div class="mb-3">
                    <label class="form-label">Komentar</label>
                    <textarea class="form-control @error('komentar') is-invalid @enderror" rows="3" name="komentar">{{ old('komentar', $ta->komentar) }}</textarea>
                    @error('komentar')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            {{-- @dd($ta->Dpembimbing1) --}}

            @if ((auth()->user()->level == 'Admin') || ((auth()->user()->level == 'Dosen') && ($ta->Dpembimbing1->user->id == auth()->user()->id)))
                <div class="mb-3">
                    <label class="form-label @error('status_p1') is-invalid @enderror"> Approval</label>
                    <select name="status_p1" class="form-select">
                        <option value="" hidden>--pilih status_p1--</option>
                        <option value="1" {{ old('status_p1', $ta->status_p1) == 1 ? 'selected' : '' }}>ACC</option>
                        <option value="0" {{ old('status_p1', $ta->status_p1) == 0 ? 'selected' : '' }}>Revisi
                        </option>
                    </select>
                    @error('status_p1')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            @endif
            @if ((auth()->user()->level == 'Admin') || ((auth()->user()->level == 'Dosen') && ($ta->Dpembimbing2->user->id == auth()->user()->id)))

                <div class="mb-3">
                    <label class="form-label @error('status_p2') is-invalid @enderror">Approval</label>
                    <select name="status_p2" class="form-select">
                        <option value="" hidden>--pilih status_p2--</option>
                        <option value="1" {{ old('status_p2', $ta->status_p2) == 1 ? 'selected' : '' }}>ACC</option>
                        <option value="0" {{ old('status_p2', $ta->status_p2) == 0 ? 'selected' : '' }}>Revisi
                        </option>
                    </select>
                    @error('status_p2')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            @endif

            @if (in_array(auth()->user()->level, ['Admin','Kaprodi']))
                <div class="mb-3">
                    <label class="form-label @error('status') is-invalid @enderror">Approval</label>
                    <select name="status" class="form-select">
                        <option value="" hidden>--pilih status--</option>
                        <option value="1" {{ old('status', $ta->status) == 1 ? 'selected' : '' }}>ACC</option>
                        <option value="0" {{ old('status', $ta->status) == 0 ? 'selected' : '' }}>Revisi
                        </option>
                    </select>
                    @error('status')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            @endif

            
               
            
            <button type="submit" class="btn btn-primary" value="update">submit</button>
        </form>
    </div>

@endsection
