<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LandingPage</title>
    
    <!-- Custom styles for this template -->
    <link href="{{ asset('vendor/startbootstrap-sb-admin-2-gh-pages/css/sb-admin-2.min.css') }}" rel="stylesheet">

    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/my.css" rel="stylesheet">
</head>

    

<header>
    
</header>

<body>
    <!-- Navbar -->

    <nav class="navbar bg-body-tertiary">
        <form class="container-fluid justify-content-end">
            <a class="btn button-ol-purple me-2" href="{{ url('/login') }}">Sign in</a>
            <a class="btn button-purple" href="{{ url('/register') }}">Sign Up</a>
        </form>
    </nav>

    
    
    <!-- Main Content -->
    <div class="header-section d-flex align-items-center">
        <div class="container text-white">
            <div class="row">
                <div class="col-md-6">
                    <h1>Sistem Penjadwalan Sidang Tugas Akhir</h1>
                    <p>Selamat datang di laman depan website ini, sistem ini diperuntukkan bagi kebutuhan sidang tugas akhir jurusan Teknologi Informasi PNP</p>
                    <a class="btn button-into me-2" href="{{ url('/login') }}">Sign in</a>
                    <a class="btn button-in" href="{{ url('/register') }}">Sign Up</a>
                </div>
                <div class="col-md-6 text-center">
                    <img src="/image/ta.png" alt="Logo" class="img-fluid">
                </div>
            </div>
        </div>
    </div>

    
{{-- 3 button --}}
<div class="container mt-5">
    <div class="card mb-4">
        <div class="card-header py-3">
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <!-- Topbar Search -->
                <form action="/sidang" method="GET" class="d-none d-sm-inline-block form-inline mr-auto md-3 my-2 my-md-0 mw-100 navbar-search">
                    @csrf
                    <div class="input-group">
                        <input type="text" name="search" class="form-control border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="submit">
                                <i class="bi bi-search"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Mahasiswa</th>
                            <th>Tanggal</th>
                            <th>Ruangan</th>
                            <th>Sesi</th>
                            <th>Ketua Sidang</th>
                            <th>Sekretaris Sidang</th>
                            <th>Anggota sidang 1</th>
                            <th>Anggota sidang 2</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($sidangs as $sidang )
                        <tr>
                            <td>{{ $sidangs->firstItem()+$loop->index }}</td>
                            <td>{{ $sidang->ta->nobp }} / {{ $sidang->ta->mahasiswa->namalengkap }}</td>
                            <td>{{ $sidang->tanggal }}</td>
                            <td>{{ $sidang->ruangan->nama_ruangan }}</td>
                            <td>{{ $sidang->sesi->sesi }}</td>
                            <td>{{ $sidang->pketua_sidang->user->name }}</td>
                            <td>{{ $sidang->psek_sidang->user->name }}</td>
                            <td>{{ $sidang->panggota1->user->name }}</td>
                            <td>{{ $sidang->panggota2->user->name }}</td>
                        </tr>
                        @endforeach
                </table>
                {{ $sidangs->links() }}
            </div>
        </div>
    </div>
</div>







<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="/js/bootstrap.bundle.min.js" ></script>
<script src="scripts.js"></script>
</body>
</html>
