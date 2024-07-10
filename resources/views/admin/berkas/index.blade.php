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
            <form action="{{ route('pendaftaran.berkas.index') }}" method="GET" class="mb-3">
                <div class="row g-3 align-items-center">
                    <div class="col-auto">
                        <label for="periode" class="col-form-label">Berdasarkan Periode:</label>
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
                        <label for="status" class="col-form-label">Berdasarkan Status Berkas:</label>
                    </div>
                    <div class="col-auto">
                        <select name="status" id="status" class="form-select">
                            <option value="">Pilih Status</option>
                            <option value="proses">Proses</option>
                            <option value="terima">Terima</option>
                            <option value="tolak">Tolak</option>
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
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $item)
                        <tr>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->email }}</td>
                            <td>{{ $item->peserta->pendaftaran->name }}</td>
                            <td>{{ $item->peserta->status_berkas }}</td>
                            <td>
                                <!-- Edit button -->
                                <button onclick="window.location.href='{{ route('pendaftaran.berkas.show', $item->id) }}'"
                                    type="button" class="btn btn-icon btn-outline-warning" title="Lihat">
                                    <span class="tf-icons bx bx-show"></span>
                                </button>

                                <!-- Accept button -->
                                <form action="{{ route('berkas.terima', $item) }}" method="POST" style="display:inline;">
                                    @csrf
                                    <button type="submit" class="btn btn-icon btn-outline-success" title="Accept">
                                        <span class="tf-icons bx bx-check"></span>
                                    </button>
                                </form>

                                <!-- Reject button -->
                                <button type="button" class="btn btn-icon btn-outline-danger" title="Reject"
                                    data-bs-toggle="modal" data-bs-target="#rejectModal{{ $item->id }}">
                                    <span class="tf-icons bx bx-x"></span>
                                </button>

                                <!-- Modal for rejection -->
                                <div class="modal fade" id="rejectModal{{ $item->id }}" tabindex="-1"
                                    aria-labelledby="rejectModalLabel{{ $item->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="rejectModalLabel{{ $item->id }}">Alasan
                                                    Penolakan</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <form action="{{ route('berkas.tolak', $item) }}" method="POST">
                                                @csrf
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label for="rejectionReason" class="col-form-label">Alasan:</label>
                                                        <textarea class="form-control" id="rejectionReason" name="msg" required></textarea>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Tutup</button>
                                                    <button type="submit" class="btn btn-danger">Tolak</button>
                                                </div>
                                            </form>

                                        </div>
                                    </div>
                                </div>
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
    <script>
        var tabTriggerList = document.querySelectorAll('#profileTabs button')
        tabTriggerList.forEach(function(tabTrigger) {
            var tabPaneId = tabTrigger.getAttribute('data-bs-target');
            tabTrigger.addEventListener('click', function(event) {
                event.preventDefault();
                var tabPane = document.querySelector(tabPaneId);
                var tabContent = tabPane.closest('.tab-content');
                var activeTabs = tabContent.querySelectorAll('.tab-pane.active');
                activeTabs.forEach(function(tab) {
                    tab.classList.remove('active');
                });
                tabPane.classList.add('active');
            });
        });

        // Toggle visibility of organisasiSection based on isAnggota checkbox
        var isAnggotaCheckbox = document.getElementById('isAnggota');
        var organisasiSection = document.getElementById('organisasiSection');

        isAnggotaCheckbox.addEventListener('change', function() {
            if (this.checked) {
                organisasiSection.style.display = 'block';
            } else {
                organisasiSection.style.display = 'none';
            }
        });

        // Initialize visibility based on initial checkbox state
        if (isAnggotaCheckbox.checked) {
            organisasiSection.style.display = 'block';
        } else {
            organisasiSection.style.display = 'none';
        }

        // Fetch Kabupaten based on Provinsi
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

        // Preview selected photo
        document.getElementById('foto').addEventListener('change', function(event) {
            var reader = new FileReader();
            reader.onload = function() {
                var output = document.getElementById('fotoPreview');
                output.src = reader.result;
                output.style.display = 'block';
            };
            reader.readAsDataURL(event.target.files[0]);
        });
    </script>
@endsection
