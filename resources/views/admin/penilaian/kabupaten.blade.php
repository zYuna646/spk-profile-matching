@extends('layouts.contentNavbarLayout')

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
            <form action="{{ route('penilaian.kabupaten') }}" method="GET" class="mb-3">
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

                    <div class="col-auto">
                        <label for="kabupaten" class="col-form-label">Kabupaten:</label>
                    </div>
                    <div class="col-auto">
                        <select name="kabupaten" id="kabupaten" class="form-select" disabled>
                            <option value="">Pilih Kabupaten</option>
                        </select>
                    </div>
                    <div class="col-auto">
                        <button type="submit" class="btn btn-primary">Filter</button>
                    </div>
                </div>
            </form>

            <table id="table_config" class="display" style="width:100%; height: 100%;">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Periode</th>
                        <th>Provinsi</th>
                        <th>Kabupaten</th>
                        <th>Penilaian</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $item)
                        <tr>
                            <td>{{ $item->user->name }}</td>
                            <td>{{ $item->user->email }}</td>
                            <td>{{ $item->pendaftaran->name }}</td>
                            <td>{{ $item->provinsi->name }}</td>
                            <td>{{ $item->kabupaten->name }}</td>
                            <td>

                                <button type="button" class="btn btn-icon btn-outline-primary" title="Penilaian"
                                    data-bs-toggle="modal" data-bs-target="#assessmentModalTambah{{ $item->id }}">
                                    <span class="tf-icons bx bx-pencil"></span>
                                </button>

                                <!-- Modal for adding assessment -->
                                <div class="modal fade" id="assessmentModalTambah{{ $item->id }}" tabindex="-1"
                                    aria-labelledby="assessmentModalTambahLabel{{ $item->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="assessmentModalTambahLabel{{ $item->id }}">
                                                    Input Penilaian
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <form action="{{ route('penilaian.update.kabupaten', $item->id) }}"
                                                method="POST">
                                                @csrf
                                                <div class="modal-body">
                                                    @foreach ($kriteria as $criterion)
                                                        <div class="mb-3">
                                                            <label for="nilai_{{ $criterion->id }}"
                                                                class="col-form-label">{{ $criterion->name }}</label>
                                                            @foreach ($criterion->subKriteria as $subKriteria)
                                                                <div class="mb-2">
                                                                    <label for="subnilai_{{ $subKriteria->id }}"
                                                                        class="col-form-label">{{ $subKriteria->name }}</label>
                                                                    <input type="number" class="form-control"
                                                                        id="subnilai_{{ $subKriteria->id }}"
                                                                        name="subnilai[{{ $criterion->id }}][{{ $subKriteria->id }}]"
                                                                        min="1" max="5" required
                                                                        value="{{ $item->penilaian->nilai->where('sub_kriteria_id', $subKriteria->id)->first()->nilai ?? '' }}">
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    @endforeach
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Batal</button>
                                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <button
                                    onclick="window.location.href='{{ route('pendaftaran.berkas.show', $item->user->id) }}'"
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
