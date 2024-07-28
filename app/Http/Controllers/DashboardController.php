<?php

namespace App\Http\Controllers;

use App\Models\Alumni;
use App\Models\Kriteria;
use App\Models\Province;
use App\Models\Regency;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
  public function index()
  {
    $data = [
      'peserta' => User::where('role_id', Role::where('name', 'peserta')->first()->id)->count(),
      'penilai' => User::where('role_id', Role::where('name', 'penilai')->first()->id)->count(),
      'verificator' => User::where('role_id', Role::where('name', 'verificator')->first()->id)->count(),
      'pimpinan' => User::where('role_id', Role::where('name', 'pimpinan')->first()->id)->count(),
      'kriteria' => Kriteria::all(),
    ];

    return view('content.dashboard.dashboards-analytics', compact('data'));
  }

  public function home()
  {
    $alumni = Alumni::take(4)->get();
    return view('home.index', compact('alumni'));
  }

  public function alumni()
  {
    $alumni = Alumni::all();
    return view('home.shop', compact('alumni'));
  }

  public function peserta()
  {
  $provinsi = Province::all();
    return view('content.dashboard.dashboards-peserta', compact('provinsi'));
  }

  public function status()
  {
    return view('content.dashboard.status');
  }

  public function upload()
  {
    $provinsi = Province::all();
    $kabupaten = Regency::all();
    return view('content.dashboard.upload', compact('provinsi', 'kabupaten'));
  }
}
