<?php

namespace App\Http\Controllers;

use App\Models\Pendaftaran;
use App\Models\Peserta;
use Illuminate\Http\Request;

class BerkasController extends Controller
{
  public function index()
  {
    $data = Peserta::all();
    $periodes = Pendaftaran::all();
    return view('admin.berkas.index', compact('data', 'periodes'));
  }
}
