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

        .bg-gradient-custom {
            background: linear-gradient(135deg, #1b2b55, #50a7c2) !important;
        }
    </style>
    {{-- HEADER --}}
    <div class="container-fluid page-header-custom page-header py-5 mb-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container text-center py-5">
            <h1 class="display-4 text-white animated slideInDown mb-4">Kontak</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb justify-content-center mb-0">
                    <li class="breadcrumb-item">
                        <a class="text-white" href="{{ url('/') }}">Beranda</a>
                    </li>
                    <li class="breadcrumb-item text-cyan active" aria-current="page">Kontak</li>
                </ol>
            </nav>
        </div>
    </div>

    {{-- CONTENT --}}
    <div class="container-xxl py-5">
        <div class="container">

            <div class="text-center mb-5 wow fadeInUp" data-wow-delay="0.1s">
                <span class="badge bg-light text-cyan px-3 py-2 rounded-pill mb-3 text-uppercase shadow-sm">
                    SAPURAN
                </span>
                <h1 class="display-5 fw-bold mb-3" style="color: #1b2b55;">Hubungi Kami</h1>
                <p class="text-muted fs-5">
                    Membutuhkan bantuan atau informasi lebih lanjut? Kami siap membantu.
                </p>
            </div>

            <div class="row g-4">

                {{-- INFO KONTAK --}}
                <div class="col-lg-5 wow slideInLeft" data-wow-delay="0.2s">
                    <div class="card shadow border-0 h-100" style="border-radius: 15px; overflow: hidden;">
                        <div class="card-header bg-gradient-custom text-white py-4 border-0">
                            <h4 class="fw-bold mb-0 text-white"><i class="bi bi-headset me-2"></i> Informasi Kontak</h4>
                        </div>
                        <div class="card-body p-4">

                            <div class="d-flex align-items-center mb-4">
                                <div class="bg-light rounded-circle d-flex align-items-center justify-content-center me-3 shadow-sm"
                                    style="width: 50px; height: 50px;">
                                    <i class="bi bi-geo-alt-fill text-cyan fs-4"></i>
                                </div>
                                <div>
                                    <h6 class="fw-bold mb-1">Alamat</h6>
                                    <p class="text-muted mb-0 small">Jl. Putri Gading Cempaka, Kelurahan Penurunan,
                                        Kecamatan Ratu Samban Kota Bengkulu Provinsi Bengkulu</p>
                                </div>
                            </div>



                            <div class="d-flex align-items-center mb-4">
                                <div class="bg-light rounded-circle d-flex align-items-center justify-content-center me-3 shadow-sm"
                                    style="width: 50px; height: 50px;">
                                    <i class="bi bi-envelope-fill text-cyan fs-4"></i>
                                </div>
                                <div>
                                    <h6 class="fw-bold mb-1">Email</h6>
                                    <p class="text-muted mb-0 small">penurunankelurahan@gmail.com</p>
                                </div>
                            </div>

                            <div class="d-flex align-items-center">
                                <div class="bg-light rounded-circle d-flex align-items-center justify-content-center me-3 shadow-sm"
                                    style="width: 50px; height: 50px;">
                                    <i class="bi bi-clock-fill text-cyan fs-4"></i>
                                </div>
                                <div>
                                    <h6 class="fw-bold mb-1">Jam Operasional</h6>
                                    <p class="text-muted mb-0 small">Senin - Jumat : 08.00 - 16.00 WIB</p>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                {{-- GOOGLE MAPS --}}
                <div class="col-lg-7 wow slideInRight" data-wow-delay="0.4s">
                    <div class="card shadow border-0 h-100" style="border-radius: 15px; overflow: hidden;">
                        <div class="card-body p-0 custom-map-container">
                            <iframe src="https://www.google.com/maps?q=Kantor+Lurah+Penurunan,+Bengkulu&output=embed"
                                width="100%" height="100%" style="border:0; min-height:450px;" allowfullscreen=""
                                loading="lazy">
                            </iframe>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
@endsection