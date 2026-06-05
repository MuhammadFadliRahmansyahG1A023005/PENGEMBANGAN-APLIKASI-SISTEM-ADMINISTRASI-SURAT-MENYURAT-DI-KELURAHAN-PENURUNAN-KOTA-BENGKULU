<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Surat Rekomendasi - Kelurahan Penurunan</title>
    <style>
        body {
            font-family: "Times New Roman", serif;
            font-size: 14px;
            /* Ukuran font sedikit lebih kecil agar muat banyak poin */
            line-height: 1.3;
            margin: 0.5cm;
        }

        .kop-table {
            width: 100%;
            border-bottom: 3px solid black;
            padding-bottom: 5px;
            margin-bottom: 15px;
        }

        .kop-text {
            text-align: center;
            vertical-align: middle;
        }

        .kop-text h2 {
            margin: 0;
            font-size: 18px;
            text-transform: uppercase;
        }

        .kop-text h1 {
            margin: 0;
            font-size: 22px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .kop-text div {
            font-size: 12px;
            margin-top: 5px;
        }

        .judul {
            text-align: center;
            margin-top: 15px;
            margin-bottom: 15px;
        }

        .judul h3 {
            margin: 0;
            text-decoration: underline;
            text-transform: uppercase;
            font-size: 16px;
        }

        .section-dasar {
            margin-left: 40px;
            margin-bottom: 10px;
        }

        .isi-surat {
            text-align: justify;
            margin-bottom: 10px;
        }

        .data-table {
            width: 90%;
            margin-left: 60px;
            margin-bottom: 10px;
        }

        .data-table td {
            vertical-align: top;
            padding: 1px 0;
        }

        .list-poin {
            margin-left: 40px;
            padding-left: 0;
            list-style-type: decimal;
        }

        .ttd-container {
            width: 100%;
            margin-top: 20px;
        }

        .ttd-box {
            float: right;
            width: 55%;
            text-align: left;
        }

        .nama-pejabat {
            text-decoration: underline;
            font-weight: bold;
            text-transform: uppercase;
            margin-top: 50px;
            display: block;
        }
    </style>
</head>

<body>

    {{-- KOP SURAT --}}
    <table class="kop-table">
        <tr>
            <td width="15%">
                <img src="{{ public_path('assets/foto/logo.png') }}" width="75">
            </td>
            <td class="kop-text">
                <h2>PEMERINTAH KOTA BENGKULU</h2>
                <h2>KECAMATAN RATU SAMBAN</h2>
                <h1>KELURAHAN PENURUNAN</h1>
                <div>Jalan putri gading cempaka No.01 Telp. (0736) 27371 Bengkulu</div>
            </td>
        </tr>
    </table>

    {{-- JUDUL SURAT --}}
    <div class="judul">
        <h3>SURAT REKOMENDASI</h3>
        <div>Nomor : 415.1/ &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; / 1001 / {{ date('Y') }}</div>
    </div>

    {{-- DASAR HUKUM --}}
    <div style="margin-left: 40px;">Dasar :</div>
    <ol class="section-dasar">
        <li>Undang – undang Republik Indonesia Nomor 22 tahun 2009 tentang lalu lintas dan angkutan jalan</li>
        <li>Undang - undang Republik Indonesia Nomor 11 tahun 2021 tentang cipta karya</li>
        <li>Peraturan Menteri Perhubungan Nomor 11 tahun 2021 tentang penyelenggaraan analisis dampak lalu lintas</li>
    </ol>

    <div class="isi-surat">
        Pemerintahan Kelurahan Penurunan dengan ini memberikan izin penempatan titik lokasi pemasangan kontruksi media
        Reklame (Baliho/billboard) kepada :
    </div>

    {{-- DATA PERUSAHAAN (Sesuai field Rekomendasi di database) --}}
    <table class="data-table">
        <tr>
            <td width="35%">Nama pemilik</td>
            <td width="3%">:</td>
            <td>{{ $surat->nama }}</td>
        </tr>
        <tr>
            <td>Jabatan</td>
            <td>:</td>
            <td>{{ $surat->jabatan }}</td>
        </tr>
        <tr>
            <td>Nama Usaha</td>
            <td>:</td>
            <td style="text-transform: uppercase;"><b>{{ $surat->namausaha }}</b></td>
        </tr>
        <tr>
            <td>NIB</td>
            <td>:</td>
            <td>{{ $surat->nib }}</td>
        </tr>
        <tr>
            <td>NPWP</td>
            <td>:</td>
            <td>{{ $surat->npwp }}</td>
        </tr>
        <tr>
            <td>Alamat Perusahaan</td>
            <td>:</td>
            <td>{{ $surat->alamatperusahaan }}</td>
        </tr>
        <tr>
            <td>No Telpon</td>
            <td>:</td>
            <td>{{ $surat->notelpon }}</td>
        </tr>
        <tr>
            <td>Email</td>
            <td>:</td>
            <td>{{ $surat->email }}</td>
        </tr>
        <tr>
            <td>Kode KBLI</td>
            <td>:</td>
            <td>{{ $surat->kodekbli ?? '; data terlampir' }}</td>
        </tr>
        <tr>
            <td>Lokasi usaha</td>
            <td>:</td>
            <td>{{ $surat->lokasiusaha ?? '; data terlampir' }}</td>
        </tr>
    </table>

    <div class="isi-surat">Dengan ketentuan sebagai berikut:</div>
    <ol class="list-poin" style="margin-top: 0;">
        <li>Tidak mengganggu kelancaran arus lalu lintas</li>
        <li>Tidak menghalangi rambu lalu lintas jalan</li>
        <li>Berkas sudah di cek dan diteliti dalam keadaan lengkap</li>
        <li>Apabila data kelengkapan berkas permohonan izin tidak sesuai dengan ketentuan , maka rekomendasi ini akan
            dicabut.</li>
    </ol>

    <div class="isi-surat">
        Demikian Surat Rekomendasi ini dibuat dengan sebenarnya untuk {{ $surat->kebutuhan ? $surat->kebutuhan : 'dipergunakan sebagaimana mestinya' }}.
    </div>

    {{-- TANDA TANGAN (An. Kepala - Sekretaris) --}}
    <div class="ttd-container">
        <div class="ttd-box">
            @php
                $ttd_nama = $globalSetting->namalurah;
                $ttd_nip = $globalSetting->nip;
                $ttd_jabatan = "An. KEPALA KELURAHAN PENURUNAN";

                if ($surat->ttd_oleh == 'Kasi Pemerintahan') {
                    $ttd_nama = $globalSetting->nama_kasi_pemerintahan;
                    $ttd_nip = $globalSetting->nip_kasi_pemerintahan;
                    $ttd_jabatan = "An. KEPALA KELURAHAN PENURUNAN<br>KASI PEMERINTAHAN & TRANTIB";
                } elseif ($surat->ttd_oleh == 'Kasi Pembangunan') {
                    $ttd_nama = $globalSetting->nama_kasi_pembangunan;
                    $ttd_nip = $globalSetting->nip_kasi_pembangunan;
                    $ttd_jabatan = "An. KEPALA KELURAHAN PENURUNAN<br>KASI PEMBANGUNAN";
                } elseif ($surat->ttd_oleh == 'Kasi Pelayanan') {
                    $ttd_nama = $globalSetting->nama_kasi_pelayanan;
                    $ttd_nip = $globalSetting->nip_kasi_pelayanan;
                    $ttd_jabatan = "An. KEPALA KELURAHAN PENURUNAN<br>KASI PELAYANAN UMUM";
                }
            @endphp
            <table style="font-size: 13px;">
                <tr>
                    <td width="40%">Dikeluarkan di</td>
                    <td>: Bengkulu</td>
                </tr>
                <tr>
                    <td>Pada Tanggal</td>
                    <td>: {{ \Carbon\Carbon::parse($surat->created_at)->isoFormat('DD MMMM YYYY') }}</td>
                </tr>
                <tr>
                    <td colspan="2" style="padding-top: 5px;">{!! $ttd_jabatan !!}</td>
                </tr>
            </table>

            <span class="nama-pejabat" style="margin-top: 40px;">{{ $ttd_nama }}</span>
            <div style="font-size: 13px;">NIP. {{ $ttd_nip }}</div>
        </div>
        <div style="clear: both;"></div>
    </div>

</body>

</html>
