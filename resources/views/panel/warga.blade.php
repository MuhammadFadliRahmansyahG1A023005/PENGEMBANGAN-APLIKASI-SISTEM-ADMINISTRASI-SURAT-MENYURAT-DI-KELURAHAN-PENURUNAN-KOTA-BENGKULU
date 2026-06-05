@extends('layouts.panel')

@section('content')
    <div class="container">
        <div class="page-inner">

            {{-- HEADER --}}
            <div class="page-header d-flex justify-content-between">
                <h3 class="fw-bold">Data Warga</h3>
                @if (auth()->user()->role == 'Staff')
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambahData">
                        Tambah Data
                    </button>
                @endif
            </div>

            {{-- TABLE --}}
            <div class="card mt-4">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="datatable">
                            <thead class="table-primary text-center">
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>No. Telp / Email</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Alamat</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($warga as $key => $value)
                                    <tr>
                                        <td class="text-center">{{ $key + 1 }}</td>
                                        <td>{{ $value->name }}</td>
                                        <td>{{ $value->email }}</td>
                                        <td class="text-center">{{ $value->jeniskelamin == '-' ? 'Belum Diatur' : $value->jeniskelamin }}</td>
                                        <td>{{ $value->alamat == '-' ? 'Belum Diatur' : $value->alamat }}</td>
                                        <td class="text-center">
                                            @if (auth()->user()->role == 'Staff')
                                                <a href="{{ url('panel/wargaedit/' . $value->id) }}"
                                                    class="btn btn-warning btn-sm">
                                                    Edit
                                                </a>
                                            @endif

                                            <form action="{{ url('panel/wargahapus/' . $value->id) }}" method="POST"
                                                class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Hapus data?')">
                                                    Hapus
                                                </button>
                                            </form>

                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>

    {{-- MODAL TAMBAH --}}
    <div class="modal fade" id="modalTambahData">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">Tambah Warga</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <form action="{{ url('panel/wargasimpan') }}" method="POST">
                    @csrf

                    <div class="modal-body">
                        <div class="row">

                            <div class="col-md-6 mb-3">
                                <label>Nama</label>
                                <input type="text" name="name" class="form-control" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label>Email / No. Telpon</label>
                                <input type="text" name="email" class="form-control" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label>Password</label>
                                <input type="password" name="password" class="form-control" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label>Jenis Kelamin</label>
                                <select name="jeniskelamin" class="form-control" required>
                                    <option value="">-- Pilih --</option>
                                    <option value="Laki-laki">Laki-laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                            </div>

                            <div class="col-md-12 mb-3">
                                <label>Alamat</label>
                                <textarea name="alamat" class="form-control" required></textarea>
                            </div>

                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>

                </form>

            </div>
        </div>
    </div>
@endsection
