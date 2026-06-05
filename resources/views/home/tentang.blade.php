@extends('layouts.home')

@section('content')
    <style>
        .page-header-custom {
            background: linear-gradient(135deg, rgba(27, 43, 85, 0.9), rgba(80, 167, 194, 0.8)),
                url('{{ asset('assets/foto/bg.jpg') }}') center center no-repeat;
            background-size: cover;
        }

        .text-cyan {
            color: #50a7c2 !important;
        }

        .bg-dark-blue {
            background-color: #1b2b55;
        }

        .stat-card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
            transition: all 0.3s;
            overflow: hidden;
            background: white;
            border-bottom: 4px solid #50a7c2;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(80, 167, 194, 0.15);
        }

        .info-section {
            padding: 80px 0;
        }

        .section-title h2 {
            color: #1b2b55;
            font-weight: 800;
            position: relative;
            padding-bottom: 15px;
            margin-bottom: 25px;
        }

        .section-title h2::after {
            content: '';
            position: absolute;
            left: 0;
            bottom: 0;
            width: 60px;
            height: 4px;
            background: #50a7c2;
            border-radius: 2px;
        }

        .section-title.text-center h2::after {
            left: 50%;
            transform: translateX(-50%);
        }

        .list-custom-item {
            display: flex;
            align-items: flex-start;
            margin-bottom: 15px;
        }

        .list-custom-icon {
            width: 32px;
            height: 32px;
            background: rgba(80, 167, 194, 0.1);
            color: #50a7c2;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
            flex-shrink: 0;
            font-size: 14px;
        }

        .alert-warning-custom {
            background-color: #fff9e6;
            border-left: 5px solid #ffc107;
            padding: 20px;
            border-radius: 10px;
        }
    </style>

    <!-- HEADER -->
    <div class="container-fluid page-header-custom page-header py-5 mb-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container text-center py-5">
            <h1 class="display-4 text-white animated slideInDown mb-4">Profil SAPURAN</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb justify-content-center mb-0">
                    <li class="breadcrumb-item">
                        <a class="text-white" href="{{ url('/') }}">Beranda</a>
                    </li>
                    <li class="breadcrumb-item text-cyan active" aria-current="page">Profil SAPURAN</li>
                </ol>
            </nav>
        </div>
    </div>

    <!-- TENTANG KANTOR LURAH AND STATS -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-5 align-items-center mb-5">
                <div class="col-lg-6 wow slideInLeft" data-wow-delay="0.1s">
                    <div class="position-relative">
                        <img class="img-fluid rounded-4 shadow-lg" src="{{ asset('assets/foto/bg.jpg') }}"
                            alt="Kantor Lurah Penurunan" style="object-fit: cover; height: 450px; width: 100%;">
                        <div class="position-absolute bottom-0 end-0 bg-white p-4 rounded-start-4 shadow"
                            style="margin-bottom: -30px; border-bottom: 5px solid #1b2b55;">
                            <h2 class="text-cyan mb-0">86 <small class="fs-6 text-dark">Hektar</small></h2>
                            <p class="mb-0 fw-bold">Luas Wilayah</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 wow slideInRight" data-wow-delay="0.3s">
                    <div class="section-title">
                        <h6 class="text-cyan text-uppercase fw-bold mb-2">Profil Kantor</h6>
                        <h2 class="display-5 mb-4">Kelurahan Penurunan</h2>
                    </div>
                    <p class="mb-4 text-muted fs-5" style="line-height: 1.8;">
                        Kelurahan Penurunan merupakan bagian strategis dari wilayah Kecamatan Ratu Samban, Kota Bengkulu.
                        Dengan luas wilayah mencapai <strong>86 Hektar</strong>, kelurahan ini terbagi menjadi <strong>4
                            RW</strong> dan <strong>18 RT</strong>.
                    </p>
                    <div class="row g-3">
                        <div class="col-sm-6">
                            <div class="list-custom-item">
                                <div class="list-custom-icon"><i class="fa fa-mosque"></i></div>
                                <div><strong>10</strong> Tempat Ibadah</div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="list-custom-item">
                                <div class="list-custom-icon"><i class="fa fa-school"></i></div>
                                <div><strong>2</strong> Sekolah Dasar</div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="list-custom-item">
                                <div class="list-custom-icon"><i class="fa fa-map-marker-alt"></i></div>
                                <div><strong>18</strong> Rukun Tetangga (RT)</div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="list-custom-item">
                                <div class="list-custom-icon"><i class="fa fa-users"></i></div>
                                <div><strong>4</strong> Rukun Warga (RW)</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- DEMOGRAFI STATS -->
            <div class="row g-4 text-center mt-5">
                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="stat-card p-4">
                        <i class="fa fa-users text-cyan fs-1 mb-3"></i>
                        <h3 class="mb-1" style="color: #1b2b55;">4.633</h3>
                        <p class="text-muted mb-0">Total Penduduk</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="stat-card p-4">
                        <i class="fa fa-male text-primary fs-1 mb-3"></i>
                        <h3 class="mb-1" style="color: #1b2b55;">2.323</h3>
                        <p class="text-muted mb-0">Laki-laki</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="stat-card p-4">
                        <i class="fa fa-female text-danger fs-1 mb-3"></i>
                        <h3 class="mb-1" style="color: #1b2b55;">2.310</h3>
                        <p class="text-muted mb-0">Perempuan</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.7s">
                    <div class="stat-card p-4">
                        <i class="fa fa-briefcase text-success fs-1 mb-3"></i>
                        <h3 class="mb-1" style="color: #1b2b55;">1.480</h3>
                        <p class="text-muted mb-0">Angkatan Kerja</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- PENDIDIKAN & EKONOMI -->
    <div class="container-fluid py-5" style="background-color: #f0f7f9;">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="section-title">
                        <h6 class="text-cyan text-uppercase fw-bold mb-2">Sumber Daya Manusia</h6>
                        <h2 class="mb-4">Tingkat Pendidikan</h2>
                    </div>
                    <p class="text-muted mb-4">Gambaran kualifikasi pendidikan penduduk Kelurahan Penurunan:</p>
                    <div class="mb-4">
                        <div class="d-flex justify-content-between mb-1">
                            <span>Tamatan SD</span>
                            <span class="fw-bold">429 Orang</span>
                        </div>
                        <div class="progress" style="height: 10px;">
                            <div class="progress-bar bg-primary" style="width: 80%"></div>
                        </div>
                    </div>
                    <div class="mb-4">
                        <div class="d-flex justify-content-between mb-1">
                            <span>SLTA / Sederajat</span>
                            <span class="fw-bold">295 Orang</span>
                        </div>
                        <div class="progress" style="height: 10px;">
                            <div class="progress-bar bg-info" style="width: 65%"></div>
                        </div>
                    </div>
                    <div class="mb-4">
                        <div class="d-flex justify-content-between mb-1">
                            <span>Perguruan Tinggi</span>
                            <span class="fw-bold">197 Orang</span>
                        </div>
                        <div class="progress" style="height: 10px;">
                            <div class="progress-bar bg-success" style="width: 50%"></div>
                        </div>
                    </div>
                    <div class="mb-4">
                        <div class="d-flex justify-content-between mb-1">
                            <span>SLTP / Sederajat</span>
                            <span class="fw-bold">186 Orang</span>
                        </div>
                        <div class="progress" style="height: 10px;">
                            <div class="progress-bar bg-warning" style="width: 45%"></div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="section-title">
                        <h6 class="text-cyan text-uppercase fw-bold mb-2">Sektor Ekonomi</h6>
                        <h2 class="mb-4">Mata Pencaharian</h2>
                    </div>
                    <p class="text-muted mb-4">Sektor pekerjaan utama yang mendominasi perekonomian warga:</p>
                    <div class="row g-3">
                        <div class="col-sm-6">
                            <div class="p-4 bg-white rounded shadow-sm border-start border-4 border-cyan text-center">
                                <h4 class="mb-1">521</h4>
                                <p class="mb-0 text-muted small">Pedagang Kecil</p>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="p-4 bg-white rounded shadow-sm border-start border-4 border-dark-blue text-center">
                                <h4 class="mb-1">383</h4>
                                <p class="mb-0 text-muted small">Buruh Swasta</p>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4 p-4 bg-white rounded-3 shadow-sm">
                        <div class="d-flex align-items-center">
                            <div class="flex-shrink-0 bg-light text-danger p-3 rounded-circle me-3">
                                <i class="fa fa-user-slash fs-4"></i>
                            </div>
                            <div>
                                <h5 class="mb-0">158 Orang</h5>
                                <p class="mb-0 text-muted small">Jumlah pengangguran yang perlu diperhatikan</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- TANTANGAN & GEOGRAFI -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-7 wow slideInLeft" data-wow-delay="0.1s">
                    <div class="section-title">
                        <h6 class="text-cyan text-uppercase fw-bold mb-2">Fokus Pembenahan</h6>
                        <h2 class="mb-4">Permasalahan Lingkungan & Sosial</h2>
                    </div>
                    <p class="text-muted mb-4">
                        Kelurahan Penurunan saat ini tengah memprioritaskan penyelesaian beberapa tantangan krusial demi
                        kesejahteraan warga, di antaranya:
                    </p>
                    <div class="row g-4">
                        <div class="col-md-6">
                            <div class="list-custom-item">
                                <div class="list-custom-icon bg-danger text-white"><i class="fa fa-tint-slash"></i></div>
                                <p class="mb-0">Kesulitan akses air bersih dan belum meratanya fasilitas MCK.</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="list-custom-item">
                                <div class="list-custom-icon bg-danger text-white"><i class="fa fa-water"></i></div>
                                <p class="mb-0">Saluran air tidak berfungsi optimal (buntu) yang menyebabkan genangan.</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="list-custom-item">
                                <div class="list-custom-icon bg-warning text-dark"><i class="fa fa-heart-broken"></i></div>
                                <p class="mb-0">210 warga dengan tingkat kesehatan rendah.</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="list-custom-item">
                                <div class="list-custom-icon bg-warning text-dark"><i class="fa fa-user-graduate"></i></div>
                                <p class="mb-0">80 anak putus sekolah yang membutuhkan perhatian khusus.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 wow slideInRight" data-wow-delay="0.3s">
                    <div class="p-5 bg-dark-blue rounded-4 shadow text-white">
                        <h4 class="text-cyan mb-4"><i class="fa fa-globe-asia me-2"></i>Topografi & Wilayah</h4>
                        <p class="small mb-4" style="line-height: 1.6; opacity: 0.9;">
                            Wilayah Penurunan berada pada dataran rendah relatif datar di pesisir pantai dengan ketinggian
                            berkisar <strong>0-10 meter dpl</strong>.
                        </p>
                        <div class="alert-warning-custom text-dark mb-0">
                            <h6 class="fw-bold mb-2"><i class="fa fa-exclamation-triangle me-2 text-danger"></i>Zona Rawan
                                Bencana</h6>
                            <p class="small mb-0">
                                Berada di pesisir barat Pulau Sumatera, wilayah ini terpapar risiko gempa dan tsunami akibat
                                pergerakan lempeng lempeng bumi aktif. SAPURAN hadir sebagai bagian dari upaya mitigasi
                                melalui pendataan warga yang lebih akurat.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- PELAYANAN SECTION (Lama tetap dipertahankan namun dipoles) -->
    <div class="container-xxl py-5 mb-5" style="background-color: #f8fbff;">
        <div class="container text-center">
            <h6 class="text-cyan text-uppercase fw-bold mb-2 pt-4">Administrasi Cepat</h6>
            <h2 class="display-5 mb-5" style="color: #1b2b55;">Pelayanan Digital SAPURAN</h2>
            <div class="row g-4">
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="p-5 text-center bg-white rounded-4 shadow-sm h-100" style="border-top: 5px solid #50a7c2;">
                        <i class="bi bi-file-earmark-text text-cyan display-4 mb-4"></i>
                        <h4 class="mb-3">Transparan</h4>
                        <p class="mb-0 text-muted">Seluruh proses pengajuan dapat dipantau secara real-time oleh pengaju.
                        </p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="p-5 text-center bg-white rounded-4 shadow-sm h-100" style="border-top: 5px solid #1b2b55;">
                        <i class="bi bi-lightning-charge text-cyan display-4 mb-4"></i>
                        <h4 class="mb-3">Efisien</h4>
                        <p class="mb-0 text-muted">Pemrosesan data lebih cepat dengan otomasi administrasi digital.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="p-5 text-center bg-white rounded-4 shadow-sm h-100" style="border-top: 5px solid #50a7c2;">
                        <i class="bi bi-diagram-3 text-cyan display-4 mb-4"></i>
                        <h4 class="mb-3">Terintegrasi</h4>
                        <p class="mb-0 text-muted">Data database warga yang solid mendukung pengambilan kebijakan tepat
                            sasaran.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection