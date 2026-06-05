@extends('layouts.panel')

@section('content')
<style>
    .card-hover {
        transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
        border: none;
        border-radius: 12px;
        overflow: hidden;
        position: relative;
        text-decoration: none !important;
        display: block;
    }
    .card-hover:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.15) !important;
    }
    .card-hover .icon-big {
        font-size: 2.5rem;
        opacity: 0.8;
        transition: all 0.3s;
    }
    .card-hover:hover .icon-big {
        transform: scale(1.1) rotate(5deg);
        opacity: 1;
    }
    .pulse-indicator {
        display: inline-block;
        width: 10px;
        height: 10px;
        background-color: #28a745;
        border-radius: 50%;
        margin-right: 8px;
        box-shadow: 0 0 0 rgba(40, 167, 69, 0.4);
        animation: pulse 2s infinite;
    }
    @keyframes pulse {
        0% { box-shadow: 0 0 0 0 rgba(40, 167, 69, 0.7); }
        70% { box-shadow: 0 0 0 10px rgba(40, 167, 69, 0); }
        100% { box-shadow: 0 0 0 0 rgba(40, 167, 69, 0); }
    }
    .stats-card-highlight {
        background: radial-gradient(circle at top right, rgba(255,255,255,0.2) 0%, rgba(255,255,255,0) 60%);
    }
</style>

<div class="container">
    <div class="page-inner">
        {{-- HEADER --}}
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 p-3 bg-white shadow-sm rounded-3 border-start border-5 border-primary">
            <div class="mb-2 mb-md-0">
                <h3 class="fw-bold mb-1 text-dark"><i class="fas fa-home text-primary me-2"></i>Dashboard Utama</h3>
                <p class="text-muted mb-0">
                    Selamat datang kembali, <span class="fw-bold text-primary">{{ $user->name }}</span> ({{ $user->role }})
                </p>
            </div>
        </div>

        {{-- STATISTIK UTAMA --}}
        <div class="row custom-cards mb-4 g-3">
            @if (auth()->user()->role != 'Warga')
                <div class="col-sm-6 col-md-3 mt-0">
                    <a href="{{ url('panel/warga') }}" class="card card-hover shadow h-100" style="background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);">
                        <div class="card-body p-3 text-white stats-card-highlight d-flex flex-column justify-content-center">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <p class="mb-1 text-white-50 fw-bold small text-uppercase tracking-wide">Total Pengguna</p>
                                    <h3 class="fw-bold mb-0" id="count-pengguna">{{ $total_user }}</h3>
                                </div>
                                <div class="icon-big text-white">
                                    <i class="fas fa-users"></i>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @endif

            <div class="col-sm-6 col-md-3 mt-0">
                <a href="{{ url('panel/suratmasuk') }}" class="card card-hover shadow h-100" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                    <div class="card-body p-3 text-white stats-card-highlight d-flex flex-column justify-content-center">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <p class="mb-1 text-white-50 fw-bold small text-uppercase tracking-wide">Total Surat</p>
                                <h3 class="fw-bold mb-0" id="count-surat">{{ $total_surat }}</h3>
                            </div>
                            <div class="icon-big text-white">
                                <i class="fas fa-envelope-open-text"></i>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="col-sm-6 col-md-2 mt-0">
                <a href="{{ url('panel/suratmasuk') }}" class="card card-hover shadow h-100" style="background: linear-gradient(135deg, #f6d365 0%, #fda085 100%);">
                    <div class="card-body p-3 text-white text-center d-flex flex-column justify-content-center align-items-center stats-card-highlight">
                        <i class="fas fa-hourglass-half mb-2 icon-big"></i>
                        <p class="mb-0 text-white-50 fw-bold small tracking-wide">PENDING</p>
                        <h4 class="fw-bold mb-0" id="count-pending">{{ $pending }}</h4>
                    </div>
                </a>
            </div>

            <div class="col-sm-6 col-md-2 mt-0">
                <a href="{{ url('panel/suratmasuk') }}" class="card card-hover shadow h-100" style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);">
                    <div class="card-body p-3 text-white text-center d-flex flex-column justify-content-center align-items-center stats-card-highlight">
                        <i class="fas fa-check-circle mb-2 icon-big"></i>
                        <p class="mb-0 text-white-50 fw-bold small tracking-wide">DITERIMA</p>
                        <h4 class="fw-bold mb-0" id="count-diterima">{{ $diterima }}</h4>
                    </div>
                </a>
            </div>

            <div class="col-sm-6 col-md-2 mt-0">
                <a href="{{ url('panel/suratmasuk') }}" class="card card-hover shadow h-100" style="background: linear-gradient(135deg, #ff0844 0%, #ffb199 100%);">
                    <div class="card-body p-3 text-white text-center d-flex flex-column justify-content-center align-items-center stats-card-highlight">
                        <i class="fas fa-times-circle mb-2 icon-big"></i>
                        <p class="mb-0 text-white-50 fw-bold small tracking-wide">DITOLAK</p>
                        <h4 class="fw-bold mb-0" id="count-ditolak">{{ $ditolak }}</h4>
                    </div>
                </a>
            </div>
        </div>

        {{-- PER JENIS SURAT --}}
        <div class="row g-3 mb-4">
            <div class="col-md-12">
                <div class="d-flex align-items-center mb-1">
                    <div class="bg-primary bg-opacity-10 text-primary p-2 rounded-circle me-2 d-flex justify-content-center align-items-center" style="width: 35px; height: 35px;">
                        <i class="fas fa-chart-pie"></i>
                    </div>
                    <h5 class="fw-bold mb-0">Statistik Jenis Surat</h5>
                </div>
            </div>
            
            <div class="col-md-3 col-sm-6">
                <a href="{{ url('panel/suratmasuk') }}" class="card card-hover shadow-sm border-0 border-bottom border-primary border-4 text-decoration-none">
                    <div class="card-body text-center p-4" style="background-color: #f8f9fa;">
                        <div class="rounded-circle bg-primary bg-opacity-10 text-primary p-3 d-inline-block mb-3">
                            <i class="fas fa-file-invoice-dollar fa-2x"></i>
                        </div>
                        <h2 class="fw-bold text-dark mb-1" id="count-sktm">{{ $total_sktm }}</h2>
                        <div class="text-muted fw-semibold">SKTM</div>
                    </div>
                </a>
            </div>

            <div class="col-md-3 col-sm-6">
                <a href="{{ url('panel/suratmasuk') }}" class="card card-hover shadow-sm border-0 border-bottom border-success border-4 text-decoration-none">
                    <div class="card-body text-center p-4" style="background-color: #f8f9fa;">
                        <div class="rounded-circle bg-success bg-opacity-10 text-success p-3 d-inline-block mb-3">
                            <i class="fas fa-store-alt fa-2x"></i>
                        </div>
                        <h2 class="fw-bold text-dark mb-1" id="count-sku">{{ $total_sku }}</h2>
                        <div class="text-muted fw-semibold">SKU</div>
                    </div>
                </a>
            </div>

            <div class="col-md-3 col-sm-6">
                <a href="{{ url('panel/suratmasuk') }}" class="card card-hover shadow-sm border-0 border-bottom border-warning border-4 text-decoration-none">
                    <div class="card-body text-center p-4" style="background-color: #f8f9fa;">
                        <div class="rounded-circle bg-warning bg-opacity-10 text-warning p-3 d-inline-block mb-3">
                            <i class="fas fa-handshake fa-2x"></i>
                        </div>
                        <h2 class="fw-bold text-dark mb-1" id="count-rekomendasi">{{ $total_rekomendasi }}</h2>
                        <div class="text-muted fw-semibold">Rekomendasi</div>
                    </div>
                </a>
            </div>

            <div class="col-md-3 col-sm-6">
                <a href="{{ url('panel/suratmasuk') }}" class="card card-hover shadow-sm border-0 border-bottom border-danger border-4 text-decoration-none">
                    <div class="card-body text-center p-4" style="background-color: #f8f9fa;">
                        <div class="rounded-circle bg-danger bg-opacity-10 text-danger p-3 d-inline-block mb-3">
                            <i class="fas fa-venus-mars fa-2x"></i>
                        </div>
                        <h2 class="fw-bold text-dark mb-1" id="count-nikah">{{ $total_nikah }}</h2>
                        <div class="text-muted fw-semibold">Surat Nikah</div>
                    </div>
                </a>
            </div>
        </div>

        <div class="row g-4 mb-4">
            {{-- CHART STATUS --}}
            <div class="col-md-6">
                <div class="card shadow-sm border-0 rounded-3 h-100">
                    <div class="card-header bg-white border-bottom-0 pt-4 pb-0 px-4">
                        <h5 class="fw-bold text-dark mb-0"><i class="fas fa-chart-line text-muted me-2"></i>Persentase Status</h5>
                    </div>
                    <div class="card-body p-4 d-flex justify-content-center align-items-center">
                        <div style="height: 280px; width: 100%; position: relative;">
                            <canvas id="chartStatus"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            {{-- CHART JENIS --}}
            <div class="col-md-6">
                <div class="card shadow-sm border-0 rounded-3 h-100">
                    <div class="card-header bg-white border-bottom-0 pt-4 pb-0 px-4">
                        <h5 class="fw-bold text-dark mb-0"><i class="fas fa-chart-bar text-muted me-2"></i>Grafik Pengajuan</h5>
                    </div>
                    <div class="card-body p-4 d-flex justify-content-center align-items-center">
                        <div style="height: 280px; width: 100%; position: relative;">
                            <canvas id="chartJenis"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection

@section('script')
<script>
    // DATA DARI LARAVEL
    let pending = {{ $pending }};
    let diterima = {{ $diterima }};
    let ditolak = {{ $ditolak }};

    let sktm = {{ $total_sktm }};
    let sku = {{ $total_sku }};
    let rekomendasi = {{ $total_rekomendasi }};
    let nikah = {{ $total_nikah }};

    // PIE CHART CONFIGURATION (Sesuai setingan original template)
    const ctxStatus = document.getElementById('chartStatus').getContext('2d');
    let chartStatus = new Chart(ctxStatus, {
        type: 'pie',
        data: {
            labels: ['Pending', 'Diterima', 'Ditolak'],
            datasets: [{
                data: [pending, diterima, ditolak],
                backgroundColor: ['#ffc107', '#198754', '#dc3545']
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false
        }
    });

    // BAR CHART CONFIGURATION (Sesuai setingan original template)
    const ctxJenis = document.getElementById('chartJenis').getContext('2d');
    let chartJenis = new Chart(ctxJenis, {
        type: 'bar',
        data: {
            labels: ['SKTM', 'SKU', 'Rekomendasi', 'Nikah'],
            datasets: [{
                label: 'Jumlah Surat',
                data: [sktm, sku, rekomendasi, nikah],
                backgroundColor: '#0d6efd'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                }
            }
        }
    });

    // POLLING REAL-TIME (UPDATE DOM + CHART)
    setInterval(() => {
        fetch(window.location.href)
            .then(res => res.text())
            .then(html => {
                const doc = new DOMParser().parseFromString(html, 'text/html');
                
                // Update DOM Values if exists
                if(document.getElementById('count-pengguna') && doc.getElementById('count-pengguna')) {
                    document.getElementById('count-pengguna').innerText = doc.getElementById('count-pengguna').innerText;
                }
                
                const updateValue = (id) => {
                    if(document.getElementById(id) && doc.getElementById(id)) {
                        document.getElementById(id).innerText = doc.getElementById(id).innerText;
                        return parseInt(doc.getElementById(id).innerText);
                    }
                    return 0;
                };

                const newPending = updateValue('count-pending');
                const newDiterima = updateValue('count-diterima');
                const newDitolak = updateValue('count-ditolak');
                
                updateValue('count-surat'); // trigger dom update
                
                const newSktm = updateValue('count-sktm');
                const newSku = updateValue('count-sku');
                const newRekomendasi = updateValue('count-rekomendasi');
                const newNikah = updateValue('count-nikah');

                // Checks if data is changed to animate smoothly
                const hasStatusDataChanged = chartStatus.data.datasets[0].data[0] !== newPending || 
                                       chartStatus.data.datasets[0].data[1] !== newDiterima || 
                                       chartStatus.data.datasets[0].data[2] !== newDitolak;

                const hasJenisDataChanged = chartJenis.data.datasets[0].data[0] !== newSktm || 
                                       chartJenis.data.datasets[0].data[1] !== newSku || 
                                       chartJenis.data.datasets[0].data[2] !== newRekomendasi || 
                                       chartJenis.data.datasets[0].data[3] !== newNikah;

                if (hasStatusDataChanged) {
                    chartStatus.data.datasets[0].data = [newPending, newDiterima, newDitolak];
                    chartStatus.update();
                }

                if (hasJenisDataChanged) {
                    chartJenis.data.datasets[0].data = [newSktm, newSku, newRekomendasi, newNikah];
                    chartJenis.update();
                }

            })
            .catch(error => console.warn("Background sync paused/failed."));
    }, 5000); // 5 Detik Polling untuk efek "Real-Time"

</script>
@endsection
