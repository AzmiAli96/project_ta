@extends('layout.main')
@section('title', 'Edit Penilaian')
@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h2>Edit Penilaian</h2>
    </div>
    @if (session()->has('pesan'))
        <div class="alert alert-primary" role="alert">
            {{ session('pesan') }}
        </div>
    @endif
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">DataTables nilai</h6>
        </div>
        <div class="card-body">
            {{-- <form action="/nilai/penilai" method="post">
            @method('PUT')
            @csrf  --}}
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Jabatan</th>
                            <th>Nama</th>
                            <th>Total Nilai</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Pembimbing 1</td>
                            <td>{{ $nilai->sidang->validasi->ta->Dpembimbing1->user->name }} </td>
                            <td>nilai</td>
                            <td>
                                <button type="submit" class="btn btn-warning" id="btnDetail" data-id="{{ $nilai->id }}"
                                    data-nilai="{{ $nilai }}" data-jenjang="{{ $jenjang }}"
                                    data-penjumlahan="{{ $penjumlahans }}" data-sidang="{{ $sidangs }}"
                                    data-penilai="pembimbing1">
                                    <i class="fas fa-edit"></i>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Pembimbing 2 </td>
                            <td>{{ $nilai->sidang->validasi->ta->Dpembimbing2->user->name }}</td>
                            <td>nilai</td>
                            <td><a href="/nilai/{{ $nilai->id }}/pembimbing2" class="btn btn-warning"><i
                                        class="fas fa-edit"></i></a></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>Nilai Rata-rata Pembimbing :</td>
                            <td></td>
                            <td>nilai</td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>Ketua</td>
                            <td>{{ $nilai->sidang->validasi->ta->Dpembimbing1->user->name }} /
                                {{ $nilai->sidang->validasi->ta->Dpembimbing2->user->name }} </td>
                            <td>nilai</td>
                            <td><a href="/nilai/{{ $nilai->id }}/Ketua" class="btn btn-warning"><i
                                        class="fas fa-edit"></i></a></td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td>Sekretaris</td>
                            <td>{{ $nilai->sidang->psek_sidang->user->name }} </td>
                            <td>nilai</td>
                            <td><a href="/nilai/{{ $nilai->id }}/edit" class="btn btn-warning"><i
                                        class="fas fa-edit"></i></a></td>
                        </tr>
                        <tr>
                            <td>5</td>
                            <td>Anggota 1</td>
                            <td>{{ $nilai->sidang->panggota1->user->name }} </td>
                            <td>nilai</td>
                            <td><a href="/nilai/{{ $nilai->id }}/edit" class="btn btn-warning"><i
                                        class="fas fa-edit"></i></a></td>
                        </tr>
                        <tr>
                            <td>6</td>
                            <td>Anggota 2</td>
                            <td>{{ $nilai->sidang->panggota2->user->name }} </td>
                            <td>nilai</td>
                            <td><a href="/nilai/{{ $nilai->id }}/edit" class="btn btn-warning"><i
                                        class="fas fa-edit"></i></a></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>Nilai Rata-rata Penguji :</td>
                            <td></td>
                            <td>nilai</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>Nilai Akhir :</td>
                            <td></td>
                            <td>nilai</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>Hasil Akhir :</td>
                            <td></td>
                            <td>nilai</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <!-- <button type="submit" class="btn btn-primary" value="update">Save</button> -->
            <!-- </form> -->
        </div>

        {{-- MODAL --}}
        <div class="modal fade" id="modalEdit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Edidek</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="/penjumlahan/{{ $nilai->id }}" method="post">
                            @csrf
                            <div class="col-3">
                                Nilai ID
                                <input type="text" value="" name="nilai_id" id="nilai_id">
                            </div>
                            <div class="col-3">
                                Nilai dari
                                <input type="text" value="" name="penilai" id="penilai">
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
                                        <td>5</td>
                                        <td>
                                            <div class="col-4">
                                                <input type="text" class="form-control @error('n1') is-invalid @enderror"
                                                    name="n1" id="n1" placeholder="00.00">
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
                                                    name="n2" id="n2" placeholder="00.00">
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
                                        <td>20</td>
                                        <td>
                                            <div class="col-4">
                                                <input type="text" class="form-control @error('n3') is-invalid @enderror"
                                                    name="n3" id="n3" placeholder="00.00">
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
                                        <td>5</td>
                                        <td>
                                            <div class="col-4">
                                                <input type="text" class="form-control @error('n4') is-invalid @enderror"
                                                    name="n4" id="n4" placeholder="00.00">
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
                                        <td>Relevansi teori/referensi pustaka dan konsep dengan masalah penelitian</td>
                                        <td>5</td>
                                        <td>
                                            <div class="col-4">
                                                <input type="text"
                                                    class="form-control @error('n5') is-invalid @enderror" name="n5"
                                                    id="n5" placeholder="00.00">
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
                                                <input type="text"
                                                    class="form-control @error('n6') is-invalid @enderror" name="n6"
                                                    id="n6" placeholder="00.00">
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
                                                <input type="text"
                                                    class="form-control @error('n7') is-invalid @enderror" name="n7"
                                                    id="n7" placeholder="00.00">
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
                                                <input type="text"
                                                    class="form-control @error('n8') is-invalid @enderror" name="n8"
                                                    id="n8" placeholder="00.00">
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
                                                <input type="text"
                                                    class="form-control @error('n9') is-invalid @enderror" name="n9"
                                                    id="n9" placeholder="00.00">
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
                                                <input type="text"
                                                    class="form-control @error('n10') is-invalid @enderror" name="n10"
                                                    id="n10" placeholder="00.00">
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
                                                <input type="text" name="total_nilai" id="total_nilai" value=""
                                                    readonly placeholder="total">
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label">Revisi</label>
                                <textarea class="form-control" id="exampleFormControlTextarea1" name="revisi" rows="3"
                                    placeholder="Lihat isi Laporan"></textarea>
                            </div>
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <button type="submit" class="btn btn-success btn-lg" value="submit">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <script>
            // const modalEdit = document.getElementById('modalEdit');
            // if (modalEdit) {
            //     modalEdit.addEventListener('show.bs.modal', event => {
            //         const button = event.relatedTarget;

            //         // Get the nilai data from the button attribute
            //         const nilaiData = button.getAttribute('data-nilai');
            //         const nilai = JSON.parse(nilaiData); // Parse the JSON string

            //         // Set the modal title
            //         const modalTitle = modalEdit.querySelector('.modal-title');
            //         modalTitle.textContent = `Edit nilai ${nilai.id}`;

            //         // Set the input values
            //         document.getElementById('nilai_id').value = nilai.nilai_id;
            //         document.getElementById('penilai').value = nilai.penilai;
            //         document.getElementById('n1').value = nilai.n1;
            //         document.getElementById('n2').value = nilai.n2;
            //         document.getElementById('n3').value = nilai.n3;
            //         document.getElementById('n4').value = nilai.n4;
            //         document.getElementById('n5').value = nilai.n5;
            //         document.getElementById('n6').value = nilai.n6;
            //         document.getElementById('n7').value = nilai.n7;
            //         document.getElementById('n8').value = nilai.n8;
            //         document.getElementById('n9').value = nilai.n9;
            //         document.getElementById('n10').value = nilai.n10;
            //         document.getElementById('total_nilai').value = nilai.total_nilai;
            //     });
            // }
            </script>


@endsection
@section('scriptpages')
<script>
        $(document).ready(function() {
            $(document).on('click', '#btnDetail', function() {
                // alert($(this).data('id'))
                $.ajax({
                    type: 'GET',
                    url: "/cek-nilai/"+$(this).data("id"),
                    dataType: "json",
                    success: function (response) {
                        console.log(response);
                        const data = response.data[0];
                        $('#modalEdit').modal('show');
                        $('#nilai_id').val(data.nilai_id ?? 0);
                        $('#penilai').val(data.penilai ?? 0);
                        $('#n1').val(data.n1 ?? 0);
                        $('#n1').val(data.n1 ?? 0);
                        $('#n2').val(data.n2 ?? 0);
                        $('#n3').val(data.n3 ?? 0);
                        $('#n4').val(data.n4 ?? 0);
                        $('#n5').val(data.n5 ?? 0);
                        $('#n6').val(data.n6 ?? 0);
                        $('#n7').val(data.n7 ?? 0);
                        $('#n8').val(data.n8 ?? 0);
                        $('#n9').val(data.n9 ?? 0);
                        $('#n10').val(data.n10 ?? 0);
                    },
                    error: function (error){
                        console.log(error);
                    }
                });
            });
        });

    </script>
@endsection