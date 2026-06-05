@extends('layouts.panel')

@section('content')
    <div class="container">
        <div class="page-inner">

            <div class="card shadow-sm">
                <div class="card-header bg-warning text-dark">
                    <h4 class="mb-0">Edit Surat</h4>
                </div>

                <div class="card-body">

                    <form action="{{ url('panel/suratmasukupdate/' . $surat->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label class="fw-bold">Jenis Surat</label>
                            <select name="jenis" id="jenis" class="form-control" required>
                                <option value="SKTM" {{ $surat->jenis == 'SKTM' ? 'selected' : '' }}>SKTM</option>
                                <option value="SKU" {{ $surat->jenis == 'SKU' ? 'selected' : '' }}>SKU</option>
                                <option value="Rekomendasi" {{ $surat->jenis == 'Rekomendasi' ? 'selected' : '' }}>
                                    Rekomendasi
                                </option>
                                <option value="Rekomendasi Nikah" {{ $surat->jenis == 'Rekomendasi Nikah' ? 'selected' : '' }}>Surat Rekomendasi Nikah
                                </option>
                            </select>
                        </div>

                        @if (auth()->user()->role == 'Staff')
                            <div class="mb-4">
                                <label class="fw-bold">Warga</label>
                                <select name="user_id" class="form-control">
                                    @foreach ($warga as $w)
                                        <option value="{{ $w->id }}"
                                            {{ $surat->user_id == $w->id ? 'selected' : '' }}>
                                            {{ $w->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        @else
                            <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                        @endif

                        <div id="form-dynamic" class="row"></div>

                        <div class="mt-4 text-end">
                            <button class="btn btn-warning px-4">
                                Update
                            </button>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>

    <script>
        let surat = @json($surat);

        function input(label, name, value = '', type = 'text') {
            return `
    <div class="col-md-6 mb-3">
        <label class="fw-bold">${label}</label>
        <input type="${type}" name="${name}" value="${value ?? ''}" class="form-control">
    </div>`;
        }

        function textarea(label, name, value = '') {
            return `
    <div class="col-md-12 mb-3">
        <label class="fw-bold">${label}</label>
        <textarea name="${name}" class="form-control">${value ?? ''}</textarea>
    </div>`;
        }

        function selectJK(val = '') {
            return `
    <div class="col-md-6 mb-3">
        <label class="fw-bold">Jenis Kelamin</label>
        <select name="jeniskelamin" class="form-control">
            <option ${val=='Laki-laki'?'selected':''}>Laki-laki</option>
            <option ${val=='Perempuan'?'selected':''}>Perempuan</option>
        </select>
    </div>`;
        }

        function selectStatus(val = '') {
            return `
    <div class="col-md-6 mb-3">
        <label class="fw-bold">Status Perkawinan</label>
        <select name="statusperkawinan" class="form-control">
            <option ${val=='Belum Kawin'?'selected':''}>Belum Kawin</option>
            <option ${val=='Kawin'?'selected':''}>Kawin</option>
            <option ${val=='Cerai Hidup'?'selected':''}>Cerai Hidup</option>
            <option ${val=='Cerai Mati'?'selected':''}>Cerai Mati</option>
        </select>
    </div>`;
        }

        function checkbox(label, name, value = '') {
            return `
    <div class="col-md-12 mb-3">
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="${name}" id="${name}" value="Ya" ${value == 'Ya' ? 'checked' : ''}>
            <label class="form-check-label fw-bold" for="${name}">
                ${label}
            </label>
        </div>
    </div>`;
        }

        function renderForm(jenis) {
            let form = '';

            if (jenis === 'SKTM') {
                form = `
        ${input('Nama','nama',surat.nama)}
        ${input('NIK','nik',surat.nik)}
        ${selectJK(surat.jeniskelamin)}
        ${input('Tempat Lahir','tempatlahir',surat.tempatlahir)}
        ${input('Tanggal Lahir','tanggallahir',surat.tanggallahir,'date')}
        ${input('Agama','agama',surat.agama)}
        ${input('Pekerjaan','pekerjaan',surat.pekerjaan)}
        ${textarea('Alamat','alamat',surat.alamat)}
        ${selectStatus(surat.statusperkawinan)}
        ${input('Surat Pengantar Dari RT/RW Setempat','suratpengantar','','file')}
        ${input('KTP','ktp','','file')}
        ${input('KK','kk','','file')}
        ${input('Surat Pernyataan Tidak Mampu Bermaterai 10.000','suratpernyataan','','file')}
        ${input('Foto Rumah','foto','','file')}
        ${textarea('Kebutuhan Surat (Tujuan Pengajuan)', 'kebutuhan', surat.kebutuhan)}
        ${checkbox('Berkas pengajuan surat dibawa ke kantor', 'dibawa_ke_kantor', surat.dibawa_ke_kantor)}
        `;
            } else if (jenis === 'SKU') {
                form = `
        ${input('Nama','nama',surat.nama)}
        ${input('NIK','nik',surat.nik)}
        ${selectJK(surat.jeniskelamin)}
        ${input('Tempat Lahir','tempatlahir',surat.tempatlahir)}
        ${input('Tanggal Lahir','tanggallahir',surat.tanggallahir,'date')}
        ${input('Agama','agama',surat.agama)}
        ${input('Pekerjaan','pekerjaan',surat.pekerjaan)}
        ${textarea('Alamat','alamat',surat.alamat)}
        ${input('Mulai Berlaku (Surat Diterbitkan)','masaberlakuawal',surat.masaberlakuawal,'date')}
        ${input('Batas Masa Izin Usaha Habis','masaberlakusampai',surat.masaberlakusampai,'date')}
        ${input('Nama Usaha','namausaha',surat.namausaha)}
        ${input('Lokasi Usaha','lokasiusaha',surat.lokasiusaha)}
        ${input('Surat Pengantar Dari RT/RW Setempat','suratpengantar','','file')}
        ${input('KTP','ktp','','file')}
        ${input('KK','kk','','file')}
        ${input('Surat Permohonan','suratpermohonan','','file')}
        ${input('Foto Usaha','foto','','file')}
        ${textarea('Kebutuhan Surat (Tujuan Pengajuan)', 'kebutuhan', surat.kebutuhan)}
        ${checkbox('Berkas pengajuan surat dibawa ke kantor', 'dibawa_ke_kantor', surat.dibawa_ke_kantor)}
        ${checkbox('Keterangan: PBB Sudah Bayar', 'pbb_lunas', surat.pbb_lunas)}
        `;
            } else if (jenis === 'Rekomendasi') {
                form = `
        ${input('Nama','nama',surat.nama)}
        ${input('Jabatan','jabatan',surat.jabatan)}
        ${input('Nama Usaha','namausaha',surat.namausaha)}
        ${input('NIB','nib',surat.nib)}
        ${input('NPWP','npwp',surat.npwp)}
        ${textarea('Alamat Perusahaan','alamatperusahaan',surat.alamatperusahaan)}
        ${input('No Telp','notelpon',surat.notelpon)}
        ${input('Email','email',surat.email)}
        ${input('KBLI','kodekbli',surat.kodekbli)}
        ${input('Lokasi Usaha','lokasiusaha',surat.lokasiusaha)}
        ${input('Surat Pengantar Dari RT/RW Setempat','suratpengantar','','file')}
        ${input('KTP','ktp','','file')}
        ${input('KK','kk','','file')}
        ${input('Surat Permohonan','suratpermohonan','','file')}
        ${input('Surat Pernyataan Kesanggupan Mematuhi Protokol dan Menjaga Keamanan','suratpernyataan','','file')}
        ${input('Proposal Kegiatan','proposalkegiatan','','file')}
        ${textarea('Kebutuhan Surat (Tujuan Pengajuan)', 'kebutuhan', surat.kebutuhan)}
        ${checkbox('Berkas pengajuan surat dibawa ke kantor', 'dibawa_ke_kantor', surat.dibawa_ke_kantor)}
        `;

            } else if (jenis === 'Rekomendasi Nikah') {
                form = `
        ${input('Nama','nama',surat.nama)}
        ${input('NIK','nik',surat.nik)}
        ${selectJK(surat.jeniskelamin)}
        ${input('Tempat Lahir','tempatlahir',surat.tempatlahir)}
        ${input('Tanggal Lahir','tanggallahir',surat.tanggallahir,'date')}
        ${input('Agama','agama',surat.agama)}
        ${input('Pekerjaan','pekerjaan',surat.pekerjaan)}
        ${textarea('Alamat','alamat',surat.alamat)}
        ${selectStatus(surat.statusperkawinan)}
        ${input('Surat Pengantar RT/RW', 'suratpengantar', '', 'file')}
        ${input('Formulir Kelurahan (N1, N2, N4)', 'formulir_n1_n2_n4', '', 'file')}
        ${input('KTP (Calon Pengantin)', 'ktp', '', 'file')}
        ${input('KK (Calon Pengantin)', 'kk', '', 'file')}
        ${input('KTP (Pasangan)', 'ktp_pasangan', '', 'file')}
        ${input('Akta Kelahiran / Ijazah', 'akta_ijazah', '', 'file')}
        ${input('Pas Foto Berwarna Latar Biru', 'pas_foto', '', 'file')}
        ${input('Surat Izin Orang Tua (N5) - Jika &lt; 21 Thn', 'surat_izin_ortu', '', 'file', false)}
        ${input('Akta Cerai / Kematian (N6) - Jika Janda/Duda', 'akta_cerai_kematian', '', 'file', false)}
        ${textarea('Kebutuhan Surat (Tujuan Pengajuan)', 'kebutuhan', surat.kebutuhan)}
        ${checkbox('Berkas pengajuan surat dibawa ke kantor', 'dibawa_ke_kantor', surat.dibawa_ke_kantor)}
        `;
            }

            document.getElementById('form-dynamic').innerHTML = form;
        }

        renderForm(surat.jenis);

        document.getElementById('jenis').addEventListener('change', function() {
            renderForm(this.value);
        });
    </script>
@endsection
