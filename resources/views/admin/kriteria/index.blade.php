@php
    $container = 'container-fluid';
    $containerNav = 'container-fluid';
@endphp

@extends('layouts/contentNavbarLayout')

@section('title', 'Fluid - Layouts')

@section('content')
    <!-- Layout Demo -->
    <div class="card h-100">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="card-title mb-0">Pendaftaran</h5>
            <button onclick="window.location.href='{{ route('kriteria.kriteria.create') }}'" type="button"
                class="btn btn-outline-primary">Tambah Data</button>
        </div>

        <div class="card-body" style="height: 100%;">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <table id="table_config" class="display" style="width:100%; height: 100%;">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Bobot</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $item)
                        <tr>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->bobot }}</td>
                            <td>
                                <!-- Show button -->
                                <!-- Edit button -->
                                <button onclick="window.location.href='{{ route('kriteria.kriteria.edit', $item->id) }}'"
                                    type="button" class="btn btn-icon btn-outline-warning" title="Edit">
                                    <span class="tf-icons bx bx-edit"></span>
                                </button>
                                <!-- Delete button -->
                                <form action="{{ route('kriteria.kriteria.destroy', $item->id) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-icon btn-outline-danger" title="Delete"
                                        onclick="return confirm('Are you sure you want to delete this item?');">
                                        <span class="tf-icons bx bx-trash"></span>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
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
