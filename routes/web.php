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
Route::get('/', [AuthController::class, 'login'])->name('dashboard-analytics');

// layout
Route::get('/layouts/without-menu', [WithoutMenu::class, 'index'])->name('layouts-without-menu');
Route::get('/layouts/without-navbar', [WithoutNavbar::class, 'index'])->name('layouts-without-navbar');
Route::get('/layouts/fluid', [Fluid::class, 'index'])->name('layouts-fluid');
Route::get('/layouts/container', [Container::class, 'index'])->name('layouts-container');
Route::get('/layouts/blank', [Blank::class, 'index'])->name('layouts-blank');

// pages
Route::get('/pages/account-settings-account', [AccountSettingsAccount::class, 'index'])->name(
  'pages-account-settings-account'
);
Route::get('/pages/account-settings-notifications', [AccountSettingsNotifications::class, 'index'])->name(
  'pages-account-settings-notifications'
);
Route::get('/pages/account-settings-connections', [AccountSettingsConnections::class, 'index'])->name(
  'pages-account-settings-connections'
);
Route::get('/pages/misc-error', [MiscError::class, 'index'])->name('pages-misc-error');
Route::get('/pages/misc-under-maintenance', [MiscUnderMaintenance::class, 'index'])->name(
  'pages-misc-under-maintenance'
);

// authentication

// cards
Route::get('/cards/basic', [CardBasic::class, 'index'])->name('cards-basic');

// User Interface
Route::get('/ui/accordion', [Accordion::class, 'index'])->name('ui-accordion');
Route::get('/ui/alerts', [Alerts::class, 'index'])->name('ui-alerts');
Route::get('/ui/badges', [Badges::class, 'index'])->name('ui-badges');
Route::get('/ui/buttons', [Buttons::class, 'index'])->name('ui-buttons');
Route::get('/ui/carousel', [Carousel::class, 'index'])->name('ui-carousel');
Route::get('/ui/collapse', [Collapse::class, 'index'])->name('ui-collapse');
Route::get('/ui/dropdowns', [Dropdowns::class, 'index'])->name('ui-dropdowns');
Route::get('/ui/footer', [Footer::class, 'index'])->name('ui-footer');
Route::get('/ui/list-groups', [ListGroups::class, 'index'])->name('ui-list-groups');
Route::get('/ui/modals', [Modals::class, 'index'])->name('ui-modals');
Route::get('/ui/navbar', [Navbar::class, 'index'])->name('ui-navbar');
Route::get('/ui/offcanvas', [Offcanvas::class, 'index'])->name('ui-offcanvas');
Route::get('/ui/pagination-breadcrumbs', [PaginationBreadcrumbs::class, 'index'])->name('ui-pagination-breadcrumbs');
Route::get('/ui/progress', [Progress::class, 'index'])->name('ui-progress');
Route::get('/ui/spinners', [Spinners::class, 'index'])->name('ui-spinners');
Route::get('/ui/tabs-pills', [TabsPills::class, 'index'])->name('ui-tabs-pills');
Route::get('/ui/toasts', [Toasts::class, 'index'])->name('ui-toasts');
Route::get('/ui/tooltips-popovers', [TooltipsPopovers::class, 'index'])->name('ui-tooltips-popovers');
Route::get('/ui/typography', [Typography::class, 'index'])->name('ui-typography');

// extended ui
Route::get('/extended/ui-perfect-scrollbar', [PerfectScrollbar::class, 'index'])->name('extended-ui-perfect-scrollbar');
Route::get('/extended/ui-text-divider', [TextDivider::class, 'index'])->name('extended-ui-text-divider');

// icons
Route::get('/icons/boxicons', [Boxicons::class, 'index'])->name('icons-boxicons');

// form elements
Route::get('/forms/basic-inputs', [BasicInput::class, 'index'])->name('forms-basic-inputs');
Route::get('/forms/input-groups', [InputGroups::class, 'index'])->name('forms-input-groups');

// form layouts
Route::get('/form/layouts-vertical', [VerticalForm::class, 'index'])->name('form-layouts-vertical');
Route::get('/form/layouts-horizontal', [HorizontalForm::class, 'index'])->name('form-layouts-horizontal');

// tables
Route::get('/tables/basic', [TablesBasic::class, 'index'])->name('tables-basic');

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
