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

        .org-container {
            background-color: #f8fbff;
        }

        /* SUSUNAN ORGANISASI VISUAL HIERARCHY */
        .org-chart {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 40px 0;
        }

        .org-row {
            display: flex;
            justify-content: center;
            width: 100%;
            margin-bottom: 40px;
            position: relative;
        }

        .org-node {
            background: white;
            border-radius: 12px;
            padding: 15px;
            text-align: center;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
            border: 2px solid rgba(80, 167, 194, 0.1);
            width: 250px;
            transition: all 0.3s ease;
        }

        .org-node:hover {
            transform: translateY(-5px);
            border-color: #50a7c2;
            box-shadow: 0 10px 30px rgba(80, 167, 194, 0.15);
        }

        .org-role {
            font-size: 0.7rem;
            color: #50a7c2;
            text-transform: uppercase;
            font-weight: 800;
            letter-spacing: 1px;
            margin-bottom: 8px;
            display: block;
        }

        .org-name {
            font-size: 0.95rem;
            color: #1b2b55;
            font-weight: 700;
            margin-bottom: 3px;
        }

        .org-nip {
            font-size: 0.7rem;
            color: #888;
        }

        .connector-line {
            position: absolute;
            background: #dee2e6;
        }

        .v-line {
            width: 2px;
            height: 40px;
            left: 50%;
            top: 100%;
            transform: translateX(-50%);
        }

        /* CUSTOM THEME FOR LEVEL */
        .node-lurah {
            border-color: #1b2b55;
            background: #fff;
        }

        .node-sekre {
            border-color: #50a7c2;
        }

        .node-kasi {
            border-color: #eee;
        }

        /* Tabs Styling */
        .nav-pills-custom .nav-link {
            color: #1b2b55;
            font-weight: 600;
            padding: 12px 25px;
            border-radius: 50px;
            transition: 0.3s;
            margin: 5px;
            border: 1px solid rgba(27, 43, 85, 0.1);
        }

        .nav-pills-custom .nav-link.active {
            background-color: #1b2b55;
            color: white;
            box-shadow: 0 5px 15px rgba(27, 43, 85, 0.2);
        }

        /* Table Styling */
        .table-custom {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 5px 25px rgba(0, 0, 0, 0.03);
        }

        .table-custom thead {
            background-color: #1b2b55;
            color: white;
        }
    </style>

    <!-- HEADER -->
    <div class="container-fluid page-header-custom page-header py-5 mb-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container text-center py-5">
            <h1 class="display-4 text-white animated slideInDown mb-4">Struktur Organisasi</h1>
            <nav aria-label="breadcrumb animated slideInDown">
                <ol class="breadcrumb justify-content-center mb-0">
                    <li class="breadcrumb-item">
                        <a class="text-white" href="{{ url('/') }}">Beranda</a>
                    </li>
                    <li class="breadcrumb-item text-cyan active" aria-current="page">Struktur Organisasi</li>
                </ol>
            </nav>
        </div>
    </div>

    <!-- TABS NAVIGATION -->
    <div class="container mb-5">
        <ul class="nav nav-pills nav-pills-custom justify-content-center wow fadeInUp" id="orgTabs" role="tablist"
            data-wow-delay="0.1s">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="kelurahan-tab" data-bs-toggle="pill" data-bs-target="#kelurahan"
                    type="button" role="tab">Struktur Kelurahan</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="lpm-tab" data-bs-toggle="pill" data-bs-target="#lpm" type="button"
                    role="tab">LPM Penurunan</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="linmas-tab" data-bs-toggle="pill" data-bs-target="#linmas" type="button"
                    role="tab">Linmas</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="rtrw-tab" data-bs-toggle="pill" data-bs-target="#rtrw" type="button"
                    role="tab">Data RT & RW</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="penghulu-tab" data-bs-toggle="pill" data-bs-target="#penghulu" type="button"
                    role="tab">Rajo Penghulu</button>
            </li>
        </ul>
    </div>

    <!-- TABS CONTENT -->
    <div class="tab-content" id="orgTabsContent">

        <!-- SECTION 1: KELURAHAN (SESUAI GAMBAR BARU) -->
        <div class="tab-pane fade show active" id="kelurahan" role="tabpanel">
            <div class="container-xxl py-4 org-container rounded-4">
                <div class="org-chart">

                    <!-- LURAH -->
                    <div class="org-row">
                        <div class="org-node node-lurah shadow-lg">
                            <span class="org-role">Kepala Kelurahan Penurunan</span>
                            <div class="org-name">{{ $globalSetting->namalurah }}</div>
                            <div class="org-nip">NIP. {{ $globalSetting->nip }}</div>
                        </div>
                    </div>

                    <!-- LEVEL 2: FUNGSIONAL & SEKRETARIS -->
                    <div class="container">
                        <div class="row justify-content-center g-4">
                            <!-- JABATAN FUNGSIONAL -->
                            <div class="col-lg-4">
                                <div class="org-node w-100 text-start" style="border-style: dashed;">
                                    <span class="org-role border-bottom pb-2 mb-2">Kelompok Jabatan Fungsional</span>
                                    <div class="d-flex justify-content-between mb-1">
                                        <small class="fw-bold text-muted">BABINSA</small>
                                        <small class="fw-bold">{{ $globalSetting->babinsa }}</small>
                                    </div>
                                    <div class="d-flex justify-content-between mb-1">
                                        <small class="fw-bold text-muted">BHABINKAMTIBMAS</small>
                                        <small class="fw-bold">{{ $globalSetting->bhabinkamtibmas }}</small>
                                    </div>
                                    <div class="d-flex justify-content-between">
                                        <small class="fw-bold text-muted">BLPKB</small>
                                        <small class="fw-bold">{{ $globalSetting->blpkb }}</small>
                                    </div>
                                </div>
                            </div>

                            <!-- SPACE CENTER (Invisible Connector V) -->
                            <div class="col-lg-1 d-none d-lg-block"></div>

                            <!-- SEKRETARIS -->
                            <div class="col-lg-4">
                                <div class="org-node w-100 node-sekre">
                                    <span class="org-role">Sekretaris</span>
                                    <div class="org-name">-</div>
                                    <div class="org-nip">NIP. -</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="my-5 w-100 text-center">
                        <hr style="width: 80%; margin: 0 auto; border-top: 2px solid #dee2e6;">
                    </div>

                    <!-- LEVEL 3: KASI & STAF -->
                    <div class="container-fluid">
                        <div class="row g-4 justify-content-center">

                            <!-- KASI PEMERINTAHAN -->
                            <div class="col-md-4">
                                <div class="d-flex flex-column align-items-center">
                                    <div class="org-node node-kasi mb-3 w-100">
                                        <span class="org-role">Kasi Pemerintahan / Trantib</span>
                                        <div class="org-name">{{ $globalSetting->nama_kasi_pemerintahan }}</div>
                                        <div class="org-nip">NIP. {{ $globalSetting->nip_kasi_pemerintahan }}</div>
                                    </div>
                                    <div class="org-node node-kasi bg-light border-0 w-75 py-2">
                                        <span class="org-role" style="font-size: 0.6rem;">Staf</span>
                                        <div class="org-name" style="font-size: 0.8rem;">-</div>
                                    </div>
                                </div>
                            </div>

                            <!-- KASI PEMBANGUNAN -->
                            <div class="col-md-4">
                                <div class="d-flex flex-column align-items-center">
                                    <div class="org-node node-kasi mb-3 w-100">
                                        <span class="org-role">Kasi Pembangunan</span>
                                        <div class="org-name">{{ $globalSetting->nama_kasi_pembangunan ?? '-' }}</div>
                                        <div class="org-nip">NIP. {{ $globalSetting->nip_kasi_pembangunan ?? '-' }}</div>
                                    </div>
                                    <div class="org-node node-kasi bg-light border-0 w-75 py-2">
                                        <span class="org-role" style="font-size: 0.6rem;">Staf</span>
                                        <div class="org-name" style="font-size: 0.8rem;">-</div>
                                    </div>
                                </div>
                            </div>

                            <!-- KASI PELAYANAN UMUM -->
                            <div class="col-md-4">
                                <div class="d-flex flex-column align-items-center">
                                    <div class="org-node node-kasi mb-3 w-100">
                                        <span class="org-role">Kasi Pelayanan Umum</span>
                                        <div class="org-name">{{ $globalSetting->nama_kasi_pelayanan }}</div>
                                        <div class="org-nip">NIP. {{ $globalSetting->nip_kasi_pelayanan }}</div>
                                    </div>
                                    <div class="org-node node-kasi bg-light border-0 w-75 py-2">
                                        <span class="org-role" style="font-size: 0.6rem;">Staf</span>
                                        <div class="org-name" style="font-size: 0.8rem;">-</div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>

        <!-- SECTION 2: LPM -->
        <div class="tab-pane fade" id="lpm" role="tabpanel">
            <div class="container py-4">
                <div class="text-center mb-5">
                    <h3 class="fw-bold" style="color: #1b2b55;">Lembaga Pemberdayaan Masyarakat (LPM)</h3>
                    <p class="text-muted">Personalia Pengurusan LPM Kelurahan Penurunan</p>
                </div>
                <div class="row justify-content-center mb-5">
                    <div class="col-md-4">
                        <div class="org-node w-100 border-top border-5 border-cyan shadow">
                            <span class="org-role">KETUA LPM</span>
                            <div class="org-name fs-4">FAJARULLAH</div>
                        </div>
                    </div>
                </div>
                <div class="row g-4 mb-5">
                    <div class="col-md-6 text-center">
                        <div class="org-node w-100">
                            <span class="org-role">SEKRETARIS</span>
                            <div class="org-name">AGUSTINA</div>
                        </div>
                    </div>
                    <div class="col-md-6 text-center">
                        <div class="org-node w-100">
                            <span class="org-role">BENDAHARA</span>
                            <div class="org-name">MAPILINDO</div>
                        </div>
                    </div>
                </div>
                <div class="row g-3">
                    @php
                        $bidangLpm = [
                            ['role' => 'Bid. Agama', 'name' => 'Imam Kelurahan'],
                            ['role' => 'Bid. Adat Istiadat', 'name' => 'Tokoh Adat Kelurahan'],
                            ['role' => 'Bid. Diklat', 'name' => 'Bidang Diklat Kelurahan'],
                            ['role' => 'Bid. Kamtibmas', 'name' => 'Anggota Linmas Kelurahan'],
                            ['role' => 'Bid. Lingkungan Hidup', 'name' => 'Bidang Lingkungan Hidup Kelurahan'],
                            ['role' => 'Bid. Ekonomi Koperasi', 'name' => 'Bidang Ekonomi Koperasi Kelurahan'],
                            ['role' => 'Bid. Seni Budaya', 'name' => 'Bidang Seni Budaya Kelurahan'],
                            ['role' => 'Bid. Kesejahteraan Sosial', 'name' => 'Anggota Sibat Kelurahan'],
                            ['role' => 'Bid. PKK', 'name' => 'PKK Kelurahan']
                        ];
                    @endphp
                    @foreach($bidangLpm as $bid)
                        <div class="col-lg-4 col-md-6">
                            <div
                                class="p-3 bg-white shadow-sm rounded-3 border-start border-4 border-cyan d-flex align-items-center">
                                <div class="ms-2">
                                    <small class="text-cyan fw-bold d-block"
                                        style="font-size: 0.7rem;">{{ $bid['role'] }}</small>
                                    <span class="fw-bold" style="color: #1b2b55;">{{ $bid['name'] }}</span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- SECTION 3: LINMAS -->
        <div class="tab-pane fade" id="linmas" role="tabpanel">
            <div class="container py-4">
                <div class="text-center mb-5">
                    <h3 class="fw-bold" style="color: #1b2b55;">Satuan Linmas Kelurahan</h3>
                    <p class="text-muted">Data Anggota Linmas Kelurahan Penurunan</p>
                </div>
                <div class="table-responsive table-custom">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th class="py-3 px-4" width="60">No</th>
                                <th class="py-3 px-4">Nama Anggota</th>
                                <th class="py-3 px-4">Tempat, Tgl Lahir</th>
                                <th class="py-3 px-4">Alamat / RT</th>
                                <th class="py-3 px-4">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $linmas = [
                                    ['name' => 'Sumarno Maryono', 'ttl' => 'Solo, 18-08-1960', 'alamat' => 'Jl. Fatmawati RT.10'],
                                    ['name' => 'Endri Etansuadi', 'ttl' => 'M.Kalangan, 17-8-1978', 'alamat' => 'Jl. Putri Gd Cempaka RT.03'],
                                    ['name' => 'Aris Setiono', 'ttl' => 'Bengkulu, 14-03-1985', 'alamat' => 'Jl. Sukajadi RT.07'],
                                    ['name' => 'Syaparuddin', 'ttl' => 'Bengkulu, 10-01-1980', 'alamat' => 'Jl. Putri Gd Cempaka RT.04'],
                                    ['name' => 'Miki Saputra', 'ttl' => 'Bengkulu, 14-03-1986', 'alamat' => 'Jl. Putri Gd Cempaka RT.14'],
                                    ['name' => 'Ripan Mardeni', 'ttl' => 'Bengkulu, 01-03-1977', 'alamat' => 'Jl. Putri Gd Cempaka RT.02'],
                                    ['name' => 'David Chasidi', 'ttl' => 'Padang, 28-08-1985', 'alamat' => 'Jl. Fatmawati RT.10'],
                                    ['name' => 'Verro Prayuda Mareta P', 'ttl' => 'Bengkulu, 04-03-1994', 'alamat' => 'Jl. Dek Sangke RT.15'],
                                    ['name' => 'Afizal', 'ttl' => 'Bengkulu, 22-6-1977', 'alamat' => 'Jl. Putri Gd Cempaka RT.17'],
                                    ['name' => 'Zulyadaini', 'ttl' => 'Bengkulu, 04-11-1980', 'alamat' => 'Jl. Putri Gd Cempaka RT.18'],
                                    ['name' => 'Rudolpo Manullang', 'ttl' => 'Medan, 20-11-1993', 'alamat' => 'Jl. Ratu Agung RT.08'],
                                ];
                            @endphp
                            @foreach($linmas as $index => $item)
                                <tr>
                                    <td class="px-4 fw-bold">{{ $index + 1 }}</td>
                                    <td class="px-4 fw-bold text-dark">{{ $item['name'] }}</td>
                                    <td class="px-4">{{ $item['ttl'] }}</td>
                                    <td class="px-4"><small>{{ $item['alamat'] }}</small></td>
                                    <td class="px-4"><span class="badge bg-success">Aktif</span></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- SECTION 4: RT & RW -->
        <div class="tab-pane fade" id="rtrw" role="tabpanel">
            <div class="container py-4">
                <div class="text-center mb-5">
                    <h3 class="fw-bold" style="color: #1b2b55;">Data Ketua RT & RW</h3>
                    <p class="text-muted">Kelurahan Penurunan, Kecamatan Ratu Samban</p>
                </div>

                <div class="row g-4">
                    @php
                        $rtrwData = [
                            [
                                'rw' => '01',
                                'ketua' => 'SUHARYADI',
                                'rt' => [
                                    '01' => 'Mulyadi',
                                    '02' => 'Anwarul Wahid',
                                    '03' => 'Apriana',
                                    '14' => 'Muklis',
                                    '15' => 'Rusmeiyudi',
                                ],
                            ],
                            [
                                'rw' => '02',
                                'ketua' => 'JUNAIDI',
                                'rt' => [
                                    '04' => 'Yenny. O',
                                    '05' => 'Lusi Noviani',
                                    '06' => 'Adria Putra',
                                    '17' => 'Muklis',
                                    '18' => 'Iskandar Zulkarnain',
                                ],
                            ],
                            [
                                'rw' => '03',
                                'ketua' => 'EDI ALIANSI',
                                'rt' => [
                                    '07' => 'Irwanto',
                                    '08' => 'Antonius Silaen',
                                    '09' => 'Khairil Anwar',
                                ],
                            ],
                            [
                                'rw' => '04',
                                'ketua' => 'ZARIPUDIN',
                                'rt' => [
                                    '10' => 'Iskandar. Z',
                                    '11' => 'Norman Bakti',
                                    '12' => 'Sumiyati',
                                    '13' => 'Insan Gunawan',
                                    '16' => 'Saparudin',
                                ],
                            ],
                        ];
                    @endphp

                    @foreach ($rtrwData as $rw)
                        <div class="col-lg-6">
                            <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-4 h-100">
                                <div
                                    class="card-header bg-light p-3 d-flex justify-content-between align-items-center border-bottom">
                                    <h5 class="mb-0 text-dark fw-bold">Ketua RW {{ $rw['rw'] }}</h5>
                                    <span class="text-dark fw-bold" style="font-size: 1rem;">
                                        {{ $rw['ketua'] }}
                                    </span>
                                </div>
                                <div class="card-body p-0">
                                    <table class="table table-striped mb-0">
                                        <tbody>
                                            @foreach ($rw['rt'] as $no_rt => $nama_rt)
                                                <tr>
                                                    <td class="ps-4" width="120">RT {{ $no_rt }}</td>
                                                    <td class="fw-bold">{{ $nama_rt }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- SECTION 5: RAJO PENGHULU -->
        <div class="tab-pane fade" id="penghulu" role="tabpanel">
            <div class="container py-4">
                <div class="text-center mb-5">
                    <h3 class="fw-bold" style="color: #1b2b55;">RAJO PENGHULU</h3>
                    <p class="text-muted">Kelurahan Penurunan, Kecamatan Ratu Samban Kota Bengkulu</p>
                </div>

                <div class="row g-4">
                    <!-- Penghulu Adat -->
                    <div class="col-lg-6">
                        <div class="card border-0 shadow-sm rounded-4 overflow-hidden h-100">
                            <div class="card-header text-white p-3 text-center" style="background-color: #1b2b55;">
                                <h5 class="mb-0 fw-bold text-white">PENGHULU ADAT</h5>
                            </div>
                            <div class="card-body p-0">
                                <table class="table table-striped table-hover mb-0">
                                    <thead class="bg-light">
                                        <tr>
                                            <th width="50" class="text-center">No</th>
                                            <th>Nama</th>
                                            <th>Keterangan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="text-center">1</td>
                                            <td class="fw-bold text-dark">HASYIM BAKSUM</td>
                                            <td>KETUA</td>
                                        </tr>
                                        <tr>
                                            <td class="text-center">2</td>
                                            <td class="fw-bold text-dark">RIZKAN KANAIDI</td>
                                            <td>ANGGOTA</td>
                                        </tr>
                                        <tr>
                                            <td class="text-center">3</td>
                                            <td class="fw-bold text-dark">YAMHULLAH</td>
                                            <td>ANGGOTA</td>
                                        </tr>
                                        <tr>
                                            <td class="text-center">4</td>
                                            <td class="fw-bold text-dark">JONI. H</td>
                                            <td>ANGGOTA</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Penghulu Sara' -->
                    <div class="col-lg-6">
                        <div class="card border-0 shadow-sm rounded-4 overflow-hidden h-100">
                            <div class="card-header text-white p-3 text-center" style="background-color: #50a7c2;">
                                <h5 class="mb-0 fw-bold text-white">PENGHULU SARA</h5>
                            </div>
                            <div class="card-body p-0">
                                <table class="table table-striped table-hover mb-0">
                                    <thead class="bg-light">
                                        <tr>
                                            <th width="50" class="text-center">No</th>
                                            <th>Nama</th>
                                            <th>Keterangan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="text-center">1</td>
                                            <td class="fw-bold text-dark">ARIZAL ZAINUDIN</td>
                                            <td>IMAM</td>
                                        </tr>
                                        <tr>
                                            <td class="text-center">2</td>
                                            <td class="fw-bold text-dark">YAMHULLAH</td>
                                            <td>KHATIB</td>
                                        </tr>
                                        <tr>
                                            <td class="text-center">3</td>
                                            <td class="fw-bold text-dark">ARIFIN</td>
                                            <td>BILAL</td>
                                        </tr>
                                        <tr>
                                            <td class="text-center">4</td>
                                            <td class="fw-bold text-dark">SAINUL BAHRI. L</td>
                                            <td>GHARIM</td>
                                        </tr>
                                        <tr>
                                            <td class="text-center">5</td>
                                            <td class="fw-bold text-dark">WASNERI</td>
                                            <td>RUBIAH</td>
                                        </tr>
                                        <tr>
                                            <td class="text-center">6</td>
                                            <td class="fw-bold text-dark">RATNAWATI</td>
                                            <td>RUBIAH</td>
                                        </tr>
                                        <tr>
                                            <td class="text-center">7</td>
                                            <td class="fw-bold text-dark">ADE SAHIDIN</td>
                                            <td>DA'I</td>
                                        </tr>
                                        <tr>
                                            <td class="text-center">8</td>
                                            <td class="fw-bold text-dark">SURYANI</td>
                                            <td>DA'I</td>
                                        </tr>
                                        <tr>
                                            <td class="text-center">9</td>
                                            <td class="fw-bold text-dark">DIANA PILIANG SARI</td>
                                            <td>GURU NGAJI</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection