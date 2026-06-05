@extends('layouts.panel')

@section('content')
    <div class="container">
        <div class="page-inner">

            <div class="page-header d-flex justify-content-between">
                <h3 class="fw-bold">Edit Setting</h3>
            </div>

            <div class="card mt-4">
                <div class="card-body">

                    <form action="{{ url('panel/settingupdate') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row">

                            <div class="col-md-6 mb-3">
                                <label>Nama Lurah</label>
                                <input type="text" name="name" value="{{ $setting->namalurah }}" class="form-control"
                                    required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label>NIP Lurah</label>
                                <input type="text" name="nip" value="{{ $setting->nip }}" class="form-control"
                                    required>
                            </div>

                            {{-- SEKRETARIS --}}
                            <div class="col-md-6 mb-3">
                                <label>Nama Sekretaris</label>
                                <input type="text" name="nama_sekretaris" value="{{ $setting->nama_sekretaris }}" class="form-control">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>NIP Sekretaris</label>
                                <input type="text" name="nip_sekretaris" value="{{ $setting->nip_sekretaris }}" class="form-control">
                            </div>

                            <div class="col-md-12 mt-4">
                                <h5 class="fw-bold text-primary">Kelompok Jabatan Fungsional</h5>
                                <hr>
                            </div>

                            <div class="col-md-4 mb-3">
                                <label>BABINSA</label>
                                <input type="text" name="babinsa" value="{{ $setting->babinsa }}" class="form-control">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label>BHABINKAMTIBMAS</label>
                                <input type="text" name="bhabinkamtibmas" value="{{ $setting->bhabinkamtibmas }}" class="form-control">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label>BLPKB</label>
                                <input type="text" name="blpkb" value="{{ $setting->blpkb }}" class="form-control">
                            </div>

                            <div class="col-md-12 mt-4">
                                <h5 class="fw-bold text-primary">Delegasi TTD (Kasi)</h5>
                                <hr>
                            </div>

                            {{-- KASI PEMERINTAHAN --}}
                            <div class="col-md-6 mb-3">
                                <label>Nama Kasi Pemerintahan/Trantib</label>
                                <input type="text" name="nama_kasi_pemerintahan" value="{{ $setting->nama_kasi_pemerintahan }}" class="form-control">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>NIP Kasi Pemerintahan/Trantib</label>
                                <input type="text" name="nip_kasi_pemerintahan" value="{{ $setting->nip_kasi_pemerintahan }}" class="form-control">
                            </div>

                            <div class="col-md-6 mb-3 ps-4">
                                <label>Nama Staf Pemerintahan</label>
                                <input type="text" name="staf_pemerintahan" value="{{ $setting->staf_pemerintahan }}" class="form-control">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>NIP Staf Pemerintahan</label>
                                <input type="text" name="nip_staf_pemerintahan" value="{{ $setting->nip_staf_pemerintahan }}" class="form-control">
                            </div>

                            {{-- KASI PEMBANGUNAN --}}
                            <div class="col-md-6 mb-3">
                                <label>Nama Kasi Pembangunan</label>
                                <input type="text" name="nama_kasi_pembangunan" value="{{ $setting->nama_kasi_pembangunan }}" class="form-control">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>NIP Kasi Pembangunan</label>
                                <input type="text" name="nip_kasi_pembangunan" value="{{ $setting->nip_kasi_pembangunan }}" class="form-control">
                            </div>

                            {{-- KASI PELAYANAN --}}
                            <div class="col-md-6 mb-3">
                                <label>Nama Kasi Pelayanan Umum</label>
                                <input type="text" name="nama_kasi_pelayanan" value="{{ $setting->nama_kasi_pelayanan }}" class="form-control">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>NIP Kasi Pelayanan Umum</label>
                                <input type="text" name="nip_kasi_pelayanan" value="{{ $setting->nip_kasi_pelayanan }}" class="form-control">
                            </div>

                        </div>

                        <button type="submit" class="btn btn-primary">Update</button>

                    </form>

                </div>
            </div>

        </div>
    </div>
@endsection
