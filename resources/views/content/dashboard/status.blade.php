
<!doctype html>

<html lang="en" class="light-style layout-menu-fixed layout-compact" dir="ltr" data-theme="theme-default"
    data-assets-path="../assets/" data-template="vertical-menu-template-free" data-style="light">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Status Peserta</title>

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



            <!-- Layout container -->
            <!-- Navbar -->



            <!-- / Navbar -->

            <!-- Content wrapper -->
            <div class="content-wrapper">
                @php
                    $user = Auth::user();
                    $peserta = $user->peserta;
                @endphp
                <!-- Content -->

                <div class="container-xxl flex-grow-1 container-p-y">
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <div class="col-md-12 col-xl-12">
                                <div class="card bg-info text-white">
                                    <div class="card-body">
                                        <h5 class="card-title text-white">Halo, Selamat Datang {{ $user->name }}!</h5>
                                        <p class="card-text">Cek status kelulusan anda disini ya! </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 ">
                            <div class="nav-align-top mb-3">
                                <ul class="nav nav-pills flex-column flex-md-row mb-6">
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('dashboard.peserta') }}"><i
                                                class="bx bx-sm bx-user me-1_5"></i> Informasi Peserta</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link active" href="kelulusan.html"><i
                                                class="bx bx-sm bx-bell me-1_5"></i> Status Kelulusan</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('dashboard.upload') }}"><i
                                                class="bx bx-sm bx-bell me-1_5"></i> Berkas Peserta</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="card mb-6">
                                <!-- Account -->
                                <div class="card-body">
                                    <div
                                        class="d-flex align-items-start align-items-sm-center gap-6 pb-4 border-bottom">
                                        <h5 class="card-header"> Status Berkas</h5>
                                        @if ($peserta->status_berkas == 'belum')
                                            <span class="badge bg-danger">Belum Melengkapi Berkas</span>
                                        @elseif ($peserta->status_berkas == 'proses')
                                            <span class="badge bg-warning">Pengajuan Berkas Diproses</span>
                                        @elseif ($peserta->status_berkas == 'tolak')
                                            <span class="badge bg-secondary">Gugur Seleksi Administrasi</span>
                                        @elseif ($peserta->status_berkas == 'terima')
                                            <span class="badge bg-success">Lolos Seleksi Administrasi</span>
                                        @endif

                                    </div>
                                </div>
                                <div class="card-body">
                                    <div
                                        class="d-flex align-items-start align-items-sm-center gap-6 pb-4 border-bottom">
                                        <h5 class="card-header"> Status Kelulusan</h5>
                                        @if ($peserta->status == 'lolos-seleksi-provinsi')
                                            <span class="badge bg-success">Lulus Seleksi Provinsi</span>
                                        @elseif ($peserta->status == 'gugur-seleksi-provinsi')
                                            <span class="badge bg-secondary">Gugur Seleksi Provinsi</span>
                                        @elseif ($peserta->status == 'lolos-seleksi-kabupaten')
                                            <span class="badge bg-success">Lulus Seleksi Kabupaten</span>
                                        @elseif ($peserta->status == 'gugur-seleksi-kabupaten')
                                            <span class="badge bg-secondary">Gugur Seleksi Kabupaten</span>
                                        @else
                                            <span class="badge bg-danger">Masih Dalam Periode Pendaftaran</span>
                                        @endif
                                    </div>
                                </div>
                                <!-- /Account -->
                            </div>
                        </div>
                    </div>
                </div>
                <!-- / Content -->



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
    <script src="../assets/js/pages-account-settings-account.js"></script>

    <!-- Place this tag before closing body tag for github widget button. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
</body>

</html>
