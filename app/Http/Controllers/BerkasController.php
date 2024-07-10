<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use App\Models\nilai;
use App\Models\Pendaftaran;
use App\Models\Penilaian;
use App\Models\Peserta;
use App\Models\Province;
use App\Models\Regency;
use App\Models\Role;
use App\Models\subKriteria;
use App\Models\User;
use Database\Seeders\KriteriaSeeder;
use Illuminate\Http\Request;

class BerkasController extends Controller
{
  public function index(Request $request)
  {
    $role = Role::where('name', 'peserta')->first();
    $periodes = Pendaftaran::all();

    // Fetch users with 'peserta' role and apply filters if needed
    $data = User::where('role_id', $role->id)
      ->when($request->filled('periode'), function ($query) use ($request) {
        $query->whereHas('peserta', function ($subQuery) use ($request) {
          $subQuery->where('pendaftaran_id', $request->periode);
        });
      })
      ->when($request->filled('status'), function ($query) use ($request) {
        $query->whereHas('peserta', function ($subQuery) use ($request) {
          $subQuery->where('status_berkas', $request->status);
        });
      })
      ->get();

    return view('admin.berkas.index', compact('data', 'periodes'));
  }

  public function show($id)
  {
    $data = User::find($id);
    $provinsi = Province::all();
    $peserta = $data->peserta;
    return view('admin.berkas.show', compact('data', 'peserta', 'provinsi'));
  }

  public function penilaian_kabupaten(Request $request)
  {
    // Get all kabupaten, periodes, and provinsi
    $kabupaten = Regency::all();
    $periodes = Pendaftaran::all();
    $provinsi = Province::all();

    // Get peserta where status_berkas is 'terima' and status is 'mengajukan-berkas'
    $data = Peserta::where('status_berkas', 'terima')
      ->where('status', 'mengajukan-berkas')
      ->when($request->filled('kabupaten'), function ($query) use ($request) {
        $query->where('kabupaten_id', $request->kabupaten);
      })
      ->when($request->filled('periode'), function ($query) use ($request) {
        $query->where('pendaftaran_id', $request->periode);
      })
      ->get();

    $kriteria = Kriteria::all();

    // Return view with data
    return view('admin.penilaian.kabupaten', compact('kabupaten', 'data', 'periodes', 'provinsi', 'kriteria'));
  }

  public function penilaian_provinsi(Request $request)
  {
    // Your logic for penilaian provinsi
    $kabupaten = Regency::all();
    $data = Peserta::where('status_kabupaten', true)
      ->where('status', 'mengajukan-berkas')
      ->when($request->filled('provinsi'), function ($query) use ($request) {
        $query->where('provinsi_id', $request->kabupaten);
      })
      ->when($request->filled('periode'), function ($query) use ($request) {
        $query->where('pendaftaran_id', $request->periode);
      })
      ->get();
    $periodes = Pendaftaran::all();
    $provinsi = Province::all();
    $kriteria = Kriteria::all();
    $nilai = nilai::all();
    $penilain = Penilaian::all();
    return view(
      'admin.penilaian.provinsi',
      compact('kabupaten', 'data', 'periodes', 'provinsi', 'kriteria', 'nilai', 'penilain')
    ); // Adjust the view name as needed
  }

  public function rangking_provinsi(Request $request)
  {
    // Get all kabupaten, periodes, and provinsi
    $kabupaten = Regency::all();
    $periodes = Pendaftaran::all();
    $provinsi = Province::all();

    $selisih = [
      0 => 5,
      1 => 4.5,
      -1 => 4,
      2 => 3.5,
      -2 => 3,
      3 => 2.5,
      -3 => 2,
      4 => 1.5,
      -4 => 1,
    ];

    $bobot = [
      1 => 0.5,
      2 => 0.6,
      3 => 0.7,
      4 => 0.8,
      5 => 0.9,
    ];
    // Get peserta where status_berkas is 'terima' and status is not 'peserta-baru'
    $data = Peserta::where('status_kabupaten', true)
      ->when($request->filled('provinsi'), function ($query) use ($request) {
        $query->where('provinsi_id', $request->kabupaten);
      })
      ->when($request->filled('periode'), function ($query) use ($request) {
        $query->where('pendaftaran_id', $request->periode);
      })
      ->get();

    $prov = Province::find($request->provinsi);
    // Filter peserta yang memiliki tepat 3 penilaian
    $data = $data->filter(function ($peserta) {
      return $peserta->penilaian->count() === 2;
    });

    $rangking = [];

    foreach ($data as $key => $peserta) {
      $group_nilai = [];

      $penilaian = Penilaian::where('peserta_id', $peserta->id)
        ->where('isKabupaten', false)
        ->first();
      foreach ($penilaian->nilai as $key => $value) {
        $group_nilai[$value->sub_kriteria->kriteria->id][$value->sub_kriteria->id] = $value->nilai;
      }
      foreach (subKriteria::all() as $key => $sub) {
        $group_nilai[$sub->kriteria->id][$sub->id] = $group_nilai[$sub->kriteria->id][$sub->id] - $sub->bobot;
        $group_nilai[$sub->kriteria->id][$sub->id] = $selisih[$group_nilai[$sub->kriteria->id][$sub->id]];
      }
      $nilai = [];
      foreach (Kriteria::all() as $key => $kriteria) {
        $cf = [];
        $sf = [];

        foreach ($kriteria->subKriteria as $subKriteria) {
          if ($subKriteria->isCF) {
            $cf[] = $group_nilai[$kriteria->id][$subKriteria->id];
          } else {
            $sf[] = $group_nilai[$kriteria->id][$subKriteria->id];
          }
        }

        // Calculate the average of CF and SF
        $cfSum = array_sum($cf);
        $sfSum = array_sum($sf);

        $nilai[$kriteria->id][0] = $cfSum / count($cf);
        $nilai[$kriteria->id][1] = $sfSum / count($sf);
        $nilai[$kriteria->id][2] = 0.6 * $nilai[$kriteria->id][0] + 0.4 * $nilai[$kriteria->id][1];
      }
      $tmp = [];
      foreach (Kriteria::all() as $key => $value) {
        $tmp[] = $nilai[$value->id][2] * $value->bobot;
      }
      $rangking[$peserta->id] = [
        'nilai' => array_sum($tmp),
        'peserta' => $peserta,
      ];
    }

    usort($rangking, function ($a, $b) {
      return $b['nilai'] <=> $a['nilai'];
    });
    $kriteria = Kriteria::all();

    return view(
      'admin.penilaian.rangking_provinsi',
      compact('kabupaten', 'data', 'periodes', 'provinsi', 'kriteria', 'rangking', 'prov')
    ); // Adjust the view name as needed
  }

  public function rangking_kabupaten(Request $request)
  {
    // Get all kabupaten, periodes, and provinsi
    $kabupaten = Regency::all();
    $periodes = Pendaftaran::all();
    $provinsi = Province::all();

    $selisih = [
      0 => 5,
      1 => 4.5,
      -1 => 4,
      2 => 3.5,
      -2 => 3,
      3 => 2.5,
      -3 => 2,
      4 => 1.5,
      -4 => 1,
    ];

    $bobot = [
      1 => 0.5,
      2 => 0.6,
      3 => 0.7,
      4 => 0.8,
      5 => 0.9,
    ];
    // Get peserta where status_berkas is 'terima' and status is not 'peserta-baru'
    $data = Peserta::where('status_berkas', 'terima')
      ->where('status', '!=', 'peserta-baru')
      ->when($request->filled('kabupaten'), function ($query) use ($request) {
        $query->where('kabupaten_id', $request->kabupaten);
      })
      ->when($request->filled('periode'), function ($query) use ($request) {
        $query->where('pendaftaran_id', $request->periode);
      })
      ->get();

    $kabupaten = Regency::find($request->kabupaten);
    $per = Pendaftaran::find($request->periode);
    // Filter peserta yang memiliki tepat 3 penilaian
    $data = $data->filter(function ($peserta) {
      return $peserta->penilaian->count() >= 1;
    });

    $rangking = [];

    foreach ($data as $key => $peserta) {
      $group_nilai = [];
      foreach ($peserta->penilaian->nilai as $key => $value) {
        $group_nilai[$value->sub_kriteria->kriteria->id][$value->sub_kriteria->id] = $value->nilai;
      }
      foreach (subKriteria::all() as $key => $sub) {
        $group_nilai[$sub->kriteria->id][$sub->id] = $group_nilai[$sub->kriteria->id][$sub->id] - $sub->bobot;
        $group_nilai[$sub->kriteria->id][$sub->id] = $selisih[$group_nilai[$sub->kriteria->id][$sub->id]];
      }
      $nilai = [];
      foreach (Kriteria::all() as $key => $kriteria) {
        $cf = [];
        $sf = [];

        foreach ($kriteria->subKriteria as $subKriteria) {
          if ($subKriteria->isCF) {
            $cf[] = $group_nilai[$kriteria->id][$subKriteria->id];
          } else {
            $sf[] = $group_nilai[$kriteria->id][$subKriteria->id];
          }
        }

        // Calculate the average of CF and SF
        $cfSum = array_sum($cf);
        $sfSum = array_sum($sf);

        $nilai[$kriteria->id][0] = $cfSum / count($cf);
        $nilai[$kriteria->id][1] = $sfSum / count($sf);
        $nilai[$kriteria->id][2] = 0.6 * $nilai[$kriteria->id][0] + 0.4 * $nilai[$kriteria->id][1];
      }
      $tmp = [];
      foreach (Kriteria::all() as $key => $value) {
        $tmp[] = $nilai[$value->id][2] * $value->bobot;
      }
      $rangking[$peserta->id] = [
        'nilai' => array_sum($tmp),
        'peserta' => $peserta,
      ];
    }

    usort($rangking, function ($a, $b) {
      return $b['nilai'] <=> $a['nilai'];
    });
    $kriteria = Kriteria::all();

    return view(
      'admin.penilaian.rangking_kabupaten',
      compact('kabupaten', 'data', 'periodes', 'provinsi', 'kriteria', 'rangking', 'kabupaten', 'per')
    );
  }
}
