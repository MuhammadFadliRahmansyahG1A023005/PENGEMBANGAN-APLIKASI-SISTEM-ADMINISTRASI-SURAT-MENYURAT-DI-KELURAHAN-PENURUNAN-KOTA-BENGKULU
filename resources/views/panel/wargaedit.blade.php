@extends('layouts.panel')

@section('content')
    <div class="container">
        <div class="page-inner">

            <div class="page-header d-flex justify-content-between">
                <h3 class="fw-bold">Edit Warga</h3>
                <a href="{{ url('panel/warga') }}" class="btn btn-secondary">Kembali</a>
            </div>

            <div class="card mt-4">
                <div class="card-body">

                    <form action="{{ url('panel/wargaupdate/' . $warga->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row">

                            <div class="col-md-6 mb-3">
                                <label>Nama</label>
                                <input type="text" name="name" value="{{ $warga->name }}" class="form-control"
                                    required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label>Email / No. Telpon</label>
                                <input type="text" name="email" value="{{ $warga->email }}" class="form-control"
                                    required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label>Password (opsional)</label>
                                <input type="password" name="password" class="form-control">
                                <small>Kosongkan jika tidak diubah</small>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label>Jenis Kelamin</label>
                                <select name="jeniskelamin" class="form-control" required>
                                    <option value="">-- Pilih --</option>
                                    <option value="Laki-laki" {{ $warga->jeniskelamin == 'Laki-laki' ? 'selected' : '' }}>
                                        Laki-laki</option>
                                    <option value="Perempuan" {{ $warga->jeniskelamin == 'Perempuan' ? 'selected' : '' }}>
                                        Perempuan</option>
                                </select>
                            </div>

                            <div class="col-md-12 mb-3">
                                <label>Alamat</label>
                                <textarea name="alamat" class="form-control" required>{{ $warga->alamat }}</textarea>
                            </div>

                        </div>

                        <button type="submit" class="btn btn-primary">Update</button>

                    </form>

                </div>
            </div>

        </div>
    </div>
@endsection
