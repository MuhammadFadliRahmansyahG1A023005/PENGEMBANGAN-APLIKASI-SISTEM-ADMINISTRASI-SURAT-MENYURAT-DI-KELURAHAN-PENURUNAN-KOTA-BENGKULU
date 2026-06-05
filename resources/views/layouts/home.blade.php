<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>SAPURAN</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta content="" name="keywords" />
    <meta content="" name="description" />

    <!-- Favicon -->
    <link href="{{ asset('assets/foto/logo.png') }}" rel="icon" type="image/png" />

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&family=Poppins:wght@600;700&display=swap"
        rel="stylesheet" />

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet" />

    <!-- Libraries Stylesheet -->
    <link href="{{ asset('assets/home') }}/lib/animate/animate.min.css" rel="stylesheet" />
    <link href="{{ asset('assets/home') }}/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('assets/home') }}/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Template Stylesheet -->
    <link href="{{ asset('assets/home') }}/css/style.css" rel="stylesheet" />

    <script src="{{ asset('assets/ckeditor/ckeditor.js') }}"></script>

</head>

<body>
    <!-- Spinner Start -->
    <div id="spinner"
        class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-grow text-danger" role="status"></div>
    </div>
    <!-- Spinner End -->

    <!-- Topbar Start -->
    {{-- <div class="container-fluid bg-light p-0">
        <div class="row gx-0 d-none d-lg-flex">
            <div class="col-lg-7 px-5 text-start">
                <div class="h-100 d-inline-flex align-items-center border-start border-end px-3">
                    <small class="fa fa-phone-alt me-2"></small>
                    <small>+012 345 6789</small>
                </div>
                <div class="h-100 d-inline-flex align-items-center border-end px-3">
                    <small class="far fa-envelope-open me-2"></small>
                    <small>info@example.com</small>
                </div>
                <div class="h-100 d-inline-flex align-items-center border-end px-3">
                    <small class="far fa-clock me-2"></small>
                    <small>Mon - Fri : 09 AM - 09 PM</small>
                </div>
            </div>
            <div class="col-lg-5 px-5 text-end">
                <div class="h-100 d-inline-flex align-items-center">
                    <a class="btn btn-square border-end border-start" href=""><i class="fab fa-facebook-f"></i></a>
                    <a class="btn btn-square border-end" href=""><i class="fab fa-twitter"></i></a>
                    <a class="btn btn-square border-end" href=""><i class="fab fa-linkedin-in"></i></a>
                    <a class="btn btn-square border-end" href=""><i class="fab fa-instagram"></i></a>
                </div>
            </div>
        </div>
    </div> --}}
    <!-- Topbar End -->

    <style>
        .custom-navbar {
            background: rgba(255, 255, 255, 0.95) !important;
            backdrop-filter: blur(10px);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease-in-out;
            padding: 15px 0;
            border-bottom: 2px solid rgba(80, 167, 194, 0.1);
        }

        .custom-navbar .navbar-brand {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .custom-navbar .navbar-brand img {
            width: 45px;
            transition: transform 0.3s;
        }

        .custom-navbar .navbar-brand:hover img {
            transform: scale(1.05);
        }

        .custom-navbar .navbar-brand h4 {
            color: #1b2b55;
            font-weight: 800;
            letter-spacing: 0.5px;
            margin: 0;
        }

        .nav-item-custom {
            font-weight: 600;
            color: #1b2b55 !important;
            padding: 8px 16px !important;
            margin: 0 5px;
            border-radius: 8px;
            transition: all 0.3s ease;
            position: relative;
        }

        .nav-item-custom:hover,
        .nav-item-custom.active {
            color: #50a7c2 !important;
            background: rgba(80, 167, 194, 0.1);
        }

        .btn-login-custom {
            background: linear-gradient(135deg, #1b2b55, #2b457a);
            color: #fff !important;
            font-weight: 600;
            padding: 8px 24px !important;
            border-radius: 50px;
            margin-left: 15px;
            box-shadow: 0 4px 15px rgba(27, 43, 85, 0.2);
            transition: all 0.3s;
        }

        .btn-login-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(27, 43, 85, 0.3);
            background: linear-gradient(135deg, #2b457a, #3a5c9f);
        }

        .dropdown-item-custom {
            font-weight: 500;
            color: #1b2b55;
            padding: 10px 20px;
            transition: all 0.2s;
        }

        .dropdown-item-custom:hover {
            background-color: rgba(80, 167, 194, 0.1);
            color: #50a7c2;
        }

        .custom-dropdown-menu {
            border: none;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            padding: 10px 0;
            margin-top: 10px !important;
        }
    </style>

    <nav class="navbar navbar-expand-lg custom-navbar sticky-top px-4 px-lg-5">
        <a href="{{ url('/') }}" class="navbar-brand">
            <img src="{{ asset('assets/foto/logo.png') }}" alt="logo">
            <h4>SAPURAN</h4>
        </a>
        <button type="button" class="navbar-toggler border-0 shadow-none" data-bs-toggle="collapse"
            data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto py-3 py-lg-0 align-items-center">
                <a href="{{ url('/') }}"
                    class="nav-item nav-link nav-item-custom {{ Request::is('/') ? 'active' : '' }}">Beranda</a>
                <div class="nav-item dropdown">
                    <a href="#"
                        class="nav-link dropdown-toggle nav-item-custom {{ Request::is('tentang') || Request::is('visimisi') || Request::is('struktur') ? 'active' : '' }}"
                        data-bs-toggle="dropdown">Tentang Kami</a>
                    <div class="dropdown-menu custom-dropdown-menu m-0">
                        <a href="{{ url('tentang') }}" class="dropdown-item dropdown-item-custom">Profil SAPURAN</a>
                        <a href="{{ url('visimisi') }}" class="dropdown-item dropdown-item-custom">Visi & Misi</a>
                        <a href="{{ url('struktur') }}" class="dropdown-item dropdown-item-custom">Struktur
                            Organisasi</a>
                    </div>
                </div>
                <a href="{{ url('kontak') }}"
                    class="nav-item nav-link nav-item-custom {{ Request::is('kontak') ? 'active' : '' }}">Kontak</a>
                <a href="{{ url('login') }}" class="nav-item nav-link btn-login-custom">Masuk Sistem</a>
            </div>
        </div>
    </nav>
    <!-- Navbar End -->

    @yield('content')

    <!-- Footer Start -->
    <style>
        .footer-custom {
            background-color: #1b2b55;
            color: #d8e2ef;
        }

        .footer-custom p.text-light {
            color: #b3c5dd !important;
        }

        .footer-custom .btn-social {
            color: #50a7c2;
            border: 1px solid #50a7c2;
            background: transparent;
            transition: 0.3s;
        }

        .footer-custom .btn-social:hover {
            background: #50a7c2;
            color: white;
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(80, 167, 194, 0.4);
        }

        .footer-custom .copyright {
            background: #142042;
            border-top: 1px solid rgba(255, 255, 255, 0.05);
        }

        .footer-custom .copyright a {
            color: #50a7c2 !important;
            font-weight: 600;
        }

        .back-to-top {
            background: linear-gradient(135deg, #1b2b55, #50a7c2) !important;
            border: none !important;
            box-shadow: 0 4px 15px rgba(27, 43, 85, 0.3);
            color: #fff !important;
        }

        .back-to-top:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(80, 167, 194, 0.4);
        }
    </style>
    <div class="container-fluid footer-custom footer mt-5 pt-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="row g-5">

                <!-- Kiri: Nama & Deskripsi -->
                <div class="col-lg-6 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                    <h1 class="text-white mb-4">
                        SAPURAN
                    </h1>
                    <p class="text-light">
                        SAPURAN adalah sistem pengajuan surat berbasis digital yang memudahkan warga
                        dalam mengajukan berbagai kebutuhan administrasi kelurahan secara cepat, praktis,
                        dan terintegrasi.
                    </p>

                    <div class="d-flex pt-3">
                        <a class="btn btn-square btn-social me-2" href="#">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a class="btn btn-square btn-social me-2" href="#">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a class="btn btn-square btn-social me-2" href="#">
                            <i class="fab fa-youtube"></i>
                        </a>
                        <a class="btn btn-square btn-social me-0" href="#">
                            <i class="fab fa-whatsapp"></i>
                        </a>
                    </div>
                </div>

                <!-- Kanan: Kontak & Informasi -->
                <div class="col-lg-6 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                    <h4 class="text-white mb-4">Kontak & Informasi</h4>

                    <p class="text-light">
                        <i class="fa fa-map-marker-alt me-3 text-info"></i>
                        Jl. Putri Gading Cempaka, Kelurahan Penurunan, Kecamatan Ratu Samban
                    </p>



                    <p class="text-light">
                        <i class="fa fa-envelope me-3 text-info"></i>
                        penurunankelurahan@gmail.com
                    </p>

                    <p class="text-light">
                        <i class="fa fa-file-alt me-3 text-info"></i>
                        Melayani pengajuan surat aktif, keterangan, dan administrasi lainnya
                    </p>
                </div>

            </div>
        </div>

        <!-- Copyright -->
        <div class="container-fluid copyright py-3">
            <div class="container text-center text-md-start">
                <div class="row">
                    <div class="col-md-6 text-light wow fadeIn" data-wow-delay="0.7s">
                        &copy; {{ date('Y') }}
                        <a href="#">SAPURAN</a>.
                        All Rights Reserved.
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer End -->

    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-lg-square back-to-top rounded-circle"><i class="bi bi-arrow-up"></i></a>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('assets/home') }}/lib/wow/wow.min.js"></script>
    <script src="{{ asset('assets/home') }}/lib/easing/easing.min.js"></script>
    <script src="{{ asset('assets/home') }}/lib/waypoints/waypoints.min.js"></script>
    <script src="{{ asset('assets/home') }}/lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Template Javascript -->
    <script src="{{ asset('assets/home') }}/js/main.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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


    @yield('script')
</body>

</html>