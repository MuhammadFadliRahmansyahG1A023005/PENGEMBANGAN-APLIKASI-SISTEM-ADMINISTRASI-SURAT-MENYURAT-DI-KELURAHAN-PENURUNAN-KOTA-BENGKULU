@extends('layouts.panel')

@section('content')
    <div class="container">
        <div class="page-inner">

            <div class="page-header d-flex justify-content-between align-items-center">
                <h3 class="fw-bold mb-0">Edit Data Staff</h3>
                <a href="{{ url('panel/staff') }}" class="btn btn-secondary btn-round">
                    <i class="fa fa-arrow-left"></i> Kembali
                </a>
            </div>

            <div class="card mt-4 shadow-sm border-0">
                <div class="card-body p-4">

                    <form action="{{ url('panel/staffupdate/' . $staff->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row g-3">

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Nama Lengkap</label>
                                <input type="text" name="name" value="{{ $staff->name }}" class="form-control" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Email</label>
                                <input type="email" name="email" value="{{ $staff->email }}" class="form-control" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Password (Opsional)</label>
                                <input type="password" name="password" class="form-control">
                                <small class="text-muted">Kosongkan jika tidak ingin mengubah password</small>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Jenis Kelamin</label>
                                <select name="jeniskelamin" class="form-select" required>
                                    <option value="">-- Pilih --</option>
                                    <option value="Laki-laki" {{ $staff->jeniskelamin == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                    <option value="Perempuan" {{ $staff->jeniskelamin == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">NIK</label>
                                <input type="number" name="nik" value="{{ $staff->nik }}" class="form-control" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">No KK</label>
                                <input type="number" name="nokk" value="{{ $staff->nokk }}" class="form-control" required>
                            </div>

                            <div class="col-md-12">
                                <label class="form-label fw-semibold">Alamat</label>
                                <textarea name="alamat" class="form-control" rows="3" required>{{ $staff->alamat }}</textarea>
                            </div>

                        </div>

                        <div class="mt-4 text-end">
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-save"></i> Update Data
                            </button>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>
@endsection
