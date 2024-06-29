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
                        <h6 class="card-subtitle mb-2 text-body-secondary">1234 user</h6>
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
                        <h6 class="card-subtitle mb-2 text-body-secondary">1234 user</h6>
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
        <div class="row ml-2 col-6">
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
                                        $sidang->validasi->ta->Dpembimbing1->user->name === auth()->user()->name ||
                                        $sidang->validasi->ta->Dpembimbing2->user->name === auth()->user()->name ||
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
                                        <td>{{ $sidang->validasi->ta->nobp }} /
                                            {{ $sidang->validasi->ta->mahasiswa->user->name }}</td>
                                        <td>{{ $sidang->validasi->ta->mahasiswa->prodi->jenjang }} -
                                            {{ $sidang->validasi->ta->mahasiswa->prodi->kode_prodi }}</td>
                                        <td>{{ $sidang->validasi->ta->Dpembimbing1->user->name }} /
                                            {{ $sidang->validasi->ta->Dpembimbing2->user->name }}</td>
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



@endsection
