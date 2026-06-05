@extends('layouts.home')
@section('content')
    <!-- Carousel -->
    <style>
        .hero-section {
            position: relative;
            background: url('{{ asset("assets/foto/bg.jpg") }}') no-repeat center center/cover;
            height: 90vh;
            min-height: 600px;
            display: flex;
            align-items: center;
        }

        .hero-overlay {
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            background: linear-gradient(135deg, rgba(80, 167, 194, 0.85), rgba(27, 43, 85, 0.9));
            z-index: 1;
        }

        .hero-content {
            position: relative;
            z-index: 2;
        }

        .glass-box {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.2);
        }

        .feature-icon-box {
            width: 60px; height: 60px;
            display: flex; align-items: center; justify-content: center;
            border-radius: 15px;
            background: linear-gradient(135deg, #e0f7fa 0%, #b2ebf2 100%);
            box-shadow: 0 4px 15px rgba(0,0,0,0.05);
            transition: all 0.3s ease;
        }
        
        .feature-box:hover .feature-icon-box {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.1);
        }

        .gradient-text {
            background: linear-gradient(135deg, #50a7c2, #1b2b55);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
    </style>

    <!-- HERO SECTION -->
    <div class="hero-section mb-5">
        <div class="hero-overlay"></div>
        <div class="container hero-content">
            <div class="row justify-content-center">
                <div class="col-12 col-lg-9 text-center">
                    <div class="glass-box wow zoomIn" data-wow-delay="0.1s">
                        <span class="badge bg-light text-primary px-3 py-2 rounded-pill mb-3 text-uppercase shadow-sm wow fadeInDown" data-wow-delay="0.3s">
                            Sistem Informasi Terpadu
                        </span>
                        <h1 class="display-4 text-white fw-bold mb-4" style="text-shadow: 2px 2px 4px rgba(0,0,0,0.3);">
                            SAPURAN <br> Kelurahan Penurunan
                        </h1>
                        <p class="text-white mb-5 fs-5" style="opacity: 0.9; line-height: 1.8;">
                            Langkah nyata digitalisasi birokrasi kelurahan dengan integrasi teknologi untuk mempercepat alur kerja dan menciptakan sistem pelayanan surat menyurat yang transparan.
                        </p>

                        <div class="d-flex gap-3 justify-content-center">
                            <a href="{{ url('login') }}" class="btn btn-primary btn-lg rounded-pill px-5 shadow-lg border-0 fw-semibold" style="background: linear-gradient(135deg, #50a7c2, #3b8ca8);">
                                <i class="fa fa-sign-in-alt me-2"></i> Masuk Sistem
                            </a>
                            <a href="{{ url('kontak') }}" class="btn btn-outline-light btn-lg rounded-pill px-5 fw-semibold border-2">
                                Hubungi Kami
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ABOUT SAPURAN -->
    <div class="container-xxl py-5 overflow-hidden">
        <div class="container">
            <div class="row g-5 align-items-center">

                <div class="col-lg-6 wow slideInLeft" data-wow-delay="0.1s">
                    <div class="position-relative overflow-hidden ps-5 pt-5 h-100" style="min-height: 400px;">
                        <img class="position-absolute w-100 h-100" src="{{ asset('assets/foto/bg.jpg') }}"
                            style="object-fit: cover; border-radius: 8px;">

                        <div class="position-absolute top-0 start-0 bg-white pe-3 pb-3"
                            style="width: 220px; height: 220px; border-radius:8px;">
                            <div class="d-flex flex-column justify-content-center text-center bg-primary h-100 p-3 rounded wow zoomIn" data-wow-delay="0.3s">
                                <h6 class="text-white mb-1">Sistem Terpadu</h6>
                                <h5 class="text-white mb-0">SAPURAN</h5>
                                <small class="text-white">Kelurahan Penurunan</small>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 wow slideInRight" data-wow-delay="0.2s">
                    <div>
                        <div class="border-start border-4 border-primary ps-4 mb-4" style="border-radius: 2px;">
                            <h6 class="text-primary text-uppercase fw-bold ls-1 mb-1">Mengenal</h6>
                            <h2 class="fw-bold mb-0 gradient-text display-6">Apa Itu SAPURAN?</h2>
                        </div>

                        <p class="fs-6 text-muted mb-3 wow fadeIn" data-wow-delay="0.3s" style="line-height: 1.8;">
                            <strong>SAPURAN</strong> (Sistem Pelayanan Administrasi Terpadu Kelurahan Penurunan) adalah
                            platform berbasis web yang dirancang untuk mentransformasi tata kelola administrasi
                            surat-menyurat di Kelurahan Penurunan, Kota Bengkulu.
                        </p>

                        <p class="mb-5 text-muted wow fadeIn" data-wow-delay="0.4s" style="line-height: 1.8;">
                            Aplikasi ini hadir sebagai solusi digital untuk menggantikan sistem manual, guna menciptakan
                            birokrasi yang lebih <strong>efisien, transparan, dan akuntabel</strong>.
                        </p>

                        <div class="row g-4">
                            <div class="col-sm-6 feature-box wow fadeInUp" data-wow-delay="0.5s">
                                <div class="d-flex align-items-center">
                                    <div class="feature-icon-box me-3">
                                        <i class="fa fa-envelope-open-text fa-xl text-primary"></i>
                                    </div>
                                    <h6 class="mb-0 fw-bold">Manajemen Surat</h6>
                                </div>
                            </div>

                            <div class="col-sm-6 feature-box wow fadeInUp" data-wow-delay="0.6s">
                                <div class="d-flex align-items-center">
                                    <div class="feature-icon-box me-3">
                                        <i class="fa fa-users fa-xl text-primary"></i>
                                    </div>
                                    <h6 class="mb-0 fw-bold">Data Terpadu</h6>
                                </div>
                            </div>

                            <div class="col-sm-6 feature-box wow fadeInUp" data-wow-delay="0.7s">
                                <div class="d-flex align-items-center">
                                    <div class="feature-icon-box me-3">
                                        <i class="fa fa-chart-pie fa-xl text-primary"></i>
                                    </div>
                                    <h6 class="mb-0 fw-bold">Statistik Instan</h6>
                                </div>
                            </div>

                            <div class="col-sm-6 feature-box wow fadeInUp" data-wow-delay="0.8s">
                                <div class="d-flex align-items-center">
                                    <div class="feature-icon-box me-3">
                                        <i class="fa fa-bolt fa-xl text-primary"></i>
                                    </div>
                                    <h6 class="mb-0 fw-bold">Layanan Cepat</h6>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
