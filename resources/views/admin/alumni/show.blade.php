@php
    $container = 'container-fluid';
    $containerNav = 'container-fluid';
@endphp

@extends('layouts/contentNavbarLayout')

@section('title', 'Fluid - Layouts')

@section('content')
    <!-- Layout Demo -->
    <div class="">
        <div class="card mb-4">
            <h5 class="card-header">Lihat Data Alumni</h5>
            <div class="card-body">
                <form>
                    <div class="mb-3">
                        <label for="foto" class="form-label">Foto</label>
                        @if ($alumni->foto)
                            <img src="{{ asset('storage/' . $alumni->foto) }}" alt="Foto" width="100"
                                class="d-block mb-3">
                        @else
                            <p class="text-muted">Tidak ada foto</p>
                        @endif
                    </div>

                    <div class="mb-3">
                        <label for="name" class="form-label">Nama Lengkap</label>
                        <input disabled type="text" name="name"
                            class="form-control @error('name') is-invalid @enderror" id="name" placeholder="John Doe"
                            value="{{ old('name', $alumni->name) }}" />
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="tahun_start" class="form-label">Tahun Mulai</label>
                        <input disabled type="text" name="tahun_start"
                            class="form-control @error('tahun_start') is-invalid @enderror" id="tahun_start"
                            placeholder="Select Year" value="{{ old('tahun_start', $alumni->tahun_start) }}" />
                        @error('tahun_start')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="tahun_end" class="form-label">Tahun Selesai</label>
                        <input disabled type="text" name="tahun_end"
                            class="form-control @error('tahun_end') is-invalid @enderror" id="tahun_end"
                            placeholder="Select Year" value="{{ old('tahun_end', $alumni->tahun_end) }}" />
                        @error('tahun_end')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat</label>
                        <textarea disabled class="form-control @error('alamat') is-invalid @enderror" name="alamat" id="alamat"
                            rows="3">{{ old('alamat', $alumni->alamat) }}</textarea>
                        @error('alamat')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--/ Layout Demo -->
@endsection

@section('page-script')
    <!-- Include DataTables CSS and JS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#table_config').DataTable();
        });
    </script>
@endsection
