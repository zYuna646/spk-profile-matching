@php
    $isMenu = false;
    $navbarHideToggle = false;
@endphp
@extends('layouts/contentNavbarLayout')

@section('title', 'Dashboard - Peserta')

@section('content')
    @php
        $status = 'rejectaed';
        $progress = 1;
    @endphp
    <div class="row">
        <div class="col-lg-8 mb-4">
            <!-- Progress Bar -->
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Progress Peserta</h5>
                    <div class="progress">
                        <div class="progress-bar bg-info" role="progressbar" style="width: 25%;" aria-valuenow="0"
                            aria-valuemin="0" aria-valuemax="100">Lengkapi Berkas</div>
                    </div>
                </div>
            </div>
            <!--/ Progress Bar -->

            @if ($status === 'rejected')
                <!-- Komentar Jika Ditolak -->
                <div class="card mt-4">
                    <div class="card-body">
                        <h5 class="card-title">Komentar Jika Ditolak</h5>
                        <p>Berkas Anda belum lengkap. Silakan lengkapi berkas Anda sesuai dengan petunjuk yang diberikan.
                        </p>
                        <a href="#" class="btn btn-sm btn-outline-danger">Revisi Berkas</a>
                    </div>
                </div>
                <!--/ Komentar Jika Ditolak -->
            @endif

            <!-- Formulir Utama dengan Tab -->
            <div class="card mt-4">
                <div class="card-body">
                    <h5 class="card-title">Formulir Peserta</h5>
                    <form action="{{ url('/') }}" method="POST">
                        @csrf
                        <ul class="nav nav-tabs" id="profileTabs" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="basicInfo-tab" data-bs-toggle="tab"
                                    data-bs-target="#basicInfo" type="button" role="tab" aria-controls="basicInfo"
                                    aria-selected="true">Informasi Dasar</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="additionalInfo-tab" data-bs-toggle="tab"
                                    data-bs-target="#additionalInfo" type="button" role="tab"
                                    aria-controls="additionalInfo" aria-selected="false">Informasi Tambahan</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="documents-tab" data-bs-toggle="tab" data-bs-target="#documents"
                                    type="button" role="tab" aria-controls="documents"
                                    aria-selected="false">Dokumen</button>
                            </li>
                        </ul>
                        <div class="tab-content mt-3" id="profileTabsContent">
                            <!-- Tab Informasi Dasar -->
                            <div class="tab-pane fade show active" id="basicInfo" role="tabpanel"
                                aria-labelledby="basicInfo-tab">
                                <div class="mb-3">
                                    <label for="jk" class="form-label">Jenis Kelamin</label>
                                    <select class="form-select" id="jk" name="jk">
                                        <option value="L">Laki-laki</option>
                                        <option value="P">Perempuan</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="tgl_lahir" class="form-label">Tanggal Lahir</label>
                                    <input type="date" class="form-control" id="tgl_lahir" name="tgl_lahir">
                                </div>
                                <div class="mb-3">
                                    <label for="agama" class="form-label">Agama</label>
                                    <input type="text" class="form-control" id="agama" name="agama">
                                </div>
                                <div class="mb-3">
                                    <label for="asal" class="form-label">Asal</label>
                                    <input type="text" class="form-control" id="asal" name="asal">
                                </div>
                                <div class="mb-3">
                                    <label for="no_tlp" class="form-label">Nomor Telepon</label>
                                    <input type="text" class="form-control" id="no_tlp" name="no_tlp">
                                </div>
                                <div class="mb-3">
                                    <label for="sosial_media" class="form-label">Akun Media Sosial</label>
                                    <input type="text" class="form-control" id="sosial_media" name="sosial_media">
                                </div>
                                <div class="mb-3">
                                    <label for="pekerjaan" class="form-label">Pekerjaan</label>
                                    <input type="text" class="form-control" id="pekerjaan" name="pekerjaan">
                                </div>
                                <div class="mb-3">
                                    <label for="latar_belakang" class="form-label">Latar Belakang</label>
                                    <textarea class="form-control" id="latar_belakang" name="latar_belakang" rows="3"></textarea>
                                </div>
                                <div class="mb-3 form-check">
                                    <input type="checkbox" class="form-check-input" id="isAnggota" name="isAnggota">
                                    <label class="form-check-label" for="isAnggota">Anggota Organisasi?</label>
                                </div>
                            </div>

                            <!-- Tab Informasi Tambahan -->
                            <div class="tab-pane fade" id="additionalInfo" role="tabpanel"
                                aria-labelledby="additionalInfo-tab">
                                <div id="organisasiSection" style="display: none;">
                                    <div class="mb-3">
                                        <label for="name_organisasi" class="form-label">Nama Organisasi</label>
                                        <input type="text" class="form-control" id="name_organisasi"
                                            name="name_organisasi">
                                    </div>
                                    <div class="mb-3">
                                        <label for="desc_organisasi" class="form-label">Deskripsi Organisasi</label>
                                        <textarea class="form-control" id="desc_organisasi" name="desc_organisasi" rows="3"></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="peran_organisasi" class="form-label">Peran dalam Organisasi</label>
                                        <input type="text" class="form-control" id="peran_organisasi"
                                            name="peran_organisasi">
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="desc_essai" class="form-label">Deskripsi Essai</label>
                                    <textarea class="form-control" id="desc_essai" name="desc_essai" rows="3"></textarea>
                                </div>
                                <div class="mb-3 form-check">
                                    <input type="checkbox" class="form-check-input" id="isPertukaran"
                                        name="isPertukaran">
                                    <label class="form-check-label" for="isPertukaran">Pertukaran Program?</label>
                                </div>
                                <div class="mb-3">
                                    <label for="motivasi_essai" class="form-label">Motivasi Essai</label>
                                    <textarea class="form-control" id="motivasi_essai" name="motivasi_essai" rows="3"></textarea>
                                </div>
                            </div>

                            <!-- Tab Dokumen -->
                            <div class="tab-pane fade" id="documents" role="tabpanel" aria-labelledby="documents-tab">
                                <div class="mb-3">
                                    <label for="file_ktp" class="form-label">Upload KTP</label>
                                    <input type="file" class="form-control" id="file_ktp" name="file_ktp">
                                </div>
                                <div class="mb-3">
                                    <label for="file_cv" class="form-label">Upload CV</label>
                                    <input type="file" class="form-control" id="file_cv" name="file_cv">
                                </div>
                                <div class="mb-3">
                                    <label for="file_ijazah" class="form-label">Upload Ijazah</label>
                                    <input type="file" class="form-control" id="file_ijazah" name="file_ijazah">
                                </div>
                                <!-- Handle multiple file uploads if needed -->
                                <div class="mb-3">
                                    <label for="file_kegiatan_sosial" class="form-label">Upload File Kegiatan
                                        Sosial</label>
                                    <input type="file" class="form-control" id="file_kegiatan_sosial"
                                        name="file_kegiatan_sosial[]" multiple>
                                </div>
                                <div class="mb-3">
                                    <label for="file_score_report" class="form-label">Upload Laporan Nilai</label>
                                    <input type="file" class="form-control" id="file_score_report"
                                        name="file_score_report">
                                </div>
                                <!-- Handle JSON file uploads if needed -->
                                <div class="mb-3">
                                    <label for="file_penghargaan" class="form-label">Upload File Penghargaan</label>
                                    <input type="file" class="form-control" id="file_penghargaan"
                                        name="file_penghargaan[]" multiple>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
            <!--/ Formulir Utama dengan Tab -->
        </div>

        <!-- Informasi Peserta -->
        <div class="col-lg-4 mb-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Informasi Peserta</h5>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Nama Peserta
                            <span class="badge bg-primary rounded-pill">Peserta</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Email
                            <span class="badge bg-primary rounded-pill">peserta@example.com</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Status
                            <span class="badge bg-success rounded-pill">Peserta Baru</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!--/ Informasi Peserta -->
    </div>

    <!-- Script untuk Bootstrap Tabs -->
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
    </script>
@endsection
