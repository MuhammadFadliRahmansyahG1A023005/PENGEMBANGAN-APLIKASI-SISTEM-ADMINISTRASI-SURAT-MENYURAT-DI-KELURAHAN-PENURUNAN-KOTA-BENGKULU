@extends('layouts.panel')

@section('content')
    <div class="container">
        <div class="page-inner">

            <div class="page-header d-flex justify-content-between">
                <h3 class="fw-bold">Data Surat Keluar</h3>

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
                            @foreach ($suratkeluar as $key => $value)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $value->jenis }}</td>
                                    <td>{{ $value->nama }}</td>
                                    <td>
                                        <span class="badge bg-warning">{{ $value->status }}</span>
                                    </td>
                                    <td class="text-center">
                                        @if (auth()->user()->role != 'Warga')
                                            @php
                                                $urlCetak = '';
                                                if ($value->jenis == 'SKTM') {
                                                    $urlCetak = url('panel/sktmcetak/' . $value->id);
                                                } elseif ($value->jenis == 'SKU') {
                                                    $urlCetak = url('panel/skucetak/' . $value->id);
                                                } elseif ($value->jenis == 'Rekomendasi') {
                                                    $urlCetak = url('panel/rekomendasicetak/' . $value->id);
                                                } elseif ($value->jenis == 'Nikah') {
                                                    $urlCetak = url('panel/nikahcetak/' . $value->id);
                                                }
                                            @endphp
                                            <a href="{{ $urlCetak }}" class="btn btn-sm btn-primary">Cetak</a>
                                        @endif
                                        <a href="{{ url('panel/suratkeluardetail/' . $value->id) }}"
                                            class="btn btn-sm btn-info">Detail</a>
                                        <form action="{{ url('panel/suratkeluarhapus/' . $value->id) }}" method="POST"
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
