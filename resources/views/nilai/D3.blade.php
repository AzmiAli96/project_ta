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

        <div class="d-grid gap-2 d-md-flex justify-content-md-end mb-3">
            <!-- Topbar Search -->
            <form action="/nilai" method="GET" class="d-none d-sm-inline-block form-inline mr-auto md-3 my-2 my-md-0 mw-100 navbar-search">
                @csrf
                <div class="input-group">
                    <input type="text" name="search" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="submit">
                            <i class="fas fa-search fa-sm"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
        <div class="table-responsive">
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
                            <div class="col-2">
                                <input type="text">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>Komunikasi dan Sistematika</td>
                        <td>5</td>
                        <td>
                            <div class="col-2">
                                <input type="text">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>Penguatan materi Pengetahuan dasar</td>
                        <td>10 </td>
                        <td>
                            <div class="col-2">
                                <input type="text">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>Penguatan materi Pemahaman</td>
                        <td>10 </td>
                        <td>
                            <div class="col-2">
                                <input type="text">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>Penguatan materi Kemampuan Terapan</td>
                        <td>20 </td>
                        <td>
                            <div class="col-2">
                                <input type="text">
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
                            <div class="col-2">
                                <input type="text">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>penerapan Siklus Pengembangan Sistem</td>
                        <td>15</td>
                        <td>
                            <div class="col-2">
                                <input type="text">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>Kesesuaian Hasil dengan Kebutuhan Sistem</td>
                        <td>15</td>
                        <td>
                            <div class="col-2">
                                <input type="text">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>Kesesuaian Hasil dengan Kebutuhan Sistem</td>
                        <td>15</td>
                        <td>
                            <div class="col-2">
                                <input type="text">
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
                            <div class="col-2">
                                <input type="text">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td colspan="2"><b>Total</b></td>
                        <td>
                            <div class="col-2">
                                <input type="text">
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
            <button type="submit" class="btn btn-success btn-lg" value="submit">Submit</button>
            </div>
        </div>
    </div>
</div>

@endsection