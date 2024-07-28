<!doctype html>

<html lang="en" class="light-style layout-menu-fixed layout-compact" dir="ltr" data-theme="theme-default"
    data-assets-path="../assets/" data-template="vertical-menu-template-free" data-style="light">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Berkas Peserta</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="../assets/img/favicon/favicon.ico" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet" />

    <link rel="stylesheet" href="../assets/vendor/fonts/boxicons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="../assets/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="../assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="../assets/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="../assets/vendor/js/helpers.js"></script>
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="../assets/js/config.js"></script>
</head>

<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">
            <!-- Menu -->


            <!-- / Menu -->

            <!-- Layout container -->
            <!-- Navbar -->



            <!-- / Navbar -->

            @php
                use Illuminate\Support\Facades\Storage;
                $user = Auth::user();
                $peserta = $user->peserta;
                $status = $peserta->status_berkas;
            @endphp
            <!-- Content wrapper -->
            <div class="content-wrapper">
                <!-- Content -->


                <div class="container-xxl flex-grow-1 container-p-y">
                    <div class="col-md-12 mb-12">
                        <div class="col-md-12 col-xl-12">
                            <div class="card bg-info text-white">
                                <div class="card-body">
                                    <h5 class="card-title text-white">Halo, Selamat Datang {{ $user->name }}!</h5>
                                    <p class="card-text">Cek status kelulusan anda disini ya! </p>
                                </div>
                            </div>
                        </div>
                        <div class="nav-align-top mb-4 mt-4">
                            <ul class="nav nav-pills flex-column flex-md-row mb-6">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('dashboard.peserta') }}"><i
                                            class="bx bx-sm bx-user me-1_5"></i> Informasi Peserta</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('dashboard.status') }}"><i
                                            class="bx bx-sm bx-bell me-1_5"></i> Status Kelulusan</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link active" href="{{ route('dashboard.upload') }}"><i
                                            class="bx bx-sm bx-bell me-1_5"></i> Berkas Peserta</a>
                                </li>
                            </ul>
                        </div>
                        <!-- Basic Layout -->
                        <form action="{{ route('peserta.berkas.update') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf

                            <div class="row">
                                <div class="col-xl">
                                    <div class="card mb-6">
                                        <div class="card-header d-flex justify-content-between align-items-center">
                                            <h5 class="mb-0">Informasi Dasar</h5>
                                            <small class="text-body float-end">Info Dasar</small>
                                        </div>
                                        <div class="card-body">

                                            <div class="mb-4">
                                                <label for="formFile" class="form-label">Upload Foto <span
                                                        style="color: red;">*</span></label>
                                                @if ($peserta->foto)
                                                    <a href="{{ Storage::url($peserta->foto) }}" target="_blank">Lihat
                                                        Foto</a>
                                                @endif
                                                <input class="form-control" type="file" id="formFile" name="foto"
                                                    accept=".png" @if ($status != 'belum') disabled @endif />
                                            </div>

                                            <div class="mb-4">
                                                <label for="exampleFormControlSelect1" class="form-label">Jenis Kelamin
                                                    <span style="color: red;">*</span></label>
                                                <select class="form-select" id="exampleFormControlSelect1"
                                                    aria-label="Default select example" name="jk"
                                                    @if ($status != 'belum') disabled @endif>
                                                    <option value="">Pilih Jenis Kelamin</option>
                                                    <option value="L"
                                                        @if ($peserta->jk == 'L') selected @endif>Laki-laki
                                                    </option>
                                                    <option value="P"
                                                        @if ($peserta->jk == 'P') selected @endif>Perempuan
                                                    </option>
                                                </select>
                                            </div>

                                            <div class="mb-4 row">
                                                <label for="formFile" class="form-label">Tanggal Lahir <span
                                                        style="color: red;">*</span></label>
                                                <div class="col-md-12">
                                                    <input type="date" class="form-control" id="tgl_lahir"
                                                        name="tgl_lahir" value="{{ $peserta->tgl_lahir }}"
                                                        @if ($status != 'belum') disabled @endif>

                                                </div>
                                            </div>

                                            <div class="mb-4">
                                                <label for="exampleFormControlSelect1" class="form-label">Agama<span
                                                        style="color: red;">*</span></label>
                                                <select class="form-select" id="exampleFormControlSelect1"
                                                    aria-label="Default select example" name="agama"
                                                    @if ($status != 'belum') disabled @endif>
                                                    <option value="">Pilih Agama</option>
                                                    <option value="islam"
                                                        @if ($peserta->agama == 'islam') selected @endif>Islam</option>
                                                    <option value="kristen"
                                                        @if ($peserta->agama == 'kristen') selected @endif>Kristen
                                                    </option>
                                                    <option value="hindu"
                                                        @if ($peserta->agama == 'hindu') selected @endif>Hindu</option>
                                                    <option value="buddha"
                                                        @if ($peserta->agama == 'buddha') selected @endif>Buddha
                                                    </option>
                                                    <option value="konghucu"
                                                        @if ($peserta->agama == 'konghucu') selected @endif>Konghucu
                                                    </option>
                                                </select>
                                            </div>

                                            <div class="mb-4">
                                                <label for="exampleFormControlSelect1"
                                                    class="form-label">Provinsi<span
                                                        style="color: red;">*</span></label>
                                                <select class="form-select" id="provinsi"
                                                    aria-label="Default select example" name="provinsi_id"
                                                    onchange="filterKabupaten()"
                                                    @if ($status != 'belum') disabled @endif>
                                                    <option value="">Pilih Provinsi</option>
                                                    @foreach ($provinsi as $prov)
                                                        <option value="{{ $prov->id }}"
                                                            @if ($peserta->provinsi_id == $prov->id) selected @endif>
                                                            {{ $prov->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="mb-4">
                                                <label for="exampleFormControlSelect1"
                                                    class="form-label">Kabupaten<span
                                                        style="color: red;">*</span></label>
                                                <select class="form-select" id="kabupaten"
                                                    aria-label="Default select example" name="kabupaten_id"
                                                    @if ($status != 'belum') disabled @endif>
                                                    @foreach ($kabupaten as $kab)
                                                        <option value="{{ $kab->id }}"
                                                            @if ($peserta->kabupaten_id == $kab->id) selected @endif>
                                                            {{ $kab->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="mb-4">
                                                <label class="form-label" for="basic-default-fullname">Nomor Telepon
                                                    <span style="color: red;">*</span></label>
                                                <input type="number" class="form-control"
                                                    id="basic-default-fullname" placeholder="Nomor Telepon"
                                                    name="no_tlp" value="{{ $peserta->no_tlp }}"
                                                    @if ($status != 'belum') disabled @endif />
                                            </div>

                                            <div class="mb-4">
                                                <label for="exampleFormControlTextarea1" class="form-label">Akun
                                                    Sosial
                                                    Media <span style="color: red;">*</span></label>
                                                <textarea class="form-control" id="exampleFormControlTextarea1"
                                                    placeholder="Instagram : @pesertaIG, Facebook : PesertaFacebook" rows="3" name="sosial_media"
                                                    rows="3" @if ($status != 'belum') disabled @endif>{{ $peserta->sosial_media }}</textarea>
                                            </div>

                                            <div class="mb-4">
                                                <label class="form-label" for="basic-default-fullname">Pekerjaan <span
                                                        style="color: red;">*</span></label>
                                                <input type="text" class="form-control"
                                                    id="basic-default-fullname" placeholder="Pekerjaan"
                                                    name="pekerjaan" value="{{ $peserta->pekerjaan }}"
                                                    @if ($status != 'belum') disabled @endif />
                                            </div>

                                            <div class="mb-4">
                                                <label for="exampleFormControlTextarea1" class="form-label">Latar
                                                    Belakang
                                                    <span style="color: red;">*</span></label>
                                                <textarea class="form-control" id="exampleFormControlTextarea1" placeholder="Masukan Latar Belakang Pribadi Anda"
                                                    rows="3" name="latar_belakang" rows="3" @if ($status != 'belum') disabled @endif>{{ $peserta->latar_belakang }}</textarea>
                                            </div>

                                            <div class="mb-4">
                                                <label class="form-label" for="basic-default-fullname">Pernah Mengikuti Program Pertukaran? <span style="color: red;">*</span></label>
                                                <div class="form-check mt-3">
                                                    <input class="form-check-input" type="checkbox" id="defaultCheck1" name="isPertukaran" value="1"
                                                        @if ($peserta->isPertukaran) checked @endif
                                                        @if ($status != 'belum') disabled @endif />
                                                    <label class="form-check-label" for="defaultCheck1">
                                                        <span class="small" style="color:red">Klik Jika Pernah</span>
                                                    </label>
                                                </div>
                                            </div>
                                            

                                            <div class="mb-4">
                                                <label for="exampleFormControlTextarea1" class="form-label">Program
                                                    dan
                                                    Periode <span style="color: red;">*</span></label>
                                                <textarea class="form-control" id="exampleFormControlTextarea1" placeholder="Promgram A : Tahun xxxx - xxxx  "
                                                    rows="3" name="peran_organisasi" rows="3" @if ($status != 'belum') disabled @endif>{{ $peserta->peran_organisasi }}</textarea>
                                            </div>

                                            <div class="mb-4">
                                                <label for="exampleFormControlTextarea1" class="form-label">Organisasi
                                                    Dan
                                                    Periode <span style="color: red;">*</span></label>
                                                <textarea class="form-control" id="exampleFormControlTextarea1"
                                                    placeholder="Organisasi A : Tahun xxxx - xxxx  Peran : Sebagai ...." rows="3" name="motivasi"
                                                    rows="3" @if ($status != 'belum') disabled @endif>{{ $peserta->motivasi }}</textarea>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl">
                                    <div class="card mb-6">
                                        <div class="card-header d-flex justify-content-between align-items-center">
                                            <h5 class="mb-0">Berkas</h5>
                                            <small class="text-muted float-end">File Berkas</small>
                                        </div>
                                        <div class="card-body">
                                            <form action="{{ route('peserta.berkas.update') }}" method="POST"
                                                enctype="multipart/form-data">
                                                @csrf
                                                <div class="mb-4">
                                                    <label for="formFile" class="form-label">Upload Ijazah <span
                                                            style="color: red;">*</span></label>
                                                    @if ($peserta->file_ijazah)
                                                        <a href="{{ Storage::url($peserta->file_ijazah) }}"
                                                            target="_blank">Lihat Ijazah</a>
                                                    @endif
                                                    <input class="form-control" type="file" id="formFile"
                                                        name="file_ijazah" accept=".pdf, .jpg, .png"
                                                        @if ($status != 'belum') disabled @endif />
                                                    <p class="mt-2"
                                                        style="font-size: small; color: rgb(214, 193, 247);">
                                                        Document Format : PDF, IMAGE</p>
                                                </div>
                                                <div class="mb-4">
                                                    <label for="formFile" class="form-label">Upload KTP <span
                                                            style="color: red;">*</span></label>
                                                    @if ($peserta->file_ktp)
                                                        <a href="{{ Storage::url($peserta->file_ktp) }}"
                                                            target="_blank">Lihat KTP</a>
                                                    @endif
                                                    <input class="form-control" type="file" id="formFile"
                                                        name="file_ktp" accept=".jpg, .png"
                                                        @if ($status != 'belum') disabled @endif />
                                                    <p class="mt-2"
                                                        style="font-size: small; color: rgb(214, 193, 247);">
                                                        Document Format : PDF, IMAGE</p>
                                                </div>
                                                <div class="mb-4">
                                                    <label for="formFile" class="form-label">Upload CV <span
                                                            style="color: red;">*</span></label>
                                                    @if ($peserta->file_cv)
                                                        <a href="{{ Storage::url($peserta->file_cv) }}"
                                                            target="_blank">Lihat
                                                            CV</a>
                                                    @endif
                                                    <input class="form-control" type="file" id="formFile"
                                                        name="file_cv" accept=".pdf"
                                                        @if ($status != 'belum') disabled @endif />
                                                    <p class="mt-2"
                                                        style="font-size: small; color: rgb(214, 193, 247);">
                                                        Document Format : PDF, IMAGE</p>
                                                </div>
                                                <div class="mb-4">
                                                    <label for="formFile" class="form-label">Upload Transkrip <span
                                                            style="color: red;">*</span></label>
                                                    @if ($peserta->file_score_report)
                                                        <a href="{{ Storage::url($peserta->file_score_report) }}"
                                                            target="_blank">Lihat Transkrip</a>
                                                    @endif
                                                    <input class="form-control" type="file" id="formFile"
                                                        name="file_transkrip" accept=".pdf"
                                                        @if ($status != 'belum') disabled @endif />
                                                    <p class="mt-2"
                                                        style="font-size: small; color: rgb(214, 193, 247);">
                                                        Document Format : PDF</p>
                                                </div>
                                                <div class="mb-4">
                                                    <label for="formFile" class="form-label">Upload Kegiatan Sosial
                                                        <span style="color: red;">*</span></label>
                                                    @if ($peserta->file_kegiatan_sosial)
                                                        @foreach (json_decode($peserta->file_kegiatan_sosial) as $file)
                                                            <a href="{{ Storage::url($file) }}" target="_blank">Lihat
                                                                Kegiatan Sosial</a><br>
                                                        @endforeach
                                                    @endif
                                                    <input class="form-control" type="file" id="formFile"
                                                        name="file_kegiatan_sosial[]" multiple
                                                        @if ($status != 'belum') disabled @endif />
                                                    <p class="mt-2"
                                                        style="font-size: small; color: rgb(214, 193, 247);">
                                                        Document Format : PDF</p>
                                                </div>
                                                <div class="mb-4">
                                                    <label for="formFile" class="form-label">Upload Penghargaan <span
                                                            style="color: red;">*</span></label>
                                                    @if ($peserta->file_penghargaan)
                                                        @foreach (json_decode($peserta->file_penghargaan) as $file)
                                                            <a href="{{ Storage::url($file) }}" target="_blank">Lihat
                                                                Penghargaan</a><br>
                                                        @endforeach
                                                    @endif
                                                    <input class="form-control" type="file" id="formFile"
                                                        name="file_penghargaan[]" multiple
                                                        @if ($status != 'belum') disabled @endif />
                                                    <p class="mt-2"
                                                        style="font-size: small; color: rgb(214, 193, 247);">
                                                        Document Format : PDF</p>
                                                </div>
                                                <div class="mb-4">
                                                    <label for="formFile" class="form-label">Upload Surat Rekomendasi
                                                        <span style="color: red;">(Optional)</span></label>
                                                    @if ($peserta->file_surat_rekomendasi)
                                                        <a href="{{ Storage::url($peserta->file_surat_rekomendasi) }}"
                                                            target="_blank">Lihat Surat Rekomendasi</a>
                                                    @endif
                                                    <input class="form-control" type="file" id="formFile"
                                                        name="file_surat_rekomendasi" accept=".pdf"
                                                        @if ($status != 'belum') disabled @endif />
                                                    <p class="mt-2"
                                                        style="font-size: small; color: rgb(214, 193, 247);">
                                                        Document Format : PDF</p>
                                                </div>
                                                <button type="button" class="btn btn-secondary btn-block"
                                                    onclick="window.history.back()">Back</button>

                                                <button type="submit" class="btn btn-primary"
                                                    @if ($status != 'belum') disabled @endif>Send</button>


                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>

                    </div>

                    <div class="content-backdrop fade"></div>
                </div>
                <!-- Content wrapper -->
                <!-- / Layout page -->
            </div>

            <!-- Overlay -->
            <div class="layout-overlay layout-menu-toggle"></div>
        </div>
        <!-- / Layout wrapper -->



        <!-- Core JS -->
        <!-- build:js assets/vendor/js/core.js -->

        <script src="../assets/vendor/libs/jquery/jquery.js"></script>
        <script src="../assets/vendor/libs/popper/popper.js"></script>
        <script src="../assets/vendor/js/bootstrap.js"></script>
        <script src="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
        <script src="../assets/vendor/js/menu.js"></script>

        <!-- endbuild -->

        <!-- Vendors JS -->

        <!-- Main JS -->
        <script src="../assets/js/main.js"></script>

        <!-- Page JS -->

        <!-- Place this tag before closing body tag for github widget button. -->
        <script async defer src="https://buttons.github.io/buttons.js"></script>
        <script>
            const kabupatenData = @json($kabupaten);

            function filterKabupaten() {
                const provinsiId = document.getElementById('provinsi').value;
                const kabupatenSelect = document.getElementById('kabupaten');
                kabupatenSelect.innerHTML = '<option value="">Pilih Kabupaten</option>'; // Reset kabupaten options

                if (provinsiId) {
                    const filteredKabupaten = kabupatenData.filter(kab => kab.province_id == provinsiId);
                    filteredKabupaten.forEach(kab => {
                        const option = document.createElement('option');
                        option.value = kab.id;
                        option.textContent = kab.name;
                        kabupatenSelect.appendChild(option);
                    });
                }
            }
        </script>
</body>

</html>
