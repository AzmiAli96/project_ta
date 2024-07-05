            <!-- Page Wrapper -->
            <div id="wrapper">
                <!-- Sidebar -->
                <ul class="navbar-nav color-prime sidebar sidebar-dark accordion" id="accordionSidebar">

                    <!-- Sidebar - Brand -->
                    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                        <div class="sidebar-brand-icon rotate-n-30">

                        </div>
                        <div class="sidebar-brand-text mx-3"> <img src="/image/ti.png" style="width: 50px; height: 50px; border-radius: 50%; margin-right: 10px; float: center;">Sidang TA</div>
                    </a>

                    <!-- Divider -->
                    <hr class="sidebar-divider my-0">

                    <!-- Nav Item - Dashboard -->
                    <li class="nav-item active">
                        <a class="nav-link" href="/dashboard">
                            <i class="fas fa-fw fa-tachometer-alt"></i>
                            <span>Dashboard</span></a>
                    </li>

                    <!-- Divider -->
                    <hr class="sidebar-divider">

                    <!-- Heading -->
                    <div class="sidebar-heading">
                        Daftar
                    </div>
                    @if (in_array(auth()->user()->level, ['Admin']))
                    <!-- Nav Item - Pages Collapse Menu -->
                    <li class="nav-item {{ request()->routeIs('user.index') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('user.index') }}">
                            <i class="fas fa-user"></i>
                            <span>User</span>
                        </a>
                    </li>
                    @endif
                    @if (auth()->user()->level == 'Admin'|auth()->user()->level == 'Kaprodi' |auth()->user()->level == 'Dosen')
                    <!-- Nav Item - Pages Collapse Menu -->
                    <li class="nav-item {{ request()->routeIs('dosen.index') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('dosen.index') }}">
                            <i class="fas fa-user-friends"></i>
                            <span>Dosen</span>
                        </a>
                    </li>
                    @endif
                    @if (auth()->user()->level == 'Admin'|auth()->user()->level == 'Kaprodi'|auth()->user()->level == 'Mahasiswa' )
                    <!-- Nav Item - Utilities Collapse Menu -->
                    <li class="nav-item {{ request()->routeIs('mahasiswa.index') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('mahasiswa.index') }}">
                            <i class="fas fa-user-friends"></i>
                            <span>Mahasiswa</span>
                        </a>
                    </li>
                    @endif

                    <!-- Divider -->
                    <hr class="sidebar-divider">

                    <!-- Heading -->
                    <div class="sidebar-heading">
                        Addons
                    </div>

                    
                    <!-- Nav Item - Pages Collapse Menu -->
                    <li class="nav-item ">
                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
                            <i class="fas fa-fw fa-folder"></i>
                            <span>Kegiatan</span>
                        </a>
                        <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                            <div class="bg-white py-2 collapse-inner rounded">
                                <h6 class="collapse-header">Activity Screens:</h6>
                                @if (auth()->user()->level == 'Admin' )
                                <a class="collapse-item" href="/jurusan">Jurusan</a>
                                <a class="collapse-item" href="/prodi">Prodi</a>
                                <a class="collapse-item" href="/ruangan">Ruangan Sidang</a>
                                <!-- <div class="collapse-divider"></div>
                                <h6 class="collapse-header">Other Pages:</h6> -->
                                <a class="collapse-item" href="/sesi">Sesi waktu</a>
                                @endif
                                @if (auth()->user()->level == 'Admin' | auth()->user()->level == 'Kaprodi' |auth()->user()->level == 'Dosen' )
                                <a class="collapse-item" href="/tanggal">Tanggal</a>
                                <a class="collapse-item" href="/ta">Tugas Akhir</a>
                                @endif
                                @if (auth()->user()->level == 'Mahasiswa' )
                                <a class="collapse-item" href="/ta/{{ auth()->user()->mahasiswa->ta->id }}/edit">Tugas Akhir</a>
                                @endif
                                {{-- @if (auth()->user()->level == 'Admin'|auth()->user()->level == 'Kaprodi' )
                                <a class="collapse-item" href="/validasi">Validasi</a>
                                @endif --}}
                                @if (auth()->user()->level == 'Admin'|auth()->user()->level == 'Dosen' )
                                <a class="collapse-item" href="/nilai">Nilai</a>
                                @endif
                            </div>
                        </div>
                    </li>
                    

                    @if (auth()->user()->level == 'Admin'|auth()->user()->level == 'Kaprodi' )
                    <!-- Nav Item - Charts -->
                    <li class="nav-item">
                        <a class="nav-link" href="charts.html">
                            <i class="fas fa-fw fa-chart-area"></i>
                            <span>Charts</span></a>
                    </li>
                    @endif

                    <!-- Nav Item - Tables -->
                    <li class="nav-item {{ request()->routeIs('sidang.index') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('sidang.index') }}">
                            <i class="fas fa-fw fa-table"></i>
                            <span>Jadwal Sidang</span></a>
                    </li>

                    <!-- Divider -->
                    <hr class="sidebar-divider d-none d-md-block">

                    <!-- Sidebar Toggler (Sidebar) -->
                    <div class="text-center d-none d-md-inline">
                        <button class="rounded-circle border-0" id="sidebarToggle"></button>
                    </div>

                </ul>
                <!-- End of Sidebar -->

                <!-- Content Wrapper -->
                <div id="content-wrapper" class="d-flex flex-column">