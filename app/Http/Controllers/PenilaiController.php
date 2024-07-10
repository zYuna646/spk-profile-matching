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
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use PDF;

class PenilaiController extends Controller
{
  public function index()
  {
    $role = Role::where('name', 'penilai')->first();
    $data = User::where('role_id', $role->id)->get();
    return view('admin.penilai.index', compact('data'));
  }

  public function create()
  {
    return view('admin.penilai.create');
  }

  public function store(Request $request)
  {
    $request->validate([
      'name' => 'required|string|max:255',
      'email' => 'required|string|email|max:255|unique:users',
      'password' => 'required|string|min:8|confirmed',
      'alamat' => 'required|string|min:10',
    ]);

    $role = Role::where('name', 'penilai')->first();

    User::create([
      'name' => $request->name,
      'email' => $request->email,
      'password' => $request->password,
      'alamat' => $request->alamat,
      'role_id' => $role->id,
    ]);

    return redirect()
      ->route('penilai.users.index')
      ->with('success', 'Berhasil Ditambahkan');
  }
  // Controller Methods

  public function edit(User $user)
  {
    return view('admin.penilai.edit', compact('user'));
  }

  public function update(User $user, Request $request)
  {
    // Validasi data
    $request->validate([
      'name' => 'required|string|max:255',
      'email' => [
        'required',
        'string',
        'email',
        'max:255',
        Rule::unique('users')->ignore($user->id), // Mengabaikan email unik untuk pengguna yang sedang diperbarui
      ],
      'password' => 'nullable|string|min:8|confirmed',
      'alamat' => 'required|string|min:10',
    ]);

    // Mengisi data pengguna
    $user->fill($request->except('password'));

    // Jika password disediakan, perbarui password
    if ($request->filled('password')) {
      $user->password = bcrypt($request->password);
    }

    // Simpan perubahan
    $user->save();

    // Redirect dengan pesan sukses
    return redirect()
      ->route('penilai.users.index')
      ->with('success', 'Berhasil Diperbarui');
  }

  public function show(User $user)
  {
    return view('admin.penilai.show', compact('user'));
  }

  public function destroy(User $user)
  {
    $user->delete();
    return redirect()
      ->route('penilai.users.index')
      ->with('success', 'Berhasil Ditambahkan');
  }

  public function update_kriteria(Request $request)
  {
    $validatedData = $request->validate([
      'bobot.*' => 'required|integer|min:1|max:5',
    ]);

    foreach ($validatedData['bobot'] as $id => $bobot) {
      $kriteria = Kriteria::findOrFail($id);
      $kriteria->update([
        'bobot' => $bobot,
      ]);
    }

    return redirect()
      ->back()
      ->with('success', 'Kriteria berhasil diperbarui.');
  }

  public function penilaian_kabupaten(Request $request, $id)
  {
    $peserta = Peserta::find($id);
    if (!$peserta) {
      return redirect()
        ->back()
        ->with('error', 'Peserta tidak ditemukan.');
    }

    $isKabupaten = Penilaian::where('peserta_id', $peserta->id)
      ->where('isKabupaten', true)
      ->first();

    if ($isKabupaten) {
      $penilaian = $isKabupaten;
      foreach ($request->subnilai as $sub_kriteria_id => $nilai) {
        $nilaiModel = $penilaian->nilai->where('sub_kriteria_id', $sub_kriteria_id)->first();
        if ($nilaiModel) {
          $nilaiModel->nilai = $nilai;
          $nilaiModel->save();
        }
      }
    } else {
      $penilaian = Penilaian::create([
        'peserta_id' => $peserta->id,
        'isKabupaten' => true,
      ]);
      foreach ($request->subnilai as $sub_kriteria_id => $nilai) {
        Nilai::create([
          'penilaian_id' => $penilaian->id,
          'sub_kriteria_id' => $sub_kriteria_id,
          'nilai' => $nilai,
        ]);
      }
    }

    return redirect()
      ->back()
      ->with('success', 'Penilaian berhasil disimpan.');
  }

  public function penilaian_provinsi(Request $request, $id)
  {
    $peserta = Peserta::find($id);
    if (!$peserta) {
      return redirect()
        ->back()
        ->with('error', 'Peserta tidak ditemukan.');
    }

    $isKabupaten = Penilaian::where('peserta_id', $peserta->id)
      ->where('isKabupaten', false)
      ->first();

    if ($isKabupaten) {
      $penilaian = $isKabupaten;
      foreach ($request->subnilai as $sub_kriteria_id => $nilai) {
        $nilaiModel = $penilaian->nilai->where('sub_kriteria_id', $sub_kriteria_id)->first();
        if ($nilaiModel) {
          $nilaiModel->nilai = $nilai;
          $nilaiModel->save();
        }
      }
    } else {
      $penilain = Penilaian::create([
        'peserta_id' => $peserta->id,
        'isKabupaten' => false,
      ]);
      foreach ($request->subnilai as $key => $value) {
        foreach ($value as $key => $item) {
          nilai::create([
            'penilaian_id' => $penilain->id,
            'sub_kriteria_id' => $key,
            'nilai' => $item,
          ]);
        }
      }
    }

    return redirect()
      ->back()
      ->with('success', 'Penilaian berhasil disimpan.');
  }

  public function kab_rank($kab_id, $periode)
  {
    // Fetch Peserta data based on filters
    $data = Peserta::where('status_berkas', 'terima')
      ->where('status', '!=', 'peserta-baru')
      ->when($kab_id != 'a', function ($query) use ($kab_id) {
        $query->where('kabupaten_id', $kab_id);
      })
      ->when($periode != 'a', function ($query) use ($periode) {
        $query->where('pendaftaran_id', $periode);
      })
      ->get();
    $periode = Pendaftaran::find($periode);
    $kab = Regency::find($kab_id);

    // Define arrays for selisih and bobot
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

    // Filter Peserta that have at least 1 Penilaian
    $data = $data->filter(function ($peserta) {
      return $peserta->penilaian->count() >= 1;
    });

    // Fetch Kabupaten data

    // Initialize empty $rangking array
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

    // Return or use $rangking as needed
    $prov = Province::first();
    $isKab = true;
    $pdf = PDF::loadView('rangking', compact('rangking', 'kab', 'prov', 'isKab', 'periode'));
    return $pdf->download('laporan_rangking.pdf');
  }

  public function kab_status($kab_id, $periode)
  {
    // Fetch Peserta data based on filters
    $data = Peserta::where('status_berkas', 'terima')
      ->where('status', '!=', 'peserta-baru')
      ->when($kab_id != 'a', function ($query) use ($kab_id) {
        $query->where('kabupaten_id', $kab_id);
      })
      ->when($periode != 'a', function ($query) use ($periode) {
        $query->where('pendaftaran_id', $periode);
      })
      ->get();
    $periode = Pendaftaran::find($periode);
    $kab = Regency::find($kab_id);

    // Define arrays for selisih and bobot
    // Return or use $rangking as needed
    $prov = Province::first();
    $isKab = true;
    $pdf = PDF::loadView('status', compact('data', 'kab', 'prov', 'isKab', 'periode'));
    return $pdf->download('laporan_status.pdf');
  }

  public function prov_rank($prov_id, $periode)
  {
    // Fetch Peserta data based on filters
    $data = Peserta::where('status_kabupaten', true)
      ->when($prov_id != 'a', function ($query) use ($prov_id) {
        $query->where('provinsi_id', $prov_id);
      })
      ->when($periode != 'a', function ($query) use ($periode) {
        $query->where('pendaftaran_id', $periode);
      })
      ->get();
    $periode = Pendaftaran::find($periode);
    $kab = Regency::first();

    // Define arrays for selisih and bobot
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

    // Filter Peserta that have at least 1 Penilaian
    $data = $data->filter(function ($peserta) {
      return $peserta->penilaian->count() === 2;
    });

    // Fetch Kabupaten data

    // Initialize empty $rangking array
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

    // Return or use $rangking as needed
    $prov = Province::find($prov_id);
    $isKab = false;
    $pdf = PDF::loadView('rangking', compact('rangking', 'kab', 'prov', 'isKab', 'periode'));
    return $pdf->download('laporan_rangking.pdf');
  }

  public function prov_status($prov_id, $periode)
  {
    // Fetch Peserta data based on filters
    $data = Peserta::where('status_kabupaten', true)
      ->when($prov_id != 'a', function ($query) use ($prov_id) {
        $query->where('kabupaten_id', $prov_id);
      })
      ->when($periode != 'a', function ($query) use ($periode) {
        $query->where('pendaftaran_id', $periode);
      })
      ->get();
    $periode = Pendaftaran::find($periode);
    $kab = Regency::first();

    // Define arrays for selisih and bobot
    // Return or use $rangking as needed
    $prov = Province::find($prov_id);
    $isKab = false;
    $pdf = PDF::loadView('status', compact('data', 'kab', 'prov', 'isKab', 'periode'));
    return $pdf->download('laporan_status.pdf');
  }

  public function kabupaten_terima($id)
  {
    $peserta = Peserta::find($id);
    $peserta->status_kabupaten = true;
    $peserta->save();
    return redirect()
      ->back()
      ->with('success', 'Peserta berhasil diterima.');
  }

  public function kabupaten_tolak($id)
  {
    $peserta = Peserta::find($id);
    $peserta->status = 'gugur-seleksi-kabupaten';
    $peserta->save();
    return redirect()
      ->back()
      ->with('success', 'Peserta berhasil ditolak.');
  }

  public function provinsi_tolak($id)
  {
    $peserta = Peserta::find($id);
    $peserta->status = 'gugur-seleksi-provinsi';
    $peserta->save();
    return redirect()
      ->back()
      ->with('success', 'Peserta berhasil ditolak.');
  }
  public function provinsi_terima($id)
  {
    $peserta = Peserta::find($id);
    $peserta->status = 'lolos-seleksi-provinsi';
    $peserta->save();
    return redirect()
      ->back()
      ->with('success', 'Peserta berhasil diterima.');
  }
}
