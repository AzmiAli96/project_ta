@extends('layout.main')
@section('title', 'Penilaian')
@section('content')

    <!-- <p class="mb-4">Semua </p> -->
    @if (session()->has('pesan'))
        <div class="alert alert-primary" role="alert">
            {{ session('pesan') }}
        </div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">DataTables Penilaian</h6>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <form action="/berinilai/{{ $nilai->id }}/edit" method="post">
                    @csrf
                    @method('PUT')
                    <div class="col-3">
                        <table>
                            <td>Mahasiswa</td>
                            <td>
                                <input type="text" value="{{ $nilai->sidang_id }}" name="sidang_id">
                            </td>
                            <td>Penilai</td>
                            <td>
                                <input type="text" value="{{ $nilai->penilai }}" name="penilai">
                            </td>
                        </table>
                    </div>
                    <table class="table table-bordered" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Materi Penilaian</th>
                                <th>Bobot(%)</th>
                                <th>Skor</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td colspan="3">PRESENTASI</td>

                            </tr>
                            <tr>
                                <td></td>
                                <td>Etika dan penampilan</td>
                                <td>5 </td>
                                <td>
                                    <div class="col-4">
                                        <input type="text" class="form-control @error('n1') is-invalid @enderror"
                                            name="n1" value="{{ old('n1') }}" placeholder="00.00">
                                        @error('n1')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>Komunikasi dan Sistematika</td>
                                <td>5</td>
                                <td>
                                    <div class="col-4">
                                        <input type="text" class="form-control @error('n2') is-invalid @enderror"
                                            name="n2" value="{{ old('n2') }}" placeholder="00.00">
                                        @error('n2')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>Penguatan materi Pengetahuan dasar</td>
                                <td>10 </td>
                                <td>
                                    <div class="col-4">
                                        <input type="text" class="form-control @error('n3') is-invalid @enderror"
                                            name="n3" value="{{ old('n3') }}" placeholder="00.00">
                                        @error('n3')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>Penguatan materi Pemahaman</td>
                                <td>10 </td>
                                <td>
                                    <div class="col-4">
                                        <input type="text" class="form-control @error('n4') is-invalid @enderror"
                                            name="n4" value="{{ old('n4') }}" placeholder="00.00">
                                        @error('n4')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>Penguatan materi Kemampuan Terapan</td>
                                <td>20 </td>
                                <td>
                                    <div class="col-4">
                                        <input type="text" class="form-control @error('n5') is-invalid @enderror"
                                            name="n5" value="{{ old('n5') }}" placeholder="00.00">
                                        @error('n5')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td colspan="3">MAKALAH</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>Bahasa dan Tata Tulis</td>
                                <td>5 </td>
                                <td>
                                    <div class="col-4">
                                        <input type="text" class="form-control @error('n6') is-invalid @enderror"
                                            name="n6" value="{{ old('n6') }}" placeholder="00.00">
                                        @error('n6')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>penerapan Siklus Pengembangan Sistem</td>
                                <td>15</td>
                                <td>
                                    <div class="col-4">
                                        <input type="text" class="form-control @error('n7') is-invalid @enderror"
                                            name="n7" value="{{ old('n7') }}" placeholder="00.00">
                                        @error('n7')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>Kesesuaian Hasil dengan Kebutuhan Sistem</td>
                                <td>15</td>
                                <td>
                                    <div class="col-4">
                                        <input type="text" class="form-control @error('n8') is-invalid @enderror"
                                            name="n8" value="{{ old('n8') }}" placeholder="00.00">
                                        @error('n8')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td colspan="3">Produk</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>Program/Sistem</td>
                                <td>15</td>
                                <td>
                                    <div class="col-4">
                                        <input type="text" class="form-control @error('n9') is-invalid @enderror"
                                            name="n9" value="{{ old('n9') }}" placeholder="00.00">
                                        @error('n9')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    {{-- <div class="mb-3">
                        <label for="exampleFormControlTextarea1" class="form-label">Revisi</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Lihat isi Laporan"></textarea>
                    </div> --}}
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <button type="submit" class="btn btn-success btn-lg" value="submit">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
