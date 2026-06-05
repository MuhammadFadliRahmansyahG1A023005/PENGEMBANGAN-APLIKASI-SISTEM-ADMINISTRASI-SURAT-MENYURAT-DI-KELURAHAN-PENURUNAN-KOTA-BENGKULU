@extends('layouts.panel')

@section('content')
    <div class="container">
        <div class="page-inner">

            {{-- HEADER --}}
            <div class="page-header d-flex justify-content-between">
                <h3 class="fw-bold">Edit Arsip</h3>
                <a href="{{ url('panel/arsip') }}" class="btn btn-secondary">Kembali</a>
            </div>

            <div class="card mt-4">
                <div class="card-body">

                    <form action="{{ url('panel/arsipupdate/' . $arsip->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row">

                            <div class="col-md-6 mb-3">
                                <label>Judul</label>
                                <input type="text" name="judul" class="form-control" value="{{ $arsip->judul }}"
                                    required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label>Tanggal</label>
                                <input type="date" name="tanggal" class="form-control" value="{{ $arsip->tanggal }}"
                                    required>
                            </div>

                            <div class="col-md-12 mb-3">
                                <label>Keterangan</label>
                                <textarea name="keterangan" class="form-control" id="keterangan">{{ $arsip->keterangan }}</textarea>
                            </div>

                            <div class="col-md-12 mb-3">
                                <label>File Lama</label><br>

                                @if ($arsip->file)
                                    <a href="{{ asset('storage/arsip/' . $arsip->file) }}" target="_blank"
                                        class="btn btn-info btn-sm mb-2">
                                        Lihat File
                                    </a>
                                @else
                                    <span class="text-muted">Tidak ada file</span>
                                @endif
                            </div>

                            <div class="col-md-12 mb-3">
                                <label>Ganti File (opsional)</label>
                                <input type="file" name="file" class="form-control">
                            </div>

                        </div>

                        <div class="mt-3">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>

    {{-- CKEDITOR --}}
    <script>
        CKEDITOR.replace('keterangan');
    </script>
@endsection
