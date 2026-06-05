@extends('layouts.panel')

@section('content')
    <div class="container">
        <div class="page-inner">

            <div class="page-header d-flex justify-content-between">
                <h3 class="fw-bold">Data Riwayat Pengajuan</h3>
            </div>

            <div class="card mt-4">
                <div class="card-body">
                    <table class="table table-bordered" id="datatable">
                        <thead class="table-primary text-center">
                            <tr>
                                <th>No</th>
                                <th>Jenis</th>
                                <th>Nama</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($riwayatpengajuan as $key => $value)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $value->jenis }}</td>
                                    <td>{{ $value->nama }}</td>
                                    <td>
                                        <span class="badge bg-warning">{{ $value->status }}</span>
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ url('panel/suratmasukdetail/' . $value->id) }}"
                                            class="btn btn-sm btn-info">Detail</a>
                                        @if (auth()->user()->role != 'Lurah')
                                            <a href="{{ url('panel/suratmasukedit/' . $value->id) }}"
                                                class="btn btn-sm btn-primary">Edit</a>
                                        @endif
                                        <form action="{{ url('panel/suratmasukhapus/' . $value->id) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-danger"
                                                onclick="return confirm('Hapus data?')">Hapus</button>
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
@endsection
