<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>SKTM Kelurahan Penurunan</title>
    <style>
        body {
            font-family: "Times New Roman", serif;
            font-size: 16px;
            /* Ukuran font disesuaikan agar lebih proporsional */
            line-height: 1.4;
            margin: 0.5cm;
        }

        .kop-table {
            width: 100%;
            border-bottom: 3px solid black;
            padding-bottom: 5px;
            margin-bottom: 20px;
        }

        .kop-text {
            text-align: center;
            vertical-align: middle;
        }

        .kop-text h2 {
            margin: 0;
            font-size: 22px;
            text-transform: uppercase;
        }

        .kop-text h1 {
            margin: 0;
            font-size: 26px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .kop-text div {
            font-size: 14px;
            margin-top: 5px;
        }

        .judul {
            text-align: center;
            margin-bottom: 25px;
        }

        .judul h3 {
            margin: 0;
            text-decoration: underline;
            text-transform: uppercase;
            font-size: 18px;
        }

        .isi-surat {
            text-align: justify;
            margin-bottom: 15px;
        }

        .data-table {
            width: 90%;
            margin-left: auto;
            margin-right: auto;
            margin-bottom: 20px;
        }

        .data-table td {
            vertical-align: top;
            padding: 2px 0;
        }

        .ttd-container {
            width: 100%;
            margin-top: 40px;
        }

        .ttd-box {
            float: right;
            width: 45%;
            text-align: center;
        }

        .nama-ttd {
            text-decoration: underline;
            font-weight: bold;
            text-transform: uppercase;
            margin-top: 60px;
            margin-bottom: 0;
        }
    </style>
</head>

<body>

    {{-- KOP SURAT --}}
    <table class="kop-table">
        <tr>
            <td width="15%">
                <img src="{{ public_path('assets/foto/logo.png') }}" width="90">
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
        <h3>SURAT KETERANGAN TIDAK MAMPU</h3>
        <div>Nomor : 470 / &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; / 1001 / {{ date('Y') }}</div>
    </div>

    <div class="isi-surat">
        Yang bertanda tangan dibawah ini An. Kepala Kelurahan Penurunan Kecamatan Ratu Samban Kota Bengkulu, dengan ini
        menerangkan bahwa :
    </div>

    {{-- DATA PERSONAL --}}
    <table class="data-table">
        <tr>
            <td width="30%">Nama</td>
            <td width="3%">:</td>
            <td style="text-transform: uppercase;"><b>{{ $surat->nama }}</b></td>
        </tr>
        <tr>
            <td>NIK / KK</td>
            <td>:</td>
            <td>{{ $surat->nik }}</td>
        </tr>
        <tr>
            <td>Tempat/Tgl lahir</td>
            <td>:</td>
            <td>{{ $surat->tempatlahir }}, {{ \Carbon\Carbon::parse($surat->tanggallahir)->isoFormat('D MMMM Y') }}</td>
        </tr>
        <tr>
            <td>Jenis Kelamin</td>
            <td>:</td>
            <td>{{ $surat->jeniskelamin }}</td>
        </tr>
        <tr>
            <td>Agama</td>
            <td>:</td>
            <td>{{ $surat->agama }}</td>
        </tr>
        <tr>
            <td>Pekerjaan</td>
            <td>:</td>
            <td>{{ $surat->pekerjaan }}</td>
        </tr>
        <tr>
            <td>Status Perkawinan</td>
            <td>:</td>
            <td>{{ $surat->statusperkawinan }}</td>
        </tr>
        <tr>
            <td>Alamat</td>
            <td>:</td>
            <td>{{ $surat->alamat }}</td>
        </tr>
    </table>

    {{-- KETERANGAN TAMBAHAN --}}
    <div class="isi-surat">
        Berdasarkan Surat pengantar RT. No.{{ $surat->no_rt_pengantar }} tanggal
        {{ \Carbon\Carbon::parse($surat->tgl_pengantar)->isoFormat('DD MMMM YYYY') }} orang tersebut atas adalah warga
        Tidak Mampu/Miskin, adapun surat ini dibuat untuk {{ $surat->kebutuhan ? $surat->kebutuhan : 'melengkapi persyaratan Keringanan biaya Berobat di Rumah Sakit Kota Bengkulu' }}.
    </div>

    <div class="isi-surat">
        Demikian surat keterangan ini dibuat untuk dapat dipergunakan sebagaimana mestinya.
    </div>

    {{-- TANDA TANGAN --}}
    <div class="ttd-container">
        <div class="ttd-box">
            <div>Bengkulu, {{ date('d F Y') }}</div>
            
            @php
                $ttd_nama = $globalSetting->namalurah;
                $ttd_nip = $globalSetting->nip;
                $ttd_jabatan = "Kepala Kelurahan Penurunan";

                if ($surat->ttd_oleh == 'Kasi Pemerintahan') {
                    $ttd_nama = $globalSetting->nama_kasi_pemerintahan;
                    $ttd_nip = $globalSetting->nip_kasi_pemerintahan;
                    $ttd_jabatan = "An. Lurah Penurunan<br>Kasi. Pemerintahan & Trantib";
                } elseif ($surat->ttd_oleh == 'Kasi Pembangunan') {
                    $ttd_nama = $globalSetting->nama_kasi_pembangunan;
                    $ttd_nip = $globalSetting->nip_kasi_pembangunan;
                    $ttd_jabatan = "An. Lurah Penurunan<br>Kasi. Pembangunan";
                } elseif ($surat->ttd_oleh == 'Kasi Pelayanan') {
                    $ttd_nama = $globalSetting->nama_kasi_pelayanan;
                    $ttd_nip = $globalSetting->nip_kasi_pelayanan;
                    $ttd_jabatan = "An. Lurah Penurunan<br>Kasi. Pelayanan Umum";
                }
            @endphp

            <div>{!! $ttd_jabatan !!}</div>

            <p class="nama-ttd">{{ $ttd_nama }}</p>
            <div>NIP. {{ $ttd_nip }}</div>
        </div>
    </div>

</body>

</html>
