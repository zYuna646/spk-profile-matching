<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AlumniController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BerkasController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KriteriaController;
use App\Http\Controllers\PenilaiController;
use App\Http\Controllers\PeriodeController;
use App\Http\Controllers\PesertaController;
use App\Http\Controllers\SubController;
use App\Http\Controllers\VerificatorController;
use App\Http\Controllers\WilayahController;
use App\Models\Kriteria;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\dashboard\Analytics;
use App\Http\Controllers\layouts\WithoutMenu;
use App\Http\Controllers\layouts\WithoutNavbar;
use App\Http\Controllers\layouts\Fluid;
use App\Http\Controllers\layouts\Container;
use App\Http\Controllers\layouts\Blank;
use App\Http\Controllers\pages\AccountSettingsAccount;
use App\Http\Controllers\pages\AccountSettingsNotifications;
use App\Http\Controllers\pages\AccountSettingsConnections;
use App\Http\Controllers\pages\MiscError;
use App\Http\Controllers\pages\MiscUnderMaintenance;
use App\Http\Controllers\authentications\LoginBasic;
use App\Http\Controllers\authentications\RegisterBasic;
use App\Http\Controllers\authentications\ForgotPasswordBasic;
use App\Http\Controllers\cards\CardBasic;
use App\Http\Controllers\user_interface\Accordion;
use App\Http\Controllers\user_interface\Alerts;
use App\Http\Controllers\user_interface\Badges;
use App\Http\Controllers\user_interface\Buttons;
use App\Http\Controllers\user_interface\Carousel;
use App\Http\Controllers\user_interface\Collapse;
use App\Http\Controllers\user_interface\Dropdowns;
use App\Http\Controllers\user_interface\Footer;
use App\Http\Controllers\user_interface\ListGroups;
use App\Http\Controllers\user_interface\Modals;
use App\Http\Controllers\user_interface\Navbar;
use App\Http\Controllers\user_interface\Offcanvas;
use App\Http\Controllers\user_interface\PaginationBreadcrumbs;
use App\Http\Controllers\user_interface\Progress;
use App\Http\Controllers\user_interface\Spinners;
use App\Http\Controllers\user_interface\TabsPills;
use App\Http\Controllers\user_interface\Toasts;
use App\Http\Controllers\user_interface\TooltipsPopovers;
use App\Http\Controllers\user_interface\Typography;
use App\Http\Controllers\extended_ui\PerfectScrollbar;
use App\Http\Controllers\extended_ui\TextDivider;
use App\Http\Controllers\icons\Boxicons;
use App\Http\Controllers\form_elements\BasicInput;
use App\Http\Controllers\form_elements\InputGroups;
use App\Http\Controllers\form_layouts\VerticalForm;
use App\Http\Controllers\form_layouts\HorizontalForm;
use App\Http\Controllers\tables\Basic as TablesBasic;

// Main Page Route
Route::get('/', [DashboardController::class, 'home'])->name('dashboard.home');
Route::get('/home/alumni', [DashboardController::class, 'alumni'])->name('dashboard.alumni');



// authentication
Route::get('/auth/login', [AuthController::class, 'login'])->name('login');
Route::post('/auth/login', [AuthController::class, 'authenticate'])->name('login.submit');
Route::get('/auth/register', [AuthController::class, 'register'])->name('register');
Route::post('/auth/register', [AuthController::class, 'create'])->name('register.submit');
Route::get('/auth/forgot', [AuthController::class, 'forgot'])->name('forgot');
Route::get('/auth/profile', [AuthController::class, 'profile'])->name('profile');
Route::put('/auth/update', [AuthController::class, 'update'])->name('update');
Route::post('/auth/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/get-provinsi', [WilayahController::class, 'getProvinsi'])->name('getProvinsi');
Route::get('/get-kabupaten/{idProvinsi}', [WilayahController::class, 'getKabupaten'])->name('getKabupaten');
Route::get('/get-kecamatan/{idKabupaten}', [WilayahController::class, 'getKecamatan'])->name('getKecamatan');
Route::get('/get-kelurahan/{idKelurahan}', [WilayahController::class, 'getKelurahan'])->name('getKelurahan');

// dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/dashboard/peserta', [DashboardController::class, 'peserta'])->name('dashboard.peserta');
Route::get('/dashboard/upload', [DashboardController::class, 'upload'])->name('dashboard.upload');
Route::get('/dashboard/status', [DashboardController::class, 'status'])->name('dashboard.status');


// administrator
Route::prefix('administrator')
  ->name('administrator.')
  ->group(function () {
    Route::resource('users', VerificatorController::class);
  });

Route::prefix('penilai')
  ->name('penilai.')
  ->group(function () {
    Route::resource('users', PenilaiController::class);
  });

Route::prefix('pimpinan')
  ->name('pimpinan.')
  ->group(function () {
    Route::resource('users', PesertaController::class);
  });

Route::prefix('peserta')
  ->name('peserta.')
  ->group(function () {
    Route::get('users/status/{status}', [PesertaController::class, 'status'])->name('users.status');
    Route::resource('users', PesertaController::class);
    Route::post('users/{user}', [PesertaController::class, 'update'])->name('users.update');
  });

Route::prefix('pendaftaran')
  ->name('pendaftaran.')
  ->group(function () {
    Route::resource('periode', PeriodeController::class);
  });

Route::prefix('kriteria')->name('kriteria.')->group(function () {
  Route::resource('kriteria', KriteriaController::class);
  Route::resource('sub', SubController::class);

});

Route::prefix('pendaftaran')
  ->name('pendaftaran.')
  ->group(function () {
    Route::get('berkas/filter', [PesertaController::class, 'filter'])->name('berkas.filter');

    Route::resource('berkas', BerkasController::class);
  });

Route::post('berkas/terima/{id}', [VerificatorController::class, 'accept'])->name('berkas.terima');
Route::post('berkas/tolak/{id}', [VerificatorController::class, 'reject'])->name('berkas.tolak');

Route::resource('alumni', AlumniController::class);
Route::post('peserta/berkas/update', [PesertaController::class, 'updateBerkas'])->name('peserta.berkas.update');
Route::get('penilaian/kabupaten', [BerkasController::class, 'penilaian_kabupaten'])->name('penilaian.kabupaten');
Route::get('penilaian/provinsi', [BerkasController::class, 'penilaian_provinsi'])->name('penilaian.provinsi');
Route::get('rangking/provinsi', [BerkasController::class, 'rangking_provinsi'])->name('rangking.provinsi');
Route::get('rangking/kabupaten', [BerkasController::class, 'rangking_kabupaten'])->name('rangking.kabupaten');
Route::get('rangking/show/kab/{id}',[PenilaiController::class, 'show_detail_kab'] )->name('rangking.show.kab');
Route::get('rangking/show/prov/{id}',[PenilaiController::class, 'show_detail_prov'] )->name('rangking.show.prov');
Route::post('update/kriteria', [PenilaiController::class, 'update_kriteria'])->name('update.kriteria');
Route::post('penilain/kabupaten/{id}', [PenilaiController::class, 'penilaian_kabupaten'])->name(
  'penilaian.update.kabupaten'
);
Route::post('penilain/provinsi/{id}', [PenilaiController::class, 'penilaian_provinsi'])->name(
  'penilaian.update.provinsi'
);
Route::post('kabupaten/terima/{id}', [PenilaiController::class, 'kabupaten_terima'])->name('kabupaten.terima');
Route::post('provinsi/terima/{id}', [PenilaiController::class, 'provinsi_terima'])->name('provinsi.terima');

Route::post('kabupaten/tolak/{id}', [PenilaiController::class, 'kabupaten_tolak'])->name('kabupaten.tolak');
Route::post('provinsi/tolak/{id}', [PenilaiController::class, 'provinsi_tolak'])->name('provinsi.tolak');
Route::get('kabupaten/status/{kab_id}/{periode}', [PenilaiController::class, 'kab_status'])->name('kabupaten.status');
Route::get('kabupaten/rangking/{kab_id}/{periode}', [PenilaiController::class, 'kab_rank'])->name('kabupaten.rangking');

Route::get('provinsi/status/{prov_id}/{periode}', [PenilaiController::class, 'prov_status'])->name('provinsi.status');
Route::get('provinsi/rangking/{prov_id}/{periode}', [PenilaiController::class, 'prov_rank'])->name('provinsi.rangking');
