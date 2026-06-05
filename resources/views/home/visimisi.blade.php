@extends('layouts.home')

@section('content')
    <style>
        .page-header-custom {
            background: linear-gradient(135deg, rgba(27, 43, 85, 0.9), rgba(80, 167, 194, 0.8)), url('{{ asset("assets/foto/bg.jpg") }}') center center no-repeat;
            background-size: cover;
        }
        .text-cyan {
            color: #50a7c2 !important;
        }
        .vm-card {
            background: white;
            border-radius: 20px;
            padding: 50px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.05);
            border: 1px solid rgba(80, 167, 194, 0.1);
            height: 100%;
        }
        .vm-icon {
            width: 80px;
            height: 80px;
            background: rgba(80, 167, 194, 0.1);
            color: #50a7c2;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 35px;
            margin-bottom: 30px;
        }
        .misi-list {
            list-style: none;
            padding: 0;
        }
        .misi-list li {
            padding-left: 35px;
            position: relative;
            margin-bottom: 20px;
            line-height: 1.6;
            color: #666;
        }
        .misi-list li::before {
            content: "\f00c";
            font-family: "Font Awesome 5 Free";
            font-weight: 900;
            position: absolute;
            left: 0;
            top: 0;
            color: #50a7c2;
            width: 25px;
            height: 25px;
            background: rgba(80, 167, 194, 0.1);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 10px;
        }
    </style>

    <!-- HEADER -->
    <div class="container-fluid page-header-custom page-header py-5 mb-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container text-center py-5">
            <h1 class="display-4 text-white animated slideInDown mb-4">Visi & Misi</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb justify-content-center mb-0">
                    <li class="breadcrumb-item">
                        <a class="text-white" href="{{ url('/') }}">Beranda</a>
                    </li>
                    <li class="breadcrumb-item text-cyan active" aria-current="page">Visi & Misi</li>
                </ol>
            </nav>
        </div>
    </div>

    <!-- VISI & MISI CONTENT -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-5">
                <!-- VISI -->
                <div class="col-lg-5 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="vm-card border-bottom border-5 border-cyan">
                        <div class="vm-icon">
                            <i class="fa fa-eye"></i>
                        </div>
                        <h2 class="mb-4" style="color: #1b2b55;">Visi</h2>
                        <p class="fs-4 italic text-muted" style="line-height: 1.8; font-style: italic;">
                            "Mewujudkan Kelurahan Penurunan sebagai Pusat Pelayanan Publik Digital yang Unggul, Transparan, dan Mandiri di Kota Bengkulu."
                        </p>
                    </div>
                </div>

                <!-- MISI -->
                <div class="col-lg-7 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="vm-card border-bottom border-5 border-dark">
                        <div class="vm-icon" style="background: rgba(27, 43, 85, 0.1); color: #1b2b55;">
                            <i class="fa fa-bullseye"></i>
                        </div>
                        <h2 class="mb-4" style="color: #1b2b55;">Misi</h2>
                        <ul class="misi-list">
                            <li>Mengoptimalkan sistem administrasi kelurahan melalui integrasi teknologi informasi (SAPURAN).</li>
                            <li>Memberikan pelayanan prima yang cepat, akurat, dan merata bagi seluruh lapisan warga tanpa diskriminasi.</li>
                            <li>Mendorong partisipasi aktif masyarakat dalam pembangunan lingkungan melalui keterbukaan data dan informasi.</li>
                            <li>Memperkuat tata kelola lembaga kemasyarakatan kelurahan demi terciptanya lingkungan yang aman dan produktif.</li>
                            <li>Meningkatkan kualitas sumber daya manusia kelurahan yang responsif terhadap kebutuhan strategis masyarakat.</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- MOTTO -->
    <div class="container-fluid py-5 mt-5 bg-dark-blue text-white wow fadeIn" data-wow-delay="0.1s" style="background-color: #1b2b55;">
        <div class="container text-center py-5">
            <h6 class="text-cyan text-uppercase fw-bold mb-3">Motto Pelayanan</h6>
            <h1 class="display-4 mb-4 text-white">Cukup dari Rumah, Kami Melayani dengan Hati</h1>
            <p class="mb-0 mx-auto" style="max-width: 600px; opacity: 0.8;">
                Komitmen kami adalah menghadirkan birokrasi yang mempermudah warga, bukan mempersulit. Layanan digital adalah jembatan menuju kesejahteraan bersama.
            </p>
        </div>
    </div>
@endsection
