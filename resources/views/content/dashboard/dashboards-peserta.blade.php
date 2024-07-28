
<!doctype html>

<html lang="en" class="light-style layout-menu-fixed layout-compact" dir="ltr" data-theme="theme-default"
    data-assets-path="../assets/" data-template="vertical-menu-template-free" data-style="light">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Dashboard</title>

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

            <!-- Content wrapper -->
            <div class="content-wrapper">
                <!-- Content -->
                @php
                    $user = Auth::user();
                    $peserta = Auth::user()->peserta;
                @endphp
                <div class="container-xxl flex-grow-1 container-p-y">
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <div class="col-md-12 col-xl-12">
                                <div class="card bg-info text-white">
                                    <div class="card-body">
                                        <h5 class="card-title text-white">Halo, Selamat Datang {{$user->name}}!</h5>
                                        <p class="card-text">Selamat Berjuang! </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="nav-align-top mb-3">
                                <ul class="nav nav-pills flex-column flex-md-row mb-6">
                                    <li class="nav-item">
                                        <a class="nav-link active" href="javascript:void(0);"><i
                                                class="bx bx-sm bx-user me-1_5"></i> Informasi Peserta</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{route('dashboard.status')}}"><i
                                                class="bx bx-sm bx-bell me-1_5"></i> Status Kelulusan</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{route('dashboard.upload')}}"
                                          ><i class="bx bx-sm bx-bell me-1_5"></i> Berkas Peserta</a
                                        >
                                      </li>
                                </ul>
                            </div>
                            <div class="card mb-6">
                                <!-- Account -->
                                <div class="card-body">
                                    <div class="d-flex align-items-start align-items-sm-center gap-6 pb-4 border-bottom">
                                        <img src="{{ $peserta->foto ? asset('storage/' . $peserta->foto) : asset('assets/img/avatars/1.png') }}"
                                            alt="user-avatar" class="d-block w-px-100 h-px-100 rounded" id="uploadedAvatar" />
                                
                                        <div class="button-wrapper">
                                            <label for="upload" class="btn btn-primary ms-3 mb-4" tabindex="0">
                                                <span class="d-none d-sm-block">{{ $user->name }}</span>
                                            </label>
                                            <button class="btn btn-outline-secondary disabled mb-4">
                                                <i class="bx bx-reset d-block d-sm-none"></i>
                                                <span class="d-none d-sm-block">Peserta PPAN</span>
                                            </button>
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                @csrf
                                            </form>
                                            <button class="btn btn-outline-danger mb-4" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                                <i class="bx bx-reset d-block d-sm-none"></i>
                                                <span class="d-none d-sm-block">Logout</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="card-body pt-4">
                                    <form id="formAccountSettings" method="POST" onsubmit="return false">
                                        <div class="row g-6">

                                            <div class="col-md-6">
                                                <label for="firstName" class="form-label">Name</label>
                                                <p>{{ $user->name }}</p>
                                            </div>

                                            <div class="col-md-6">
                                                <label for="firstName" class="form-label">Email</label>
                                                <p>{{ $user->email }}</p>
                                            </div>

                                            <div class="col-md-6">
                                                <label for="firstName" class="form-label">Jenis Kelamin</label>
                                                <p>{{ $peserta->jk == 'L' ? 'Laki-Laki' : 'Perempuan' }}</p>
                                            </div>

                                            @php
                                                $birthDate = new \DateTime($peserta->tgl_lahir);
                                                $today = new \DateTime('today');
                                                $age = $today->diff($birthDate)->y;
                                            @endphp
                                            <div class="col-md-6">
                                                <label for="firstName" class="form-label">Umur</label>
                                                <p>{{ $age }} Tahun</p>
                                            </div>


                                        </div>

                                    </form>
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
