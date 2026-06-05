@extends('layouts.panel')

@section('content')
    <div class="container">
        <div class="page-inner">

            {{-- HEADER --}}
            <div class="page-header d-flex justify-content-between align-items-center">
                <h3 class="fw-bold mb-0">Data Staff</h3>
                @if (auth()->user()->role == 'Lurah')
                    <button class="btn btn-primary btn-round" data-bs-toggle="modal" data-bs-target="#modalTambahData">
                        <i class="fa fa-plus"></i> Tambah Staff
                    </button>
                @endif
            </div>

            {{-- TABLE --}}
            <div class="card mt-4 shadow-sm border-0">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered" id="datatable">
                            <thead class="table-primary text-center">
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>NIK</th>
                                    <th>JK</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($staff as $key => $value)
                                    <tr>
                                        <td class="text-center">{{ $key + 1 }}</td>
                                        <td>{{ $value->name }}</td>
                                        <td>{{ $value->email }}</td>
                                        <td>{{ $value->nik }}</td>
                                        <td>{{ $value->jeniskelamin }}</td>
                                        <td class="text-center">
                                            @if (auth()->user()->role == 'Lurah')
                                                <a href="{{ url('panel/staffedit/' . $value->id) }}"
                                                    class="btn btn-warning btn-sm">
                                                    <i class="fa fa-edit"></i> Edit
                                                </a>

                                                <form action="{{ url('panel/staffhapus/' . $value->id) }}" method="POST"
                                                    class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-danger btn-sm"
                                                        onclick="return confirm('Hapus data staff ini?')">
                                                        <i class="fa fa-trash"></i> Hapus
                                                    </button>
                                                </form>
                                            @endif
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
    @if (auth()->user()->role == 'Lurah')
    <div class="modal fade" id="modalTambahData">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title"><i class="fa fa-user-plus"></i> Tambah Staff Baru</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>

                <form action="{{ url('panel/staffsimpan') }}" method="POST">
                    @csrf

                    <div class="modal-body p-4">
                        <div class="row g-3">

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Nama Lengkap</label>
                                <input type="text" name="name" class="form-control" required placeholder="Nama lengkap">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Email</label>
                                <input type="email" name="email" class="form-control" required placeholder="Email aktif">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Password</label>
                                <input type="password" name="password" class="form-control" required placeholder="Buat password">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Jenis Kelamin</label>
                                <select name="jeniskelamin" class="form-select" required>
                                    <option value="" selected disabled>-- Pilih Jenis Kelamin --</option>
                                    <option value="Laki-laki">Laki-laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">NIK</label>
                                <input type="number" name="nik" class="form-control" required placeholder="Nomor Induk Kependudukan">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-semibold">No KK</label>
                                <input type="number" name="nokk" class="form-control" required placeholder="Nomor Kartu Keluarga">
                            </div>

                            <div class="col-md-12">
                                <label class="form-label fw-semibold">Alamat</label>
                                <textarea name="alamat" class="form-control" rows="2" required placeholder="Alamat lengkap staff"></textarea>
                            </div>

                        </div>
                    </div>

                    <div class="modal-footer bg-light">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan Data</button>
                    </div>

                </form>

            </div>
        </div>
    </div>
    @endif
@endsection
