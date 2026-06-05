<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Sistem Pengajuan Surat</title>
    <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport" />
    <link rel="icon" href="{{ asset('assets/foto/logo.png') }}" type="image/png" />

    <!-- Fonts and icons -->
    <script src="{{ asset('assets/panel') }}/assets/js/plugin/webfont/webfont.min.js"></script>
    <script>
        WebFont.load({
            google: {
                families: ["Public Sans:300,400,500,600,700"]
            },
            custom: {
                families: [
                    "Font Awesome 5 Solid",
                    "Font Awesome 5 Regular",
                    "Font Awesome 5 Brands",
                    "simple-line-icons",
                ],
                urls: ["{{ asset('assets/panel') }}/assets/css/fonts.min.css"],
            },
            active: function() {
                sessionStorage.fonts = true;
            },
        });
    </script>

    <!-- CSS Files -->
    <link rel="stylesheet" href="{{ asset('assets/panel') }}/assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="{{ asset('assets/panel') }}/assets/css/plugins.min.css" />
    <link rel="stylesheet" href="{{ asset('assets/panel') }}/assets/css/kaiadmin.min.css" />

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css">

    <script src="{{ asset('assets/ckeditor/ckeditor.js') }}"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />



    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style>
        /* ================= SIDEBAR ================= */
        .sidebar,
        .sidebar[data-background-color=light] {
            background: #ffffff !important;
            color: #343a40 !important;
            box-shadow: 4px 4px 12px rgba(0, 0, 0, .08);
        }

        .sidebar .nav a {
            color: #343a40 !important;
            font-weight: 500;
            display: flex;
            align-items: center;
            padding: 10px 15px;
            border-radius: 10px;
            transition: all .25s ease;
        }

        .sidebar .nav i {
            color: rgba(0, 0, 0, 0.65) !important;
            margin-right: 10px;
            width: 20px;
            text-align: center;
        }

        /* Hover menu (hijau) */
        .sidebar .nav a:hover {
            background: rgba(80, 167, 194, 0.1) !important;
            color: #50a7c2 !important;
        }

        .sidebar .nav a:hover i {
            color: #50a7c2 !important;
        }

        /* Active menu (hijau) */
        .sidebar .nav-item.active>a {
            background: rgba(80, 167, 194, 0.15) !important;
            color: #50a7c2 !important;
            font-weight: 600;
            box-shadow: inset 4px 0 #50a7c2;
        }

        .sidebar .nav-item.active>a i {
            color: #50a7c2 !important;
        }

        .sidebar .text-section {
            color: rgba(0, 0, 0, .5) !important;
            text-transform: uppercase;
            font-size: .75rem;
            letter-spacing: .6px;
            margin: 15px 0 5px;
        }

        .sidebar-wrapper.scrollbar-inner::-webkit-scrollbar {
            width: 6px;
        }

        .sidebar-wrapper.scrollbar-inner::-webkit-scrollbar-thumb {
            background: rgba(0, 0, 0, .2);
            border-radius: 3px;
        }

        /* Avatar */
        .sidebar-user .avatar {
            background: #50a7c2 !important;
            color: #ffffff !important;
            font-weight: 700;
        }

        .sidebar-user .user-info .fw-semibold,
        .sidebar-user .user-info small {
            color: #343a40 !important;
        }

        /* ================= LOGO HEADER ================= */
        .logo-header[data-background-color=light] {
            background: linear-gradient(135deg, #b7f8db, #50a7c2) !important;
            border-bottom: 1px solid rgba(0, 0, 0, .08);
        }

        .logo-header .logo,
        .logo-header .logo h4 {
            color: #ffffff !important;
            font-weight: 700;
        }

        .logo-header .btn-toggle,
        .logo-header .topbar-toggler.more {
            background: transparent !important;
            border: none;
        }

        .logo-header .btn-toggle i,
        .logo-header .topbar-toggler.more i {
            color: #ffffff !important;
            font-size: 18px;
        }

        .logo-header .btn-toggle:hover i,
        .logo-header .topbar-toggler.more:hover i {
            color: #d1fae5 !important;
        }

        /* ================= HEADER ================= */
        .main-header {
            background: linear-gradient(135deg, #b7f8db, #50a7c2) !important;
            min-height: 60px;
            width: calc(100% - 250px);
            position: fixed;
            z-index: 1001;
            box-shadow: 0 4px 10px rgba(0, 0, 0, .08);
        }

        .main-header .nav-link,
        .main-header .navbar-brand,
        .main-header .navbar-text,
        .main-header i {
            color: #ffffff !important;
        }

        /* ================= BUTTON ================= */
        .btn-primary {
            background-color: #50a7c2 !important;
            border-color: #50a7c2 !important;
            color: #fff;
        }

        .btn-primary:hover {
            background-color: #3b8ca8 !important;
            border-color: #3b8ca8 !important;
        }

        .btn-primary:focus,
        .btn-primary:focus-visible {
            background-color: #3b8ca8 !important;
            border-color: #3b8ca8 !important;
            box-shadow: 0 0 0 .25rem rgba(80, 167, 194, .25) !important;
        }

        .btn-primary:active,
        .btn-primary.active {
            background-color: #2f6f87 !important;
            border-color: #2f6f87 !important;
        }

        .btn-primary:disabled {
            background-color: rgba(80, 167, 194, 0.5) !important;
            border-color: rgba(80, 167, 194, 0.5) !important;
        }
    </style>


</head>

<body>
    <div class="wrapper">
        <!-- Sidebar -->

        <div class="sidebar" data-background-color="light">
            <div class="sidebar-logo">
                <!-- Logo Header -->
                <div class="logo-header" data-background-color="light">
                    {{-- <img src="{{ asset('assets/panel') }}/assets/img/kaiadmin/logo_light.svg" alt="navbar brand"
                            class="navbar-brand" height="20" /> --}}
                    <h4 class="mb-0 fw-bold mt-1" style="color: #000 !important;">
                        Sistem Pengajuan Surat
                    </h4>

                    <div class="nav-toggle">
                        <button class="btn btn-toggle toggle-sidebar">
                            <i class="gg-menu-right"></i>
                        </button>
                        <button class="btn btn-toggle sidenav-toggler">
                            <i class="gg-menu-left"></i>
                        </button>
                    </div>

                    <button class="topbar-toggler more">
                        <i class="gg-more-vertical-alt"></i>
                    </button>
                </div>

                <!-- End Logo Header -->
            </div>
            <div class="sidebar-wrapper scrollbar scrollbar-inner">
                <div class="sidebar-content">
                    <!-- User Profile -->
                    <div class="sidebar-user px-3 py-3 mb-2">
                        <div class="d-flex align-items-center">
                            <!-- Avatar -->
                            <div class="position-relative me-3">
                                @if(auth()->user()->foto)
                                    <img src="{{ url('berkas/profil/' . auth()->user()->foto) }}" alt="Avatar" class="avatar-img rounded-circle border border-2 border-white" style="width:48px;height:48px; object-fit: cover;">
                                @else
                                    <div class="avatar avatar-lg rounded-circle bg-white text-primary d-flex align-items-center justify-content-center fw-bold border border-2 border-white" style="width:48px;height:48px;">
                                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                                    </div>
                                @endif
                                <span class="position-absolute bottom-0 end-0 p-1 bg-success border border-white rounded-circle" style="transform: translate(-2px, -2px);" title="Online"></span>
                            </div>

                            <!-- User Info -->
                            <div class="user-info">
                                <div class="fw-semibold text-white">
                                    {{ auth()->user()->name }}
                                </div>
                                <small class="text-white-50">
                                    {{ auth()->user()->role }}
                                </small>
                            </div>
                        </div>
                    </div>
                    <!-- End User Profile -->

                    <hr class="my-2" style="border-color: white">

                    <ul class="nav nav-secondary">

                        {{-- Dashboard --}}
                        <li class="nav-item {{ Request::is('panel') ? 'active' : '' }}">
                            <a href="{{ url('panel') }}">
                                <i class="fas fa-home"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>

                        @if (auth()->user()->role == 'Staff')
                            <li class="nav-section">
                                <h4 class="text-section">Master Data</h4>
                            </li>

                            <li class="nav-item {{ Request::is('panel/warga*') ? 'active' : '' }}">
                                <a href="{{ url('panel/warga') }}">
                                    <i class="fas fa-users"></i>
                                    <p>Data Warga</p>
                                </a>
                            </li>

                            <li class="nav-item {{ Request::is('panel/suratmasuk*') ? 'active' : '' }}">
                                <a href="{{ url('panel/suratmasuk') }}">
                                    <i class="fas fa-envelope"></i>
                                    <p>Surat Masuk</p>
                                </a>
                            </li>

                            <li class="nav-item {{ Request::is('panel/suratkeluar*') ? 'active' : '' }}">
                                <a href="{{ url('panel/suratkeluar') }}">
                                    <i class="fas fa-envelope-open"></i>
                                    <p>Surat Keluar</p>
                                </a>
                            </li>

                            <li class="nav-item {{ Request::is('panel/arsip*') ? 'active' : '' }}">
                                <a href="{{ url('panel/arsip') }}">
                                    <i class="fas fa-archive"></i>
                                    <p>Arsip</p>
                                </a>
                            </li>

                            <li class="nav-item {{ Request::is('panel/setting*') ? 'active' : '' }}">
                                <a href="{{ url('panel/setting') }}">
                                    <i class="fas fa-cog"></i>
                                    <p>Setting</p>
                                </a>
                            </li>
                        @endif

                        @if (auth()->user()->role == 'Lurah')
                            <li class="nav-section">
                                <h4 class="text-section">Master Data</h4>
                            </li>

                            <li class="nav-item {{ Request::is('panel/warga*') ? 'active' : '' }}">
                                <a href="{{ url('panel/warga') }}">
                                    <i class="fas fa-users"></i>
                                    <p>Data Warga</p>
                                </a>
                            </li>

                            <li class="nav-item {{ Request::is('panel/staff*') ? 'active' : '' }}">
                                <a href="{{ url('panel/staff') }}">
                                    <i class="fas fa-user-tie"></i>
                                    <p>Data Staff</p>
                                </a>
                            </li>

                            <li class="nav-item {{ Request::is('panel/suratmasuk*') ? 'active' : '' }}">
                                <a href="{{ url('panel/suratmasuk') }}">
                                    <i class="fas fa-envelope"></i>
                                    <p>Surat Masuk</p>
                                </a>
                            </li>

                            <li class="nav-item {{ Request::is('panel/suratkeluar*') ? 'active' : '' }}">
                                <a href="{{ url('panel/suratkeluar') }}">
                                    <i class="fas fa-envelope-open"></i>
                                    <p>Surat Keluar</p>
                                </a>
                            </li>

                            <li class="nav-item {{ Request::is('panel/arsip*') ? 'active' : '' }}">
                                <a href="{{ url('panel/arsip') }}">
                                    <i class="fas fa-archive"></i>
                                    <p>Arsip</p>
                                </a>
                            </li>
                        @endif

                        @if (auth()->user()->role == 'Warga')
                            <li class="nav-section">
                                <h4 class="text-section">Master Data</h4>
                            </li>

                            <li class="nav-item {{ Request::is('panel/suratmasuktambah*') ? 'active' : '' }}">
                                <a href="{{ url('panel/suratmasuktambah') }}">
                                    <i class="fas fa-envelope"></i>
                                    <p>Ajukan Surat</p>
                                </a>
                            </li>

                            <li class="nav-item {{ Request::is('panel/riwayatpengajuan*') ? 'active' : '' }}">
                                <a href="{{ url('panel/riwayatpengajuan') }}">
                                    <i class="fas fa-envelope"></i>
                                    <p>Riwayat Pengajuan</p>
                                </a>
                            </li>
                        @endif


                    </ul>
                </div>
            </div>
        </div>
        <!-- End Sidebar -->

        <div class="main-panel">
            <div class="main-header">
                <div class="main-header-logo">
                    <!-- Logo Header -->
                    <div class="logo-header" data-background-color="light">
                        <a href="{{ url('panel') }}" class="logo">
                            {{-- <img src="{{ asset('assets/panel') }}/assets/img/kaiadmin/logo_light.svg"
                                alt="navbar brand" class="navbar-brand" height="20" /> --}}
                            <h4 class="text-black">Sistem Pengajuan Surat</h4>
                        </a>
                        <div class="nav-toggle">
                            <button class="btn btn-toggle toggle-sidebar">
                                <i class="gg-menu-right"></i>
                            </button>
                            <button class="btn btn-toggle sidenav-toggler">
                                <i class="gg-menu-left"></i>
                            </button>
                        </div>
                        <button class="topbar-toggler more">
                            <i class="gg-more-vertical-alt"></i>
                        </button>
                    </div>
                    <!-- End Logo Header -->
                </div>
                <!-- Navbar Header -->
                <nav class="navbar navbar-header navbar-header-transparent navbar-expand-lg border-bottom">
                    <div class="container-fluid">

                        <ul class="navbar-nav topbar-nav ms-md-auto align-items-center">

                            <li class="nav-item topbar-user dropdown hidden-caret">
                                <a class="dropdown-toggle profile-pic" data-bs-toggle="dropdown" href="#"
                                    aria-expanded="false">
                                    <div class="avatar-sm position-relative">
                                        @if(auth()->user()->foto)
                                            <img src="{{ url('berkas/profil/' . auth()->user()->foto) }}" alt="..." class="avatar-img rounded-circle" style="object-fit: cover;"/>
                                        @else
                                            <div class="avatar-img rounded-circle bg-white text-primary d-flex align-items-center justify-content-center fw-bold" style="width:100%; height:100%;">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</div>
                                        @endif
                                        <span class="position-absolute bottom-0 end-0 p-1 bg-success border border-white rounded-circle" style="transform: translate(-10%, -10%);" title="Online"></span>
                                    </div>
                                    <span class="profile-username">
                                        <span class="op-7 text-white">Hi,</span>
                                        <span class="fw-bold text-white">{{ auth()->user()->name }}</span>
                                    </span>
                                </a>
                                <ul class="dropdown-menu dropdown-user animated fadeIn">
                                    <div class="dropdown-user-scroll scrollbar-outer">
                                        <li>
                                            <div class="user-box">
                                                <div class="avatar-lg position-relative">
                                                    @if(auth()->user()->foto)
                                                        <img src="{{ url('berkas/profil/' . auth()->user()->foto) }}" alt="image profile" class="avatar-img rounded" style="object-fit:cover;"/>
                                                    @else
                                                        <div class="avatar-img rounded bg-primary text-white d-flex align-items-center justify-content-center fw-bold" style="width:100%; height:100%; font-size:24px;">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</div>
                                                    @endif
                                                    <span class="position-absolute bottom-0 end-0 p-1 bg-success border border-white rounded-circle" style="transform: translate(25%, 25%);" title="Online"></span>
                                                </div>
                                                <div class="u-text">
                                                    <h4>{{ auth()->user()->name }}</h4>
                                                    <p class="text-muted">{{ auth()->user()->email }}</p>
                                                    <a href="{{ url('panel/profile') }}"
                                                        class="btn btn-xs btn-secondary btn-sm">View Profile</a>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="{{ url('panel/profile') }}">My Profile</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="{{ url('logout') }}"
                                                onclick="return confirm('Yakin ingin logout?')">Logout</a>
                                        </li>
                                    </div>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </nav>
                <!-- End Navbar -->
            </div>

            @yield('content')

            <footer class="footer">
                <div class="container-fluid d-flex justify-content-between">
                    <div class="copyright">
                        {{ date('Y') }}, made with <i class="fa fa-heart heart text-danger"></i> by
                        <a href="{{ url('/') }}">Sistem Pengajuan Surat</a>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <!--   Core JS Files   -->
    <script src="{{ asset('assets/panel') }}/assets/js/core/jquery-3.7.1.min.js"></script>
    <script src="{{ asset('assets/panel') }}/assets/js/core/popper.min.js"></script>
    <script src="{{ asset('assets/panel') }}/assets/js/core/bootstrap.min.js"></script>

    <!-- jQuery Scrollbar -->
    <script src="{{ asset('assets/panel') }}/assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>

    <!-- Chart JS -->
    <script src="{{ asset('assets/panel') }}/assets/js/plugin/chart.js/chart.min.js"></script>

    <!-- jQuery Sparkline -->
    <script src="{{ asset('assets/panel') }}/assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js"></script>

    <!-- Chart Circle -->
    <script src="{{ asset('assets/panel') }}/assets/js/plugin/chart-circle/circles.min.js"></script>

    <!-- Datatables -->
    <script src="{{ asset('assets/panel') }}/assets/js/plugin/datatables/datatables.min.js"></script>

    <!-- Bootstrap Notify -->
    <script src="{{ asset('assets/panel') }}/assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js"></script>

    <!-- jQuery Vector Maps -->
    <script src="{{ asset('assets/panel') }}/assets/js/plugin/jsvectormap/jsvectormap.min.js"></script>
    <script src="{{ asset('assets/panel') }}/assets/js/plugin/jsvectormap/world.js"></script>

    <!-- Sweet Alert -->
    <script src="{{ asset('assets/panel') }}/assets/js/plugin/sweetalert/sweetalert.min.js"></script>

    <!-- Kaiadmin JS -->
    <script src="{{ asset('assets/panel') }}/assets/js/kaiadmin.min.js"></script>


    <!-- Kaiadmin JS -->
    <script src="{{ asset('assets/panel') }}/assets/js/kaiadmin.min.js"></script>
    <!-- Kaiadmin DEMO methods, don't include it in your project! -->
    <script src="{{ asset('assets/panel') }}/assets/js/setting-demo2.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#datatable').DataTable({
                responsive: true,
                language: {
                    url: "//cdn.datatables.net/plug-ins/1.13.6/i18n/id.json"
                }
            });
        });
    </script>


    @if (session('success'))
        <script>
            const Toast = Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                }
            });
            Toast.fire({
                icon: "success",
                title: "{{ session('success') }}"
            });
        </script>
    @endif

    @if (session('error'))
        <script>
            const Toast = Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                }
            });
            Toast.fire({
                icon: "error",
                title: "{{ session('error') }}"
            });
        </script>
    @endif

    @if ($errors->any())
        <script>
            let errorMessages = `
            <ul style="text-align:left;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        `;
            Swal.fire({
                icon: 'warning',
                title: 'Validasi Gagal',
                html: errorMessages,
                confirmButtonColor: '#f0ad4e',
                confirmButtonText: 'Perbaiki'
            });
        </script>
    @endif


    <script>
        $("#lineChart").sparkline([102, 109, 120, 99, 110, 105, 115], {
            type: "line",
            height: "70",
            width: "100%",
            lineWidth: "2",
            lineColor: "#177dff",
            fillColor: "rgba(23, 125, 255, 0.14)",
        });

        $("#lineChart2").sparkline([99, 125, 122, 105, 110, 124, 115], {
            type: "line",
            height: "70",
            width: "100%",
            lineWidth: "2",
            lineColor: "#f3545d",
            fillColor: "rgba(243, 84, 93, .14)",
        });

        $("#lineChart3").sparkline([105, 103, 123, 100, 95, 105, 115], {
            type: "line",
            height: "70",
            width: "100%",
            lineWidth: "2",
            lineColor: "#ffa534",
            fillColor: "rgba(255, 165, 52, .14)",
        });
    </script>

    @if(auth()->user()->role == 'Warga')
    <script>
        setInterval(function() {
            $.ajax({
                url: "{{ url('panel/ceknotifikasi') }}",
                type: "GET",
                success: function(response) {
                    if (response.count > 0) {
                        response.data.forEach(function(item) {
                            Swal.fire({
                                icon: 'info',
                                title: 'Notifikasi Surat Baru!',
                                text: 'Surat ' + item.jenissurat + ' Anda diperbarui statusnya menjadi: ' + item.status,
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 6000,
                                timerProgressBar: true
                            });
                        });
                    }
                }
            });
        }, 10000); // Cek setiap 10 detik
    </script>
    @endif

    @yield('script')
</body>

</html>
