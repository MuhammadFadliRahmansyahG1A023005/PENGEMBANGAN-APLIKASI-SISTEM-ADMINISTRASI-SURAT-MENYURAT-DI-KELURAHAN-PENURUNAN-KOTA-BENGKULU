<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>SURAT PENGANTAR NIKAH - Kelurahan Penurunan</title>
    <style>
        body {
            font-family: "Times New Roman", serif;
            font-size: 16px;
            line-height: 1.2;
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
            font-size: 20px;
            text-transform: uppercase;
        }

        .kop-text h1 {
            margin: 0;
            font-size: 24px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .kop-text div {
            font-size: 14px;
            margin-top: 5px;
        }

        .judul {
            text-align: center;
            margin-top: 20px;
            margin-bottom: 20px;
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
            text-indent: 40px;
            /* Menjorok ke dalam seperti di gambar */
        }

        .data-table {
            width: 90%;
            margin-left: 40px;
            margin-bottom: 15px;
        }

        .data-table td {
            vertical-align: top;
            padding: 2px 0;
        }

        /* Styling TTD sesuai gambar baru */
        .ttd-container {
            width: 100%;
            margin-top: 30px;
        }

        .ttd-box {
            float: right;
            width: 50%;
            text-align: left;
            font-size: 14px;
        }

        .ttd-box table {
            width: 100%;
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
                <img src="{{ public_path('assets/foto/logo.png') }}" width="85">
            </td>
            <td class="kop-text">
                <h2>PEMERINTAH KOTA BENGKULU</h2>
                <h2>KECAMATAN RATU SAMBAN</h2>
                <h1>KELURAHAN PENURUNAN</h1>
                <div>Jalan Putri Gading Cempaka No.01 Telp. (0736) 27371 Bengkulu</div>
            </td>
        </tr>
    </table>

    {{-- JUDUL SURAT --}}
    <div class="judul">
        <h3>SURAT PENGANTAR NIKAH</h3>
        <div>Nomor &nbsp; : 474.2 / &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; / 1001 / {{ date('Y') }}</div>
    </div>

    <div class="isi-surat" style="text-indent: 0;">
        Yang bertanda tangan di bawah ini Plt. Kepala Kelurahan Penurunan Kecamatan Ratu Samban Kota Bengkulu dengan ini
        menerangkan bahwa :
    </div>

    {{-- DATA PERSONAL (Sesuai field Nikah di database) --}}
    <table class="data-table">
        <tr>
            <td width="30%">Nama Lengkap</td>
            <td width="3%">:</td>
            <td style="text-transform: uppercase;">{{ $surat->nama }}</td>
        </tr>
        <tr>
            <td>Tempat, Tanggal Lahir</td>
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
            <td>NIK</td>
            <td>:</td>
            <td>{{ $surat->nik }}</td>
        </tr>
        <tr>
            <td>Alamat</td>
            <td>:</td>
            <td>{{ $surat->alamat }}</td>
        </tr>
    </table>

    {{-- KETERANGAN NIKAH --}}
    <div class="isi-surat">
        Berdasarkan surat pengantar RT setempat, orang tersebut di atas adalah benar warga Kelurahan Penurunan Kecamatan Ratu Samban Kota Bengkulu. 
        Surat keterangan ini dibuat sebagai kelengkapan administrasi persyaratan untuk {{ $surat->kebutuhan ? $surat->kebutuhan : 'melaksanakan pernikahan (Pernikahan Baru / N1 - N4)' }}.
    </div>

    <div class="isi-surat">
        Demikian surat pengantar nikah ini dibuat dengan sebenarnya agar dapat dipergunakan sebagaimana mestinya dan pihak yang berkepentingan dapat maklum adanya.
    </div>

    {{-- TANDA TANGAN --}}
    <div class="ttd-container">
        <div class="ttd-box">
            @php
                $ttd_nama = $globalSetting->namalurah;
                $ttd_nip = $globalSetting->nip;
                $ttd_jabatan = "Plt. KEPALA KELURAHAN PENURUNAN";

                if ($surat->ttd_oleh == 'Kasi Pemerintahan') {
                    $ttd_nama = $globalSetting->nama_kasi_pemerintahan;
                    $ttd_nip = $globalSetting->nip_kasi_pemerintahan;
                    $ttd_jabatan = "An. LURAH<br>KASI PEMERINTAHAN & TRANTIB";
                } elseif ($surat->ttd_oleh == 'Kasi Pembangunan') {
                    $ttd_nama = $globalSetting->nama_kasi_pembangunan;
                    $ttd_nip = $globalSetting->nip_kasi_pembangunan;
                    $ttd_jabatan = "An. LURAH<br>KASI PEMBANGUNAN";
                } elseif ($surat->ttd_oleh == 'Kasi Pelayanan') {
                    $ttd_nama = $globalSetting->nama_kasi_pelayanan;
                    $ttd_nip = $globalSetting->nip_kasi_pelayanan;
                    $ttd_jabatan = "An. LURAH<br>KASI PELAYANAN UMUM";
                }
            @endphp
            <table>
                <tr>
                    <td>Dikeluarkan di</td>
                    <td>: Bengkulu</td>
                </tr>
                <tr>
                    <td>Pada Tanggal</td>
                    <td>: {{ \Carbon\Carbon::parse($surat->created_at)->isoFormat('DD MMMM YYYY') }}</td>
                </tr>
                <tr>
                    <td colspan="2">{!! $ttd_jabatan !!}</td>
                </tr>
            </table>

            <span class="nama-pejabat">{{ $ttd_nama }}</span>
            <div>Nip. {{ $ttd_nip }}</div>
        </div>
        <div style="clear: both;"></div>
    </div>

</body>

</html>
