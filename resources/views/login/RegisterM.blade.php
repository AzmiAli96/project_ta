<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Register</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/startbootstrap-sb-admin-2-gh-pages/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="vendor/startbootstrap-sb-admin-2-gh-pages/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <div class="card o-hidden border-0 shadow-lg my-1">
            <div class="card-body p-4">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Silahkan Buat Akun!</h1>
                            </div>
                            @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $item)
                                    <li>{{$item }}</li>

                                    @endforeach
                                </ul>
                            </div>

                            @endif
                            <form class="user" method="POST" action="{{route('register.create')}}">
                                @csrf
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="text" class="form-control form-control-user" name="firstname" placeholder="First Name">
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control form-control-user" name="lastname" placeholder="Last Name">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control form-control-user" name="email" placeholder="Email Address">
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="password" class="form-control form-control-user" name="password" placeholder="Password">
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="password" class="form-control form-control-user" name="password2" placeholder="Repeat Password">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <select class="form-select form-control" name="level" id="level">
                                        <option selected hidden>Roll anda</option>
                                        <option value="Admin">Admin</option>
                                        <option value="Kaprodi">Kaprodi</option>
                                        <option value="Dosen">Dosen</option>
                                        <option value="Mahasiswa">Mahasiswa</option>
                                    </select>
                                </div>
                                <div id="Mahasiswa" class="mb-4" style="display: none;">
                                    <div class="form-group">
                                        <input type="number" id="no_bp" class="form-control form-control-user" name="no_bp" placeholder="NO BP">
                                    </div>
                                    <div class="form-group">
                                        <select name="prodi_id" id="prodi_id" class="form-select form-control">
                                            <option value="" hidden>--pilih prodi--</option>
                                            @foreach ($prodis as $prodi)
                                            <option value="{{$prodi->id}}">{{$prodi->nama}}</option>
                                            @endforeach
                                        </select>
                                        @error('prodi_id')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                    <input type="hidden" name="status_id" id="status_id" value="3">
                                </div>

                                <div id="Dosen" class="mb-4" style="display: none;">
                                    <div class="form-group">
                                        <input type="number" id="nidn" class="form-control form-control-user" name="nidn" placeholder="NIDN">
                                    </div>
                                    <div class="form-group">
                                        <input type="number" id="no_telp" class="form-control form-control-user" name="no_telp" placeholder="NO Telp">
                                    </div>
                                    <div class="form-group">
                                        <select class="form-select form-control" name="sebagai" id="sebagai">
                                            <option selected hidden>Roll anda</option>
                                            <option value="Penguji">Penguji</option>
                                            <option value="Pembimbing">Pembimbing</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                    <textarea class="form-control form-control-user" rows="2" id="alamat" name="alamat" placeholder="Alamat"></textarea>
                                    </div>
                                </div>


                                <button type="submit" class="btn btn-primary btn-user btn-block">
                                    Register Account
                                </button>
                            </form>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="forgot-password.html">Forgot Password?</a>
                            </div>
                            <div class="text-center">
                                <a class="small" href="/login">Sudah mempunyai akun? Login!</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/startbootstrap-sb-admin-2-gh-pages/vendor/jquery/jquery.min.js"></script>
    <script src="vendor/startbootstrap-sb-admin-2-gh-pages/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/startbootstrap-sb-admin-2-gh-pages/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="vendor/startbootstrap-sb-admin-2-gh-pages/js/sb-admin-2.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var mahasiswaSelect = document.getElementById('Mahasiswa');
            var no_bpSection = document.getElementById('no_bp');
            var prodi_idSection = document.getElementById('prodi_id');
            var status_idSection = document.getElementById('status_id');
            var levelSelect = document.getElementById('level');

            var dosenSelect = document.getElementById('Dosen');
            var nidnSection = document.getElementById('nidn');
            var no_telpSection = document.getElementById('no_telp');
            var sebagaiSection = document.getElementById('sebagai');
            var alamatSection = document.getElementById('alamat');



            levelSelect.addEventListener('change', function() {
                // Saya lupa apa aja yang perlu pake ini :v
                if (levelSelect.value === 'Mahasiswa') {
                    mahasiswaSelect.style.display = 'block';
                    no_bpSection.setAttribute('required', 'required');
                    prodi_idSection.setAttribute('required', 'required');
                    status_idSection.setAttribute('required', 'required');
                } else {
                    mahasiswaSelect.style.display = 'none';
                    no_bpSection.removeAttribute('required');
                    prodi_idSection.removeAttribute('required');
                    status_idSection.removeAttribute('required');
                }
                if (levelSelect.value === 'Dosen') {
                    dosenSelect.style.display = 'block';
                    nidnSection.setAttribute('required', 'required');
                    no_telpSection.setAttribute('required', 'required');
                    sebagaiSection.setAttribute('required', 'required');
                    alamatSection.setAttribute('required', 'required');
                } else {
                    dosenSelect.style.display = 'none';
                    nidnSection.removeAttribute('required');
                    no_telpSection.removeAttribute('required');
                    sebagaiSection.removeAttribute('required');
                    alamatSection.removeAttribute('required');
                }
            });
            levelSelect.dispatchEvent(new Event('change'));
        });
    </script>

</body>

</html>