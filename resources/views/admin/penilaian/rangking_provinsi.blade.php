@extends('layouts/contentNavbarLayout')

@section('title', 'Fluid - Layouts')

@section('content')
    <!-- Layout Demo -->
    <div class="card h-100">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="card-title mb-0">Berkas Pendaftaran</h5>
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

            <!-- Filter Form -->
            <form action="{{ route('rangking.provinsi') }}" method="GET" class="mb-3">
                <div class="row g-3 align-items-center">
                    <div class="col-auto">
                        <label for="periode" class="col-form-label">Periode:</label>
                    </div>
                    <div class="col-auto">
                        <select name="periode" id="periode" class="form-select">
                            <option value="">Pilih Periode</option>
                            @foreach ($periodes as $periode)
                                <option value="{{ $periode->id }}">{{ $periode->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-auto">
                        <label for="provinsi" class="col-form-label">Provinsi:</label>
                    </div>
                    <div class="col-auto">
                        <select name="provinsi" id="provinsi" class="form-select">
                            <option value="">Pilih Provinsi</option>
                            @foreach ($provinsi as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>

                </div>
            </form>

            <div class="mb-3">
                <a href="{{ route('provinsi.rangking', ['prov_id' => $prov->id ?? 'a', 'periode' => $per->id ?? 'a']) }}"
                    class="btn btn-info">Cetak
                    Laporan
                    Rangking</a>
                <a href="{{ route('provinsi.status', ['prov_id' => $prov->id ?? 'a', 'periode' => $per->id ?? 'a']) }}"
                    class="btn btn-warning">Cetak
                    Laporan
                    Status</a>
            </div>

            <table id="table_config" class="display" style="width:100%; height: 100%;">
                <thead>
                    <tr>
                        <td>Rank</td>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Periode</th>
                        <th>Provinsi</th>
                        <th>Kabupaten</th>
                        <th>Nilai</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($rangking as $key => $item)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $item['peserta']->user->name }}</td>
                            <td>{{ $item['peserta']->user->email }}</td>
                            <td>{{ $item['peserta']->pendaftaran->name }}</td>
                            <td>{{ $item['peserta']->provinsi->name }}</td>
                            <td>{{ $item['peserta']->kabupaten->name }}</td>
                            <td>{{ $item['nilai'] }}</td>
                            <td>
                                @if ($item['peserta']->status == 'lolos-seleksi-provinsi')
                                    <span class="badge bg-success">Diterima</span>
                                @elseif ($item['peserta']->status == 'gugur-seleksi-provinsi')
                                    <span class="badge bg-danger">Ditolak</span>
                                @else
                                    <form action="{{ route('provinsi.terima', $item['peserta']) }}" method="POST"
                                        style="display:inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-icon btn-outline-success" title="Accept">
                                            <span class="tf-icons bx bx-check"></span>
                                        </button>
                                    </form>
                                    <form action="{{ route('provinsi.tolak', $item['peserta']) }}" method="POST"
                                        style="display:inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-icon btn-outline-danger" title="Accept">
                                            <span class="tf-icons bx bx-x"></span>
                                        </button>
                                    </form>
                                @endif



                            </td>
                            <td>
                                <button
                                    onclick="window.location.href='{{ route('pendaftaran.berkas.show', $item['peserta']->user->id) }}'"
                                    type="button" class="btn btn-icon btn-outline-warning" title="Lihat">
                                    <span class="tf-icons bx bx-show"></span>
                                </button>

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

        document.getElementById('provinsi').addEventListener('change', function() {
            var provinsiId = this.value;
            var kabupatenSelect = document.getElementById('kabupaten');

            if (provinsiId) {
                fetch('/get-kabupaten/' + provinsiId)
                    .then(response => response.json())
                    .then(data => {
                        kabupatenSelect.innerHTML = '<option value="">Pilih Kabupaten</option>';
                        data.forEach(function(kabupaten) {
                            var option = document.createElement('option');
                            option.value = kabupaten.id;
                            option.text = kabupaten.name;
                            kabupatenSelect.appendChild(option);
                        });
                        kabupatenSelect.disabled = false;
                    });
            } else {
                kabupatenSelect.innerHTML = '<option value="">Pilih Kabupaten</option>';
                kabupatenSelect.disabled = true;
            }
        });
    </script>
@endsection
