@extends('layouts.panel')

@section('content')
    <div class="container">
        <div class="page-inner">

            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Tambah Surat</h4>
                </div>

                <div class="card-body">

                    <form action="{{ url('panel/suratmasuksimpan') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-4">
                            <label class="fw-bold">Jenis Surat</label>
                            <select name="jenis" id="jenis" class="form-control" required>
                                <option value="" selected disabled>-- Pilih Jenis Surat --</option>
                                <option value="SKTM">Surat Keterangan Tidak Mampu</option>
                                <option value="SKU">Surat Keterangan Usaha</option>
                                <option value="Rekomendasi">Surat Rekomendasi</option>
                                <option value="Rekomendasi Nikah">Surat Rekomendasi Nikah</option>
                            </select>
                        </div>

                        @if (auth()->user()->role == 'Staff')
                            <div class="mb-4">
                                <label class="fw-bold">Warga</label>
                                <select name="user_id" class="form-control" required>
                                    <option value="" selected disabled>-- Pilih Warga --</option>
                                    @foreach ($warga as $w)
                                        <option value="{{ $w->id }}">{{ $w->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        @else
                            <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                        @endif

                        <div id="form-dynamic" class="row"></div>

                        <div class="mt-4 text-end">
                            <button class="btn btn-success px-4">
                                <i class="fa fa-save me-1"></i> Simpan
                            </button>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>

    <script>
        document.getElementById('jenis').addEventListener('change', function() {
            let jenis = this.value;
            let form = '';

            function input(label, name, type = 'text', required = false) {
                return `
        <div class="col-md-6 mb-3">
            <label class="fw-bold">${label}</label>
            <input type="${type}" name="${name}" class="form-control" placeholder="${label}" ${required ? 'required' : ''}>
        </div>`;
            }

            function textarea(label, name, required = false) {
                return `
        <div class="col-md-12 mb-3">
            <label class="fw-bold">${label}</label>
            <textarea name="${name}" class="form-control" placeholder="${label}" ${required ? 'required' : ''}></textarea>
        </div>`;
            }

            function selectStatusPerkawinan() {
                return `
        <div class="col-md-6 mb-3">
            <label class="fw-bold">Status Perkawinan</label>
            <select name="statusperkawinan" class="form-control">
                <option value="">-- Pilih --</option>
                <option value="Belum Kawin">Belum Kawin</option>
                <option value="Kawin">Kawin</option>
                <option value="Cerai Hidup">Cerai Hidup</option>
                <option value="Cerai Mati">Cerai Mati</option>
            </select>
        </div>`;
            }

            function selectJenisKelamin() {
                return `
        <div class="col-md-6 mb-3">
            <label class="fw-bold">Jenis Kelamin</label>
            <select name="jeniskelamin" class="form-control">
                <option value="">-- Pilih --</option>
                <option value="Laki-laki">Laki-laki</option>
                <option value="Perempuan">Perempuan</option>
            </select>
        </div>`;
            }

            function checkbox(label, name) {
                return `
        <div class="col-md-12 mb-3">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="${name}" id="${name}" value="Ya">
                <label class="form-check-label fw-bold" for="${name}">
                    ${label}
                </label>
            </div>
        </div>`;
            }

            if (jenis === 'SKTM') {
                form = `
        ${input('Nama', 'nama')}
        ${input('NIK', 'nik', 'number')}
        ${selectJenisKelamin()}
        ${input('Tempat Lahir', 'tempatlahir')}
        ${input('Tanggal Lahir', 'tanggallahir', 'date')}
        ${input('Agama', 'agama')}
        ${input('Pekerjaan', 'pekerjaan')}
        ${textarea('Alamat', 'alamat')}
        ${selectStatusPerkawinan()}
        ${input('Surat Pengantar Dari RT/RW Setempat', 'suratpengantar', 'file')}
        ${input('KTP', 'ktp', 'file')}
        ${input('KK', 'kk', 'file')}
        ${input('Surat Pernyataan Tidak Mampu Bermaterai 10.000', 'suratpernyataan', 'file')}
        ${input('Foto Rumah', 'foto', 'file')}
        ${textarea('Kebutuhan Surat (Tujuan Pengajuan)', 'kebutuhan')}
        ${checkbox('Berkas pengajuan surat dibawa ke kantor', 'dibawa_ke_kantor')}
        `;
            } else if (jenis === 'SKU') {
                form = `
        ${input('Nama', 'nama')}
        ${input('NIK', 'nik', 'number')}
        ${selectJenisKelamin()}
        ${input('Tempat Lahir', 'tempatlahir')}
        ${input('Tanggal Lahir', 'tanggallahir', 'date')}
        ${input('Agama', 'agama')}
        ${input('Pekerjaan', 'pekerjaan')}
        ${textarea('Alamat', 'alamat')}
        ${input('Mulai Berlaku (Surat Diterbitkan)', 'masaberlakuawal', 'date')}
        ${input('Batas Masa Izin Usaha Habis', 'masaberlakusampai', 'date')}
        ${input('Nama Usaha', 'namausaha')}
        ${input('Lokasi Usaha', 'lokasiusaha')}
        ${input('Surat Pengantar Dari RT/RW Setempat', 'suratpengantar', 'file')}
        ${input('KTP', 'ktp', 'file')}
        ${input('KK', 'kk', 'file')}
        ${input('Surat Permohonan', 'suratpermohonan', 'file')}
        ${input('Foto Usaha', 'foto', 'file')}
        ${textarea('Kebutuhan Surat (Tujuan Pengajuan)', 'kebutuhan')}
        ${checkbox('Berkas pengajuan surat dibawa ke kantor', 'dibawa_ke_kantor')}
        ${checkbox('Keterangan: PBB Sudah Bayar', 'pbb_lunas')}
        `;
            } else if (jenis === 'Rekomendasi') {
                form = `
        ${input('Nama', 'nama')}
        ${input('Jabatan', 'jabatan')}
        ${input('Nama Usaha', 'namausaha')}
        ${input('NIB', 'nib', 'number')}
        ${input('NPWP', 'npwp', 'number')}
        ${textarea('Alamat Perusahaan', 'alamatperusahaan')}
        ${input('No Telepon', 'notelpon')}
        ${input('Email', 'email', 'email')}
        ${input('Kode KBLI', 'kodekbli')}
        ${input('Lokasi Usaha', 'lokasiusaha')}
        ${input('Surat Pengantar Dari RT/RW Setempat', 'suratpengantar', 'file')}
        ${input('KTP', 'ktp', 'file')}
        ${input('KK', 'kk', 'file')}
        ${input('Surat Permohonan', 'suratpermohonan', 'file')}
        ${input('Surat Pernyataan Kesanggupan Mematuhi Protokol dan Menjaga Keamanan', 'suratpernyataan', 'file')}
        ${input('Proposal Kegiatan', 'proposalkegiatan', 'file')}
        ${textarea('Kebutuhan Surat (Tujuan Pengajuan)', 'kebutuhan')}
        ${checkbox('Berkas pengajuan surat dibawa ke kantor', 'dibawa_ke_kantor')}
        `;

            } else if (jenis === 'Rekomendasi Nikah') {
                form = `
        ${input('Nama', 'nama')}
        ${input('NIK', 'nik', 'number')}
        ${selectJenisKelamin()}
        ${input('Tempat Lahir', 'tempatlahir')}
        ${input('Tanggal Lahir', 'tanggallahir', 'date')}
        ${input('Agama', 'agama')}
        ${input('Pekerjaan', 'pekerjaan')}
        ${textarea('Alamat', 'alamat')}
        ${selectStatusPerkawinan()}
        ${input('Surat Pengantar RT/RW', 'suratpengantar', 'file')}
        ${input('Formulir Kelurahan (N1, N2, N4)', 'formulir_n1_n2_n4', 'file')}
        ${input('KTP (Calon Pengantin)', 'ktp', 'file')}
        ${input('KK (Calon Pengantin)', 'kk', 'file')}
        ${input('KTP (Pasangan)', 'ktp_pasangan', 'file')}
        ${input('Akta Kelahiran / Ijazah', 'akta_ijazah', 'file')}
        ${input('Pas Foto Berwarna Latar Biru', 'pas_foto', 'file')}
        ${input('Surat Izin Orang Tua (N5) - Jika &lt; 21 Thn', 'surat_izin_ortu', 'file', false)}
        ${input('Akta Cerai / Kematian (N6) - Jika Janda/Duda', 'akta_cerai_kematian', 'file', false)}
        ${textarea('Kebutuhan Surat (Tujuan Pengajuan)', 'kebutuhan')}
        ${checkbox('Berkas pengajuan surat dibawa ke kantor', 'dibawa_ke_kantor')}
        `;
            }

            document.getElementById('form-dynamic').innerHTML = form;
        });
    </script>
@endsection
