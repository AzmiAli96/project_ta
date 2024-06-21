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
            <form action="/nilai/penjumlahan/{{ $penjumlahan->id }}" method="post">
                @csrf
                @method('PUT')
                <div class="col-3">
                    <table>
                        <td>Mahasiswa</td>
                        <td>
                            <input type="text" value="{{$penilai}}" name="penilai">
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
                            <td>Sikap dan Penampilan</td>
                            <td>5 </td>
                            <td>
                                <div class="col-4">
                                    <input type="text" class="form-control @error('n1') is-invalid @enderror" name="n1" value="{{old('n1',optional($penjumlahan)->n1,)?1:10}}" placeholder="00.00">
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
                                    <input type="text" class="form-control @error('n2') is-invalid @enderror" name="n2" value="{{old('n2',optional($penjumlahan)->n2)?1:10}}" placeholder="00.00">
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
                            <td>Penguatan Materi</td>
                            <td>20 </td>
                            <td>
                                <div class="col-4">
                                    <input type="text" class="form-control @error('n3') is-invalid @enderror" name="n3" value="{{old('n3',optional($penjumlahan)->n3)?1:10}}" placeholder="00.00">
                                    @error('n3')
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
                            <td>Identifikasi Masalah, tujuan dan kontribusi penelitian</td>
                            <td>5 </td>
                            <td>
                                <div class="col-4">
                                    <input type="text" class="form-control @error('n4') is-invalid @enderror" name="n4" value="{{old('n4',optional($penjumlahan)->n4)?1:10}}" placeholder="00.00">
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
                            <td>Relevasnsi teori/referensi pustaka dan konsep dengan masalah penelitian</td>
                            <td>5</td>
                            <td>

                                <div class="col-4">
                                    <input type="text" class="form-control @error('n5') is-invalid @enderror" name="n5" value="{{old('n5',optional($penjumlahan)->n5)?1:10}}" placeholder="00.00">
                                    @error('n5')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>Metode / Algoritma yang digunakan</td>
                            <td>10</td>
                            <td>

                                <div class="col-4">
                                    <input type="text" class="form-control @error('n6') is-invalid @enderror" name="n6" value="{{old('n6',optional($penjumlahan)->n6)?1:10}}" placeholder="00.00">
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
                            <td>Hasil dan Pembahasan</td>
                            <td>15</td>
                            <td>
                                <div class="col-4">
                                    <input type="text" class="form-control @error('n7') is-invalid @enderror" name="n7" value="{{old('n7',optional($penjumlahan)->n7)?1:10}}" placeholder="00.00">
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
                            <td>Kesimpulan dan Saran</td>
                            <td>5</td>
                            <td>
                                <div class="col-4">
                                    <input type="text" class="form-control @error('n8') is-invalid @enderror" name="n8" value="{{old('n8',optional($penjumlahan)->n8)?1:10}}" placeholder="00.00">
                                    @error('n8')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>Penggunaan Bahasa dan Tata Tulis</td>
                            <td>5</td>
                            <td>
                                <div class="col-4">
                                    <input type="text" class="form-control @error('n9') is-invalid @enderror" name="n9" value="{{old('n9',optional($penjumlahan)->n9)?1:10}}" placeholder="00.00">
                                    @error('n9')
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
                            <td>Kesesuaian fungsionalitas sistem</td>
                            <td>25</td>
                            <td>
                                <div class="col-4">
                                    <input type="text" class="form-control @error('n10') is-invalid @enderror" name="n10" value="{{old('n10',optional($penjumlahan)->n10)?1:10}}" placeholder="00.00">
                                    @error('n10')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td colspan="2"><b>Total Nilai</b></td>
                            <td>
                                <div class="col-2">
                                    <input type="text" name="total_nilai" value="{{old('total_nilai',optional($penjumlahan)->total_nilai)}}" readonly placeholder="total">
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Revisi</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Lihat isi Laporan"></textarea>
                </div>
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <button type="submit" class="btn btn-success btn-lg" value="submit">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection