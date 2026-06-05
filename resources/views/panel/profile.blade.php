@extends('layouts.panel')

@section('content')
    <div class="container">
        <div class="page-inner">

            <div class="page-header d-flex justify-content-between">
                <h3 class="fw-bold">Edit Profile</h3>
            </div>

            <div class="card mt-4">
                <div class="card-body">

                    <form action="{{ url('panel/profileupdate') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="col-md-12 text-center mb-4">
                                <div class="position-relative d-inline-block">
                                    @if($profile->foto)
                                        <img src="{{ url('berkas/profil/' . $profile->foto) }}" alt="Avatar" class="avatar-img rounded-circle border border-3 border-white shadow" style="width: 120px; height: 120px; object-fit: cover;">
                                    @else
                                        <div class="avatar-img rounded-circle border border-3 border-white shadow bg-primary text-white d-flex align-items-center justify-content-center fw-bold fs-1" style="width: 120px; height: 120px;">
                                            {{ strtoupper(substr($profile->name, 0, 1)) }}
                                        </div>
                                    @endif
                                    <!-- Green Online Badge -->
                                    <span class="position-absolute bottom-0 end-0 p-2 bg-success border border-white rounded-circle" style="transform: translate(-15px, -15px); width: 20px; height: 20px;" title="Online">
                                        <span class="visually-hidden">Online</span>
                                    </span>
                                </div>
                                <div class="mt-3">
                                    <label class="form-label d-block text-muted small">Ubah Foto Profil</label>
                                    <input type="file" name="foto" class="form-control form-control-sm mx-auto" style="max-width: 300px;" accept="image/*">
                                </div>
                            </div>


                            <div class="col-md-6 mb-3">
                                <label>Nama</label>
                                <input type="text" name="name" value="{{ $profile->name }}" class="form-control"
                                    required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label>Email / No. Telepon</label>
                                <input type="text" name="email" value="{{ $profile->email }}" class="form-control"
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
                                    <option value="Laki-laki" {{ $profile->jeniskelamin == 'Laki-laki' ? 'selected' : '' }}>
                                        Laki-laki</option>
                                    <option value="Perempuan" {{ $profile->jeniskelamin == 'Perempuan' ? 'selected' : '' }}>
                                        Perempuan</option>
                                </select>
                            </div>



                            <div class="col-md-12 mb-3">
                                <label>Alamat</label>
                                <textarea name="alamat" class="form-control" required>{{ $profile->alamat }}</textarea>
                            </div>

                        </div>

                        <button type="submit" class="btn btn-primary">Update</button>

                    </form>

                </div>
            </div>

        </div>
    </div>
@endsection
