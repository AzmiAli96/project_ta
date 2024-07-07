@extends('layout.main')
@section('title', 'Dashboard')
@section('content')


    <div class="text-bg-warning p-3 rounded mb-3">
        <h1>Selamat Datang, {{ Auth::user()->name }}</h1>
        <p>Hai, {{ Auth::user()->name }} web ini adalah sebuah sistem informasi yang dirancang untuk memudahkan pelaksanaan
            penjadwalan sidang tugas akhir, memastikan proses berjalan dengan efisien dan terorganisir.
        </p>
    </div>


    @if (auth()->user()->level == 'Admin' || auth()->user()->level == 'Kaprodi')
        <div class="row">
            <div class="col mb-4">
                <div class="card card-raised border-start border-primary border-4" style="width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title">user</h5>
                        <hr>
                        <h6 class="card-subtitle mb-2 text-body-secondary"> {{ App\Models\User::count() }} user</h6>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the
                            card's content.</p>
                    </div>
                </div>
            </div>
            <div class="col mb-2">
                <div class="card card-raised border-start border-secondary border-4" style="width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title">Tugas Akhir</h5>
                        <hr>
                        <h6 class="card-subtitle mb-2 text-body-secondary">{{ App\Models\TA::count() }} user</h6>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the
                            card's content.</p>
                    </div>
                </div>
            </div>
            <div class="col mb-2">
                <div class="card card-raised border-start border-warning border-4" style="width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title">Jadwal Sidang</h5>
                        <hr>
                        <h6 class="card-subtitle mb-2 text-body-secondary">{{ App\Models\Sidang::count() }} user</h6>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the
                            card's content.</p>
                    </div>
                </div>
            </div>
            <div class="col mb-2">
                <div class="card card-raised border-start border-success border-4" style="width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title">Sidang Finish</h5>
                        <hr>
                        <h6 class="card-subtitle mb-2 text-body-secondary">1234 user</h6>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the
                            card's content.</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- bar char --}}
    @endif



    @if (auth()->user()->level == 'Mahasiswa')
        <div class="row ml-2 col-6 mb-3">
            <div class="p-2 bg-success bg-gradient ">
                <h4>Tahap-tahap Pelaksanaan sidang akhir</h4>
            </div>
            <div class="bg-success p-2 text-dark bg-opacity-25">
                <p>Tahap 1 : Pendaftaran Sidang Tugas Akhir <a href="/ta/create"><b>(Pengumpulan)</b></a></p>
                <p>Tahap 2 : Penungguan verifikasi oleh Kaprodi</p>
                <p>Tahap 3 : Pemasukkan jadwal sidang TA</p>
                <p>Tahap 4 : Pelaksanaan Sidang TA</p>
                <p>Tahap 5 : Penilaian oleh penguji sidang TA</p>
            </div>
        </div>
    @endif

    @if (auth()->user()->level == 'Dosen')
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Jadwal sidang mahasiswa yang anda sidang sebagau penguji</h6>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Mahasiswa</th>
                                <th>Prodi</th>
                                <th>Ketua Sidang</th>
                                <th>Sekretaris Sidang</th>
                                <th>Anggota Sidang</th>
                                {{-- <th>Action</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sidangs as $sidang)
                                @php
                                    $showRow = false;

                                    // Check if the logged in user's name is in any of these roles
                                    if (
                                        $sidang->ta->Dpembimbing1->user->name === auth()->user()->name ||
                                        $sidang->ta->Dpembimbing2->user->name === auth()->user()->name ||
                                        $sidang->psek_sidang->user->name === auth()->user()->name ||
                                        $sidang->panggota1->user->name === auth()->user()->name ||
                                        $sidang->panggota2->user->name === auth()->user()->name
                                    ) {
                                        $showRow = true;
                                    }
                                @endphp

                                @if ($showRow)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $sidang->ta->nobp }} /
                                            {{ $sidang->ta->mahasiswa->namalengkap }}</td>
                                        <td>{{ $sidang->ta->mahasiswa->prodi->jenjang }} -
                                            {{ $sidang->ta->mahasiswa->prodi->kode_prodi }}</td>
                                        <td>{{ $sidang->ta->Dpembimbing1->user->name }} /
                                            {{ $sidang->ta->Dpembimbing2->user->name }}</td>
                                        <td>{{ $sidang->psek_sidang->user->name }}</td>
                                        <td>{{ $sidang->panggota1->user->name }} / {{ $sidang->panggota2->user->name }}
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                    {{ $sidangs->links() }}
                </div>
            </div>
        </div>
    @endif
    @if ((auth()->user()->level == 'Admin') | (auth()->user()->level == 'Kaprodi'))
        <div class="row">
            <div class="col-xl-8 col-lg-7">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Bar Chart</h6>
                    </div>
                    <div class="card-body">
                        <div class="chart-bar">
                            <canvas id="myBarChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            {{-- donut bar --}}
            <div class="col-xl-4 col-lg-5">
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Donut Chart</h6>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body">
                        <div class="chart-pie pt-4">
                            <canvas id="myPieChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @if (auth()->user()->level == 'Mahasiswa')
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Nilai Anda</h6>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Prodi</th>
                                <th>Nilai Akhir</th>
                                <th>Status</th>
                                {{-- <th>Action</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sidangs as $sidang)
                                @php
                                    $showRow = false;

                                    // Check if the logged in user's name is in any of these roles
                                    if ($sidang->ta->nobp === auth()->user()->name) {
                                        $showRow = true;
                                    }
                                @endphp

                                @if ($showRow)
                                    <tr>
                                        <td>{{ $sidang->ta->nobp }} /
                                            {{ $sidang->ta->mahasiswa->namalengkap }}</td>
                                        <td>{{ $sidang->ta->mahasiswa->prodi->jenjang }} -
                                            {{ $sidang->ta->mahasiswa->prodi->kode_prodi }}</td>
                                        @php
                                            $total_nilai_pembimbing1 = 0;
                                            $jumlah_penilai_pembimbing1 = $sidang->nilaiPembimbing1->count();
                                            $total_nilai_pembimbing2 = 0;
                                            $jumlah_penilai_pembimbing2 = $sidang->nilaiPembimbing2->count();
                                            $total_nilai_ketua = 0;
                                            $jumlah_penilai_ketua = $sidang->nilaiketua->count();
                                            $total_nilai_sekretaris = 0;
                                            $jumlah_penilai_sekretaris = $sidang->nilaisekretaris->count();
                                            $total_nilai_anggota1 = 0;
                                            $jumlah_penilai_anggota1 = $sidang->nilaianggota1->count();
                                            $total_nilai_anggota2 = 0;
                                            $jumlah_penilai_anggota2 = $sidang->nilaianggota2->count();
                                            $jenjang = $sidang->ta->mahasiswa->prodi->jenjang;

                                            if ($jenjang === 'D4') {
                                                if ($jumlah_penilai_pembimbing1 > 0) {
                                                    foreach ($sidang->nilaiPembimbing1 as $value) {
                                                        $total_nilai_pembimbing1 +=
                                                            $value->n1 * 0.05 +
                                                            $value->n2 * 0.05 +
                                                            $value->n3 * 0.2 +
                                                            $value->n4 * 0.05 +
                                                            $value->n5 * 0.05 +
                                                            $value->n6 * 0.1 +
                                                            $value->n7 * 0.15 +
                                                            $value->n8 * 0.05 +
                                                            $value->n9 * 0.05 +
                                                            $value->n10 * 0.25;
                                                    }
                                                    $nilai_pembimbing1 =
                                                        $total_nilai_pembimbing1 / $jumlah_penilai_pembimbing1;
                                                } else {
                                                    $nilai_pembimbing1 = 0;
                                                }

                                                if ($jumlah_penilai_pembimbing2 > 0) {
                                                    foreach ($sidang->nilaiPembimbing2 as $value) {
                                                        $total_nilai_pembimbing2 +=
                                                            $value->n1 * 0.05 +
                                                            $value->n2 * 0.05 +
                                                            $value->n3 * 0.2 +
                                                            $value->n4 * 0.05 +
                                                            $value->n5 * 0.05 +
                                                            $value->n6 * 0.1 +
                                                            $value->n7 * 0.15 +
                                                            $value->n8 * 0.05 +
                                                            $value->n9 * 0.05 +
                                                            $value->n10 * 0.25;
                                                    }
                                                    $nilai_pembimbing2 =
                                                        $total_nilai_pembimbing2 / $jumlah_penilai_pembimbing2;
                                                } else {
                                                    $nilai_pembimbing2 = 0;
                                                }
                                                if ($jumlah_penilai_ketua > 0) {
                                                    foreach ($sidang->nilaiketua as $value) {
                                                        $total_nilai_ketua +=
                                                            $value->n1 * 0.05 +
                                                            $value->n2 * 0.05 +
                                                            $value->n3 * 0.2 +
                                                            $value->n4 * 0.05 +
                                                            $value->n5 * 0.05 +
                                                            $value->n6 * 0.1 +
                                                            $value->n7 * 0.15 +
                                                            $value->n8 * 0.05 +
                                                            $value->n9 * 0.05 +
                                                            $value->n10 * 0.25;
                                                    }
                                                    $nilai_ketua = $total_nilai_ketua / $jumlah_penilai_ketua;
                                                } else {
                                                    $nilai_ketua = 0;
                                                }
                                                if ($jumlah_penilai_sekretaris > 0) {
                                                    foreach ($sidang->nilaisekretaris as $value) {
                                                        $total_nilai_sekretaris +=
                                                            $value->n1 * 0.05 +
                                                            $value->n2 * 0.05 +
                                                            $value->n3 * 0.2 +
                                                            $value->n4 * 0.05 +
                                                            $value->n5 * 0.05 +
                                                            $value->n6 * 0.1 +
                                                            $value->n7 * 0.15 +
                                                            $value->n8 * 0.05 +
                                                            $value->n9 * 0.05 +
                                                            $value->n10 * 0.25;
                                                    }
                                                    $nilai_sekretaris =
                                                        $total_nilai_sekretaris / $jumlah_penilai_sekretaris;
                                                } else {
                                                    $nilai_sekretaris = 0;
                                                }
                                                if ($jumlah_penilai_anggota1 > 0) {
                                                    foreach ($sidang->nilaianggota1 as $value) {
                                                        $total_nilai_anggota1 +=
                                                            $value->n1 * 0.05 +
                                                            $value->n2 * 0.05 +
                                                            $value->n3 * 0.2 +
                                                            $value->n4 * 0.05 +
                                                            $value->n5 * 0.05 +
                                                            $value->n6 * 0.1 +
                                                            $value->n7 * 0.15 +
                                                            $value->n8 * 0.05 +
                                                            $value->n9 * 0.05 +
                                                            $value->n10 * 0.25;
                                                    }
                                                    $nilai_anggota1 = $total_nilai_anggota1 / $jumlah_penilai_anggota1;
                                                } else {
                                                    $nilai_anggota1 = 0;
                                                }
                                                if ($jumlah_penilai_anggota2 > 0) {
                                                    foreach ($sidang->nilaianggota2 as $value) {
                                                        $total_nilai_anggota2 +=
                                                            $value->n1 * 0.05 +
                                                            $value->n2 * 0.05 +
                                                            $value->n3 * 0.2 +
                                                            $value->n4 * 0.05 +
                                                            $value->n5 * 0.05 +
                                                            $value->n6 * 0.1 +
                                                            $value->n7 * 0.15 +
                                                            $value->n8 * 0.05 +
                                                            $value->n9 * 0.05 +
                                                            $value->n10 * 0.25;
                                                    }
                                                    $nilai_anggota2 = $total_nilai_anggota2 / $jumlah_penilai_anggota2;
                                                } else {
                                                    $nilai_anggota2 = 0;
                                                }
                                            } else {
                                                if ($jumlah_penilai_pembimbing1 > 0) {
                                                    foreach ($sidang->nilaiPembimbing1 as $value) {
                                                        $total_nilai_pembimbing1 +=
                                                            $value->n1 * 0.05 +
                                                            $value->n2 * 0.05 +
                                                            $value->n3 * 0.1 +
                                                            $value->n4 * 0.1 +
                                                            $value->n5 * 0.2 +
                                                            $value->n6 * 0.05 +
                                                            $value->n7 * 0.15 +
                                                            $value->n8 * 0.15 +
                                                            $value->n9 * 0.15;
                                                    }
                                                    $nilai_pembimbing1 =
                                                        $total_nilai_pembimbing1 / $jumlah_penilai_pembimbing1;
                                                } else {
                                                    $nilai_pembimbing1 = 0;
                                                }

                                                if ($jumlah_penilai_pembimbing2 > 0) {
                                                    foreach ($sidang->nilaiPembimbing2 as $value) {
                                                        $total_nilai_pembimbing2 +=
                                                            $value->n1 * 0.05 +
                                                            $value->n2 * 0.05 +
                                                            $value->n3 * 0.1 +
                                                            $value->n4 * 0.1 +
                                                            $value->n5 * 0.2 +
                                                            $value->n6 * 0.05 +
                                                            $value->n7 * 0.15 +
                                                            $value->n8 * 0.15 +
                                                            $value->n9 * 0.15;
                                                    }
                                                    $nilai_pembimbing2 =
                                                        $total_nilai_pembimbing2 / $jumlah_penilai_pembimbing2;
                                                } else {
                                                    $nilai_pembimbing2 = 0;
                                                }
                                                if ($jumlah_penilai_ketua > 0) {
                                                    foreach ($sidang->nilaiketua as $value) {
                                                        $total_nilai_ketua +=
                                                            $value->n1 * 0.05 +
                                                            $value->n2 * 0.05 +
                                                            $value->n3 * 0.1 +
                                                            $value->n4 * 0.1 +
                                                            $value->n5 * 0.2 +
                                                            $value->n6 * 0.05 +
                                                            $value->n7 * 0.15 +
                                                            $value->n8 * 0.15 +
                                                            $value->n9 * 0.15;
                                                    }
                                                    $nilai_ketua = $total_nilai_ketua / $jumlah_penilai_ketua;
                                                } else {
                                                    $nilai_ketua = 0;
                                                }
                                                if ($jumlah_penilai_sekretaris > 0) {
                                                    foreach ($sidang->nilaisekretaris as $value) {
                                                        $total_nilai_sekretaris +=
                                                            $value->n1 * 0.05 +
                                                            $value->n2 * 0.05 +
                                                            $value->n3 * 0.1 +
                                                            $value->n4 * 0.1 +
                                                            $value->n5 * 0.2 +
                                                            $value->n6 * 0.05 +
                                                            $value->n7 * 0.15 +
                                                            $value->n8 * 0.15 +
                                                            $value->n9 * 0.15;
                                                    }
                                                    $nilai_sekretaris =
                                                        $total_nilai_sekretaris / $jumlah_penilai_sekretaris;
                                                } else {
                                                    $nilai_sekretaris = 0;
                                                }
                                                if ($jumlah_penilai_anggota1 > 0) {
                                                    foreach ($sidang->nilaianggota1 as $value) {
                                                        $total_nilai_anggota1 +=
                                                            $value->n1 * 0.05 +
                                                            $value->n2 * 0.05 +
                                                            $value->n3 * 0.1 +
                                                            $value->n4 * 0.1 +
                                                            $value->n5 * 0.2 +
                                                            $value->n6 * 0.05 +
                                                            $value->n7 * 0.15 +
                                                            $value->n8 * 0.15 +
                                                            $value->n9 * 0.15;
                                                    }
                                                    $nilai_anggota1 = $total_nilai_anggota1 / $jumlah_penilai_anggota1;
                                                } else {
                                                    $nilai_anggota1 = 0;
                                                }
                                                if ($jumlah_penilai_anggota2 > 0) {
                                                    foreach ($sidang->nilaianggota2 as $value) {
                                                        $total_nilai_anggota2 +=
                                                            $value->n1 * 0.05 +
                                                            $value->n2 * 0.05 +
                                                            $value->n3 * 0.1 +
                                                            $value->n4 * 0.1 +
                                                            $value->n5 * 0.2 +
                                                            $value->n6 * 0.05 +
                                                            $value->n7 * 0.15 +
                                                            $value->n8 * 0.15 +
                                                            $value->n9 * 0.15;
                                                    }
                                                    $nilai_anggota2 = $total_nilai_anggota2 / $jumlah_penilai_anggota2;
                                                } else {
                                                    $nilai_anggota2 = 0;
                                                }
                                            }
                                            $rata_pendidikan = ($nilai_pembimbing1 + $nilai_pembimbing2) / 2;
                                            $rata_penguji =
                                                ($nilai_ketua + $nilai_sekretaris + $nilai_anggota1 + $nilai_anggota2) /
                                                4;
                                            $nilai_akhir = ($rata_pendidikan + $rata_penguji) / 2;

                                            // $status = 'Tidak Lulus';
                                            $count = 0;
                                            if ($nilai_ketua > 65) {
                                                $count++;
                                            }
                                            if ($nilai_sekretaris > 65) {
                                                $count++;
                                            }
                                            if ($nilai_anggota1 > 65) {
                                                $count++;
                                            }
                                            if ($nilai_anggota2 > 65) {
                                                $count++;
                                            }
                                            if ($count > 2) {
                                                // $status = 'Lulus';
                                                $sidang->update(['status' => true]);
                                            } else {
                                                $sidang->update(['status' => false]);
                                            }
                                        @endphp
                                        <td>{{ $nilai_akhir }}</td>
                                        <td>{{ $sidang->status == 1 ? 'Lulus' : 'Belum Lulus' }}</td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                    {{ $sidangs->links() }}
                </div>
            </div>
        </div>
    @endif

    <!-- Add the data to the view -->
    <script id="barChartData" type="application/json">
            @json($barChartData)
        </script>
    <script id="pieChartData" type="application/json">
    @json($pieChartData)
</script>

@endsection
