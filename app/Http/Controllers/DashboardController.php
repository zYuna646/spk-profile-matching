<?php

namespace App\Http\Controllers;

use App\Models\Province;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
  public function index()
  {
    return view('content.dashboard.dashboards-analytics');
  }

  public function peserta()
  {
    $provinsi = Province::all();
    return view('content.dashboard.dashboards-peserta', compact('provinsi'));
  }
}
