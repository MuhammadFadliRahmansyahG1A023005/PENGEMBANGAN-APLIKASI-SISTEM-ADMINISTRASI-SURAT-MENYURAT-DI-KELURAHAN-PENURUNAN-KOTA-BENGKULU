<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Surat Izin Keramaian - Kelurahan Penurunan</title>
    <style>
        body {
            font-family: "Times New Roman", serif;
            font-size: 15px;
            line-height: 1.4;
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
            font-size: 13px;
            margin-top: 5px;
        }

        .judul {
            text-align: center;
            margin-top: 15px;
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
            margin-bottom: 10px;
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

        .list-poin {
            margin-left: 40px;
            padding-left: 0;
        }

        .ttd-container {
            width: 100%;
            margin-top: 30px;
        }

        .ttd-box {
            float: right;
            width: 50%;
            text-align: left;
        }

        .nama-pejabat {
            font-weight: bold;
            text-decoration: underline;
            text-transform: uppercase;
            margin-top: 60px;
            display: block;
        }
    </style>
</head>

<body>

    {{-- KOP SURAT --}}
    <table class="kop-table">
        <tr>
            <td width="15%">
                <img src="{{ public_path('assets/foto/logo.png') }}" width="80">
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
        <h3>SURAT KETERANGAN REKOMENDASI</h3>
        <div>Nomor : 415.1/ &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; / 1001 / {{ date('Y') }}</div>
    </div>

    <div class="isi-surat">
        Dengan ini menerangkan bahwa :
    </div>

    {{-- IDENTITAS (Field Keramaian) --}}
    <table class="data-table">
        <tr>
            <td width="30%">Nama</td>
            <td width="3%">:</td>
            <td style="text-transform: uppercase;">{{ $surat->nama }}</td>
        </tr>
        <tr>
            <td>Tempat Tgl lahir</td>
            <td>:</td>
            <td>{{ $surat->tempatlahir }}, {{ \Carbon\Carbon::parse($surat->tanggallahir)->isoFormat('D MMMM Y') }}</td>
        </tr>
        <tr>
            <td>Pekerjaan</td>
            <td>:</td>
            <td>{{ $surat->pekerjaan }}</td>
        </tr>
        <tr>
            <td>Alamat</td>
            <td>:</td>
            <td>{{ $surat->alamat }}</td>
        </tr>
    </table>

    <div class="isi-surat">
        Bahwa orang yang namanya tersebut diatas akan mengadakan keramaian pada :
    </div>

    {{-- DETAIL ACARA --}}
    <table class="data-table">
        <tr>
            <td width="30%">Hari</td>
            <td width="3%">:</td>
            <td>{{ \Carbon\Carbon::parse($surat->tanggal)->isoFormat('dddd') }}</td>
        </tr>
        <tr>
            <td>Tanggal</td>
            <td>:</td>
            <td>{{ \Carbon\Carbon::parse($surat->tanggal)->isoFormat('D MMMM Y') }}</td>
        </tr>
        <tr>
            <td>Tempat</td>
            <td>:</td>
            <td>{{ $surat->tempat }}</td>
        </tr>
        <tr>
            <td>Acara</td>
            <td>:</td>
            <td>{{ $surat->acara }}</td>
        </tr>
    </table>

    <div class="isi-surat">Dengan ketentuan sebagai berikut :</div>
    <ol class="list-poin">
        <li>Menjaga keamanan, ketentraman dan kebersihan lingkungan disekitar acara</li>
        <li>Tidak merusak tanaman dan fasiltas umum / warga disekitar acara</li>
        <li>Apabila poin 1 dan 2 dilanggar maka pihak berwenang berhak memberhentikan acara tersebut dan akan membayar
            denda yang sesuai kerusakan.</li>
    </ol>

    <div class="isi-surat">
        Demikian Surat Keterangan izin keramaian ini dibuat untuk {{ $surat->kebutuhan ? $surat->kebutuhan : 'dipergunakan sebagaimana perlunya' }}.
    </div>

    {{-- TANDA TANGAN --}}
    <div class="ttd-container">
        <div class="ttd-box">
            <table style="width: 100%;">
                <tr>
                    <td width="40%">Dikeluarkan di</td>
                    <td>: Bengkulu</td>
                </tr>
                <tr>
                    <td>Pada Tanggal</td>
                    <td>: {{ \Carbon\Carbon::parse($surat->created_at)->isoFormat('D MMMM Y') }}</td>
                </tr>
                <tr>
                    <td colspan="2" style="text-transform: uppercase; padding-top: 5px;"><b>Kepala Kelurahan
                            Penurunan</b></td>
                </tr>
            </table>

            <span class="nama-pejabat">{{ $globalSetting->namalurah }}</span>
            <div>Nip. {{ $globalSetting->nip }}</div>
        </div>
        <div style="clear: both;"></div>
    </div>

</body>

</html>
