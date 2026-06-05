@extends('layouts.panel')

@section('content')
    <div class="container">
        <div class="page-inner">

            <div class="card shadow-lg border-0 rounded-4">

                {{-- HEADER --}}
                <div
                    class="card-header bg-primary text-white d-flex justify-content-between align-items-center rounded-top-4">
                    <h5 class="mb-0">
                        <i class="fa fa-envelope-open-text me-2"></i>Detail Surat
                    </h5>

                    <div class="d-flex gap-2">

                        {{-- BUTTON CETAK --}}
                        @if ($surat->status == 'Diterima' && auth()->user()->role != 'Warga')
                            @php
                                $urlCetak = '';
                                if ($surat->jenis == 'SKTM') {
                                    $urlCetak = url('panel/sktmcetak/' . $surat->id);
                                } elseif ($surat->jenis == 'SKU') {
                                    $urlCetak = url('panel/skucetak/' . $surat->id);
                                } elseif ($surat->jenis == 'Rekomendasi') {
                                    $urlCetak = url('panel/rekomendasicetak/' . $surat->id);
                                } elseif ($surat->jenis == 'Nikah') {
                                    $urlCetak = url('panel/nikahcetak/' . $surat->id);
                                }
                            @endphp

                            <a href="{{ $urlCetak }}" target="_blank" class="btn btn-light btn-sm">
                                <i class="fa fa-print"></i> Cetak
                            </a>
                        @endif

                        @if (auth()->user()->role == 'Lurah')
                            {{-- UPDATE STATUS --}}
                            <form action="{{ url('panel/suratupdatestatus/' . $surat->id) }}" method="POST"
                                class="d-flex gap-2">
                                @csrf
                                @method('PUT')

                                <select name="status" class="form-select form-select-sm" style="width: 120px;">
                                    <option value="Pending" {{ $surat->status == 'Pending' ? 'selected' : '' }}>Pending
                                    </option>
                                    <option value="Diterima" {{ $surat->status == 'Diterima' ? 'selected' : '' }}>Diterima
                                    </option>
                                    <option value="Ditolak" {{ $surat->status == 'Ditolak' ? 'selected' : '' }}>Ditolak
                                    </option>
                                </select>

                                <select name="ttd_oleh" class="form-select form-select-sm" style="width: 180px;">
                                    <option value="Lurah" {{ $surat->ttd_oleh == 'Lurah' ? 'selected' : '' }}>Lurah</option>
                                    <option value="Kasi Pemerintahan" {{ $surat->ttd_oleh == 'Kasi Pemerintahan' ? 'selected' : '' }}>Kasi Pemerintahan / Trantib</option>
                                    <option value="Kasi Pembangunan" {{ $surat->ttd_oleh == 'Kasi Pembangunan' ? 'selected' : '' }}>Kasi Pembangunan</option>
                                    <option value="Kasi Pelayanan" {{ $surat->ttd_oleh == 'Kasi Pelayanan' ? 'selected' : '' }}>Kasi Pelayanan Umum</option>
                                </select>

                                <button class="btn btn-light btn-sm">
                                    <i class="fa fa-save"></i>
                                </button>
                            </form>
                        @endif

                    </div>
                </div>

                <div class="card-body p-4">

                    {{-- INFO UTAMA --}}
                    <div class="row g-3 mb-4">

                        <div class="col-md-3">
                            <div class="border rounded-3 p-3 h-100">
                                <small class="text-muted">Jenis Surat</small>
                                <div class="fw-semibold">{{ $surat->jenis }}</div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="border rounded-3 p-3 h-100">
                                <small class="text-muted">Nama</small>
                                <div class="fw-semibold">{{ $surat->nama }}</div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="border rounded-3 p-3 h-100">
                                <small class="text-muted">Warga</small>
                                <div class="fw-semibold">{{ $surat->user->name ?? '-' }}</div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="border rounded-3 p-3 h-100 text-center">
                                <small class="text-muted">Status</small><br>

                                @if ($surat->status == 'Pending')
                                    <span class="badge bg-warning text-dark px-3 py-2">Pending</span>
                                @elseif($surat->status == 'Diterima')
                                    <span class="badge bg-success px-3 py-2">Diterima</span>
                                @else
                                    <span class="badge bg-danger px-3 py-2">Ditolak</span>
                                @endif

                            </div>
                        </div>

                    </div>

                    {{-- DETAIL --}}
                    <div class="border rounded-4 p-4 bg-light">

                        <h6 class="mb-3">
                            <i class="fa fa-info-circle me-1"></i>Detail Informasi
                        </h6>

                        @if($surat->kebutuhan)
                            <div class="mb-4 p-3 border rounded shadow-sm bg-white border-start border-primary border-4">
                                <h6 class="fw-bold text-primary mb-1">Kebutuhan / Tujuan Pengajuan:</h6>
                                <p class="mb-0 text-dark">{{ $surat->kebutuhan }}</p>
                            </div>
                        @endif

                        <div class="mb-4 p-3 border rounded shadow-sm bg-white border-start border-success border-4">
                            <h6 class="fw-bold text-success mb-1">Berkas Diantar Ke Kantor?</h6>
                            <p class="mb-0 text-dark">
                                @if ($surat->dibawa_ke_kantor == 'Ya')
                                    <span class="badge bg-success">Ya, Berkas akan diantar langsung ke kantor</span>
                                @else
                                    <span class="badge bg-secondary">Tidak / Melalui Upload Saja</span>
                                @endif
                            </p>
                        </div>

                        <div class="row g-3">

                            {{-- SKTM --}}
                            @if ($surat->jenis == 'SKTM')
                                <div class="row g-3">

                                    {{-- DATA PRIBADI --}}
                                    <div class="col-12">
                                        <h6 class="fw-bold text-primary border-bottom pb-2 mb-2">Data Pribadi</h6>
                                    </div>

                                    <div class="col-md-4">
                                        <small class="text-muted">NIK</small>
                                        <div class="fw-semibold">{{ $surat->nik }}</div>
                                    </div>

                                    <div class="col-md-4">
                                        <small class="text-muted">Jenis Kelamin</small>
                                        <div class="fw-semibold">{{ $surat->jeniskelamin }}</div>
                                    </div>

                                    <div class="col-md-4">
                                        <small class="text-muted">Tempat Lahir</small>
                                        <div class="fw-semibold">{{ $surat->tempatlahir }}</div>
                                    </div>

                                    <div class="col-md-4">
                                        <small class="text-muted">Tanggal Lahir</small>
                                        <div class="fw-semibold">
                                            {{ date('d M Y', strtotime($surat->tanggallahir)) }}
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <small class="text-muted">Agama</small>
                                        <div class="fw-semibold">{{ $surat->agama }}</div>
                                    </div>

                                    <div class="col-md-4">
                                        <small class="text-muted">Pekerjaan</small>
                                        <div class="fw-semibold">{{ $surat->pekerjaan }}</div>
                                    </div>

                                    <div class="col-md-4">
                                        <small class="text-muted">Status Perkawinan</small>
                                        <div class="fw-semibold">{{ $surat->statusperkawinan }}</div>
                                    </div>

                                    <div class="col-12">
                                        <small class="text-muted">Alamat</small>
                                        <div class="fw-semibold">{{ $surat->alamat }}</div>
                                    </div>

                                    <div class="col-12 mt-4">
                                        <div class="card shadow-sm border-0">
                                            <div class="card-header bg-primary text-white">
                                                <h6 class="mb-0 fw-bold">Dokumen</h6>
                                            </div>

                                            <div class="card-body">
                                                <div class="row g-3">

                                                    @php
                                                        $docs = [
                                                            [
                                                                'label' => 'Surat Pengantar RT/RW',
                                                                'file' => $surat->suratpengantar,
                                                                'path' => 'suratpengantar',
                                                            ],
                                                            ['label' => 'KTP', 'file' => $surat->ktp, 'path' => 'ktp'],
                                                            ['label' => 'KK', 'file' => $surat->kk, 'path' => 'kk'],
                                                            [
                                                                'label' => 'Surat Pernyataan Tidak Mampu',
                                                                'file' => $surat->suratpernyataan,
                                                                'path' => 'suratpernyataan',
                                                            ],
                                                            [
                                                                'label' => 'Foto Rumah',
                                                                'file' => $surat->foto,
                                                                'path' => 'foto',
                                                            ],
                                                        ];
                                                    @endphp

                                                    @foreach ($docs as $doc)
                                                        <div class="col-md-6">
                                                            <div
                                                                class="border rounded p-3 h-100 d-flex justify-content-between align-items-center">

                                                                <div>
                                                                    <small
                                                                        class="text-muted d-block">{{ $doc['label'] }}</small>
                                                                    <span class="fw-semibold text-dark">
                                                                        {{ $doc['file'] ? 'Tersedia' : 'Tidak ada' }}
                                                                    </span>
                                                                </div>

                                                                @if ($doc['file'])
                                                                    <a href="{{ url('berkas/' . $doc['path'] . '/' . $doc['file']) }}"
                                                                        target="_blank" class="btn btn-sm btn-primary">
                                                                        <i class="fas fa-download"></i>
                                                                    </a>
                                                                @else
                                                                    <button class="btn btn-sm btn-secondary" disabled>
                                                                        <i class="fas fa-times-circle"></i>
                                                                    </button>
                                                                @endif

                                                            </div>
                                                        </div>
                                                    @endforeach

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            @endif

                            {{-- SKU --}}
                            @if ($surat->jenis == 'SKU')
                                <div class="col-md-4"><small class="text-muted">NIK</small>
                                    <div class="fw-semibold">{{ $surat->nik }}</div>
                                </div>
                                <div class="col-md-4"><small class="text-muted">Jenis Kelamin</small>
                                    <div class="fw-semibold">{{ $surat->jeniskelamin }}</div>
                                </div>
                                <div class="col-md-4"><small class="text-muted">Tempat Lahir</small>
                                    <div class="fw-semibold">{{ $surat->tempatlahir }}</div>
                                </div>

                                <div class="col-md-4"><small class="text-muted">Tanggal Lahir</small>
                                    <div class="fw-semibold">{{ $surat->tanggallahir }}</div>
                                </div>
                                <div class="col-md-4"><small class="text-muted">Agama</small>
                                    <div class="fw-semibold">{{ $surat->agama }}</div>
                                </div>
                                <div class="col-md-4"><small class="text-muted">Pekerjaan</small>
                                    <div class="fw-semibold">{{ $surat->pekerjaan }}</div>
                                </div>

                                <div class="col-md-12"><small class="text-muted">Alamat</small>
                                    <div class="fw-semibold">{{ $surat->alamat }}</div>
                                </div>

                                <div class="col-md-12"><small class="text-muted">Nama Usaha</small>
                                    <div class="fw-semibold">{{ $surat->namausaha }}</div>
                                </div>

                                <div class="col-md-12"><small class="text-muted">Lokasi Usaha</small>
                                    <div class="fw-semibold">{{ $surat->lokasiusaha }}</div>
                                </div>

                                <div class="col-md-4"><small class="text-muted">Mulai Berlaku (Surat Diterbitkan)</small>
                                    <div class="fw-semibold">{{ $surat->masaberlakuawal ? date('d M Y', strtotime($surat->masaberlakuawal)) : '-' }}</div>
                                </div>

                                <div class="col-md-4"><small class="text-muted">Batas Masa Izin Usaha Habis</small>
                                    <div class="fw-semibold">{{ $surat->masaberlakusampai ? date('d M Y', strtotime($surat->masaberlakusampai)) : '-' }}</div>
                                </div>

                                <div class="col-md-4"><small class="text-muted">Pajak Bumi Bangunan (PBB)</small>
                                    <div>
                                        @if($surat->pbb_lunas == 'Ya')
                                            <span class="badge bg-success"><i class="fa fa-check me-1"></i>Sudah Lunas</span>
                                        @else
                                            <span class="badge bg-danger"><i class="fa fa-times me-1"></i>Belum Lunas</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-12 mt-4">
                                    <div class="card shadow-sm border-0">
                                        <div class="card-header bg-primary text-white">
                                            <h6 class="mb-0 fw-bold">Dokumen</h6>
                                        </div>

                                        <div class="card-body">
                                            <div class="row g-3">

                                                @php
                                                    $docs = [
                                                        [
                                                            'label' => 'Surat Pengantar RT/RW',
                                                            'file' => $surat->suratpengantar,
                                                            'path' => 'suratpengantar',
                                                        ],
                                                        ['label' => 'KTP', 'file' => $surat->ktp, 'path' => 'ktp'],
                                                        ['label' => 'KK', 'file' => $surat->kk, 'path' => 'kk'],
                                                        [
                                                            'label' => 'Surat Permohonan',
                                                            'file' => $surat->suratpermohonan,
                                                            'path' => 'suratpermohonan',
                                                        ],
                                                        [
                                                            'label' => 'Foto Tempat Usaha',
                                                            'file' => $surat->foto,
                                                            'path' => 'foto',
                                                        ],
                                                    ];
                                                @endphp

                                                @foreach ($docs as $doc)
                                                    <div class="col-md-6">
                                                        <div
                                                            class="border rounded p-3 h-100 d-flex justify-content-between align-items-center">

                                                            <div>
                                                                <small
                                                                    class="text-muted d-block">{{ $doc['label'] }}</small>
                                                                <span class="fw-semibold text-dark">
                                                                    {{ $doc['file'] ? 'Tersedia' : 'Tidak ada' }}
                                                                </span>
                                                            </div>

                                                            @if ($doc['file'])
                                                                <a href="{{ url('berkas/' . $doc['path'] . '/' . $doc['file']) }}"
                                                                    target="_blank" class="btn btn-sm btn-primary">
                                                                    <i class="fas fa-download"></i>
                                                                </a>
                                                            @else
                                                                <button class="btn btn-sm btn-secondary" disabled>
                                                                    <i class="fas fa-times-circle"></i>
                                                                </button>
                                                            @endif

                                                        </div>
                                                    </div>
                                                @endforeach

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            {{-- REKOMENDASI --}}
                            @if ($surat->jenis == 'Rekomendasi')
                                <div class="col-md-4"><small class="text-muted">Jabatan</small>
                                    <div class="fw-semibold">{{ $surat->jabatan }}</div>
                                </div>
                                <div class="col-md-4"><small class="text-muted">Nama Usaha</small>
                                    <div class="fw-semibold">{{ $surat->namausaha }}</div>
                                </div>
                                <div class="col-md-4"><small class="text-muted">NIB</small>
                                    <div class="fw-semibold">{{ $surat->nib }}</div>
                                </div>

                                <div class="col-md-4"><small class="text-muted">NPWP</small>
                                    <div class="fw-semibold">{{ $surat->npwp }}</div>
                                </div>
                                <div class="col-md-12"><small class="text-muted">Alamat Perusahaan</small>
                                    <div class="fw-semibold">{{ $surat->alamatperusahaan }}</div>
                                </div>

                                <div class="col-md-4"><small class="text-muted">No Telp</small>
                                    <div class="fw-semibold">{{ $surat->notelpon }}</div>
                                </div>
                                <div class="col-md-4"><small class="text-muted">Email</small>
                                    <div class="fw-semibold">{{ $surat->email }}</div>
                                </div>
                                <div class="col-md-4"><small class="text-muted">KBLI</small>
                                    <div class="fw-semibold">{{ $surat->kodekbli }}</div>
                                </div>

                                <div class="col-md-12"><small class="text-muted">Lokasi Usaha</small>
                                    <div class="fw-semibold">{{ $surat->lokasiusaha }}</div>
                                </div>

                                <div class="col-12 mt-4">
                                    <div class="card shadow-sm border-0">
                                        <div class="card-header bg-primary text-white">
                                            <h6 class="mb-0 fw-bold">Dokumen</h6>
                                        </div>

                                        <div class="card-body">
                                            <div class="row g-3">

                                                @php
                                                    $docs = [
                                                        [
                                                            'label' => 'Surat Pengantar RT/RW',
                                                            'file' => $surat->suratpengantar,
                                                            'path' => 'suratpengantar',
                                                        ],
                                                        ['label' => 'KTP', 'file' => $surat->ktp, 'path' => 'ktp'],
                                                        ['label' => 'KK', 'file' => $surat->kk, 'path' => 'kk'],
                                                        [
                                                            'label' => 'Surat Permohonan',
                                                            'file' => $surat->suratpermohonan,
                                                            'path' => 'suratpermohonan',
                                                        ],
                                                        [
                                                            'label' =>
                                                                'Surat Pernyataan Kesanggupan Mematuhi Protokol dan Menjaga Keamanan',
                                                            'file' => $surat->suratpernyataan,
                                                            'path' => 'suratpernyataan',
                                                        ],
                                                        [
                                                            'label' => 'Proposal Kegiatan',
                                                            'file' => $surat->proposalkegiatan,
                                                            'path' => 'proposalkegiatan',
                                                        ],
                                                    ];
                                                @endphp

                                                @foreach ($docs as $doc)
                                                    <div class="col-md-6">
                                                        <div
                                                            class="border rounded p-3 h-100 d-flex justify-content-between align-items-center">

                                                            <div>
                                                                <small
                                                                    class="text-muted d-block">{{ $doc['label'] }}</small>
                                                                <span class="fw-semibold text-dark">
                                                                    {{ $doc['file'] ? 'Tersedia' : 'Tidak ada' }}
                                                                </span>
                                                            </div>

                                                            @if ($doc['file'])
                                                                <a href="{{ url('berkas/' . $doc['path'] . '/' . $doc['file']) }}"
                                                                    target="_blank" class="btn btn-sm btn-primary">
                                                                    <i class="fas fa-download"></i>
                                                                </a>
                                                            @else
                                                                <button class="btn btn-sm btn-secondary" disabled>
                                                                    <i class="fas fa-times-circle"></i>
                                                                </button>
                                                            @endif

                                                        </div>
                                                    </div>
                                                @endforeach

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif



                            {{-- NIKAH --}}
                            {{-- Rekomendasi Nikah --}}
                            @if ($surat->jenis == 'Rekomendasi Nikah' || $surat->jenis == 'Nikah')
                                <div class="col-md-4"><small class="text-muted">NIK</small>
                                    <div class="fw-semibold">{{ $surat->nik }}</div>
                                </div>
                                <div class="col-md-4"><small class="text-muted">Jenis Kelamin</small>
                                    <div class="fw-semibold">{{ $surat->jeniskelamin }}</div>
                                </div>
                                <div class="col-md-4"><small class="text-muted">Tempat Lahir</small>
                                    <div class="fw-semibold">{{ $surat->tempatlahir }}</div>
                                </div>

                                <div class="col-md-4"><small class="text-muted">Tanggal Lahir</small>
                                    <div class="fw-semibold">{{ $surat->tanggallahir ? date('d M Y', strtotime($surat->tanggallahir)) : '-' }}</div>
                                </div>
                                <div class="col-md-4"><small class="text-muted">Agama</small>
                                    <div class="fw-semibold">{{ $surat->agama }}</div>
                                </div>
                                <div class="col-md-4"><small class="text-muted">Pekerjaan</small>
                                    <div class="fw-semibold">{{ $surat->pekerjaan }}</div>
                                </div>
                                <div class="col-md-4"><small class="text-muted">Status Perkawinan</small>
                                    <div class="fw-semibold">{{ $surat->statusperkawinan }}</div>
                                </div>

                                <div class="col-md-12"><small class="text-muted">Alamat</small>
                                    <div class="fw-semibold">{{ $surat->alamat }}</div>
                                </div>

                                <div class="col-12 mt-4">
                                    <div class="card shadow-sm border-0">
                                        <div class="card-header bg-primary text-white">
                                            <h6 class="mb-0 fw-bold">Dokumen</h6>
                                        </div>

                                        <div class="card-body">
                                            <div class="row g-3">

                                                @php
                                                    $docs = [
                                                        ['label' => 'Surat Pengantar RT/RW', 'file' => $surat->suratpengantar, 'path' => 'suratpengantar'],
                                                        ['label' => 'Formulir Kelurahan (N1, N2, N4)', 'file' => $surat->formulir_n1_n2_n4, 'path' => 'formulir_n1_n2_n4'],
                                                        ['label' => 'KTP Calon Pengantin', 'file' => $surat->ktp, 'path' => 'ktp'],
                                                        ['label' => 'KK Calon Pengantin', 'file' => $surat->kk, 'path' => 'kk'],
                                                        ['label' => 'KTP Pasangan', 'file' => $surat->ktp_pasangan, 'path' => 'ktp_pasangan'],
                                                        ['label' => 'Akta Kelahiran/Ijazah', 'file' => $surat->akta_ijazah, 'path' => 'akta_ijazah'],
                                                        ['label' => 'Pas Foto', 'file' => $surat->pas_foto, 'path' => 'pas_foto'],
                                                        ['label' => 'Surat Izin Orang Tua (N5)', 'file' => $surat->surat_izin_ortu, 'path' => 'surat_izin_ortu'],
                                                        ['label' => 'Akta Cerai / Kematian (N6)', 'file' => $surat->akta_cerai_kematian, 'path' => 'akta_cerai_kematian'],
                                                    ];
                                                @endphp

                                                @foreach ($docs as $doc)
                                                    <div class="col-md-6">
                                                        <div
                                                            class="border rounded p-3 h-100 d-flex justify-content-between align-items-center">

                                                            <div>
                                                                <small
                                                                    class="text-muted d-block">{{ $doc['label'] }}</small>
                                                                <span class="fw-semibold text-dark">
                                                                    {{ $doc['file'] ? 'Tersedia' : 'Tidak ada' }}
                                                                </span>
                                                            </div>

                                                            @if ($doc['file'])
                                                                <a href="{{ url('berkas/' . $doc['path'] . '/' . $doc['file']) }}"
                                                                    target="_blank" class="btn btn-sm btn-primary">
                                                                    <i class="fas fa-download"></i>
                                                                </a>
                                                            @else
                                                                <button class="btn btn-sm btn-secondary" disabled>
                                                                    <i class="fas fa-times-circle"></i>
                                                                </button>
                                                            @endif

                                                        </div>
                                                    </div>
                                                @endforeach

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif

                        </div>
                    </div>

                    {{-- <div class="text-end mt-4">
                        <a href="{{ url()->previous() }}" class="btn btn-secondary">
                            <i class="fa fa-arrow-left"></i> Kembali
                        </a>
                    </div> --}}

                </div>
            </div>

        </div>
    </div>
@endsection
