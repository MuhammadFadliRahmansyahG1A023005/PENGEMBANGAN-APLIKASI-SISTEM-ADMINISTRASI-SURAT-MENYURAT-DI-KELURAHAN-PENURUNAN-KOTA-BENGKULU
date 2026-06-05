@extends('layouts.panel')

@section('content')
    <div class="container">
        <div class="page-inner">

            {{-- HEADER --}}
            <div class="page-header d-flex justify-content-between">
                <h3 class="fw-bold">Data Arsip</h3>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambahData">
                    Tambah Data
                </button>
            </div>

            {{-- GRAFIK ARSIP --}}
            <div class="row mt-4">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            <h4 class="card-title text-white mb-0">Grafik Jumlah Arsip Per Bulan</h4>
                        </div>
                        <div class="card-body">
                            <canvas id="arsipChart" style="max-height: 300px;"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            {{-- DAFTAR ARSIP PER BULAN (ACCORDION) --}}
            <div class="card mt-4">
                <div class="card-body">
                    <div class="accordion" id="accordionArsip">
                        @forelse ($groupedArsip as $month => $arsips)
                            <div class="accordion-item mb-3" style="border: 1px solid #ebedf2; border-radius: 8px;">
                                <h2 class="accordion-header" id="heading-{{ $loop->index }}">
                                    <button class="accordion-button fw-bold {{ $loop->first ? '' : 'collapsed' }}" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapse-{{ $loop->index }}" aria-expanded="{{ $loop->first ? 'true' : 'false' }}">
                                        <i class="fas fa-folder-open me-2 text-primary"></i> 
                                        Bulan: {{ $month }} &nbsp;&nbsp; 
                                        <span class="badge bg-primary rounded-pill">{{ $arsips->count() }} Data Arsip</span>
                                    </button>
                                </h2>
                                <div id="collapse-{{ $loop->index }}" class="accordion-collapse collapse {{ $loop->first ? 'show' : '' }}"
                                    data-bs-parent="#accordionArsip">
                                    <div class="accordion-body">
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-hover">
                                                <thead class="table-light text-center">
                                                    <tr>
                                                        <th width="5%">No</th>
                                                        <th>Judul</th>
                                                        <th>Tanggal</th>
                                                        <th>Keterangan</th>
                                                        <th>Data Scan (PDF/Gambar)</th>
                                                        <th width="15%">Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($arsips as $key => $value)
                                                        <tr>
                                                            <td class="text-center">{{ $key + 1 }}</td>
                                                            <td>{{ $value->judul }}</td>
                                                            <td>{{ \Carbon\Carbon::parse($value->tanggal)->format('d/m/Y') }}</td>
                                                            <td>{!! Str::limit($value->keterangan, 50, '...') !!}</td>
                                                            <td class="text-center">
                                                                @if ($value->file)
                                                                    <a href="{{ url('berkas/arsip/' . $value->file) }}" target="_blank"
                                                                        class="btn btn-info btn-sm shadow-sm">
                                                                        <i class="fas fa-file-download me-1"></i> Buka/Download
                                                                    </a>
                                                                @endif
                                                            </td>
                                                            <td class="text-center">
                                                                <a href="{{ url('panel/arsipedit/' . $value->id) }}"
                                                                    class="btn btn-warning btn-sm shadow-sm me-1">
                                                                    <i class="fas fa-edit"></i> Edit
                                                                </a>
                                                                <form action="{{ url('panel/arsiphapus/' . $value->id) }}" method="POST"
                                                                    class="d-inline">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button class="btn btn-danger btn-sm shadow-sm"
                                                                        onclick="return confirm('Hapus arsip permanen?')">
                                                                        <i class="fas fa-trash"></i> Hapus
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
                        @empty
                            <div class="alert alert-info text-center">Belum ada arsip yang tersimpan.</div>
                        @endforelse
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
                    <h5 class="modal-title">Tambah Arsip</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <form action="{{ url('panel/arsipsimpan') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="modal-body">
                        <div class="row">

                            <div class="col-md-6 mb-3">
                                <label>Judul</label>
                                <input type="text" name="judul" class="form-control" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label>Tanggal</label>
                                <input type="date" name="tanggal" class="form-control" required>
                            </div>

                            <div class="col-md-12 mb-3">
                                <label>Keterangan</label>
                                <textarea name="keterangan" class="form-control" id="keterangan"></textarea>
                                <script>
                                    CKEDITOR.replace('keterangan');
                                </script>
                            </div>

                            <div class="col-md-12 mb-3">
                                <label>File</label>
                                <input type="file" name="file" class="form-control">
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

    <!-- Script Chart Grafik Arsip -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var ctx = document.getElementById('arsipChart').getContext('2d');
            var arsipChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: {!! json_encode($chart_labels ?? []) !!},
                    datasets: [{
                        label: 'Jumlah Arsip',
                        data: {!! json_encode($chart_data ?? []) !!},
                        backgroundColor: 'rgba(80, 167, 194, 0.6)',
                        borderColor: 'rgba(80, 167, 194, 1)',
                        borderWidth: 1,
                        borderRadius: 4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                stepSize: 1
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            display: false
                        }
                    }
                }
            });
        });
    </script>
@endsection
