<?php

namespace App\Http\Controllers;

use App\Models\Pendaftaran;
use App\Models\Peserta;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class PesertaController extends Controller
{
  public function index()
  {
    $role = Role::where('name', 'peserta')->first();
    $data = User::where('role_id', $role->id)->get();
    return view('admin.peserta.index', compact('data'));
  }

  public function create()
  {
    return view('admin.peserta.create');
  }

  public function store(Request $request)
  {
    $request->validate([
      'name' => 'required|string|max:255',
      'email' => 'required|string|email|max:255|unique:users',
      'password' => 'required|string|min:8|confirmed',
      'alamat' => 'required|string|min:10',
      'gender' => 'required|in:L,P', // Menentukan jenis kelamin hanya boleh 'L' atau 'P'
      'birthdate' => 'required|date',
    ]);

    $role = Role::where('name', 'peserta')->first();

    $user = User::create([
      'name' => $request->name,
      'email' => $request->email,
      'password' => $request->password,
      'alamat' => $request->alamat,
      'role_id' => $role->id,
    ]);

    $pendaftaran = Pendaftaran::latest()
      ->get()
      ->first();

    Peserta::create([
      'user_id' => $user->id,
      'jk' => $request->gender, // Menyimpan jenis kelamin dari input form
      'tgl_lahir' => $request->birthdate, // Menyimpan tanggal lahir dari input form
      'pendaftaran_id' => $pendaftaran->id,
    ]);

    return redirect()
      ->route('peserta.users.index')
      ->with('success', 'Berhasil Ditambahkan');
  }
  // Controller Methods

  public function edit(User $user)
  {
    return view('admin.peserta.edit', compact('user'));
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
      ->route('peserta.users.index')
      ->with('success', 'Berhasil Diperbarui');
  }

  public function show(User $user)
  {
    return view('admin.peserta.show', compact('user'));
  }

  public function destroy(User $user)
  {
    $user->delete();
    return redirect()
      ->route('peserta.users.index')
      ->with('success', 'Berhasil Ditambahkan');
  }

  public function status($status)
  {
    // Assuming each user has one peserta associated through a hasOne relationship
    $role = Role::where('name', 'peserta')->first();

    if (!$role) {
      // Handle the case where the role is not found
      return redirect()
        ->back()
        ->with('error', 'Role "peserta" not found');
    }

    // Retrieve users with their related peserta where peserta status matches
    $users = User::where('role_id', $role->id)
      ->whereHas('peserta', function ($query) use ($status) {
        $query->where('status', $status);
      })
      ->with('peserta') // Eager load peserta relationship
      ->get();
    $data = $users;
    return view('admin.peserta.status', compact('data'));
  }

  public function updateBerkas(Request $request)
  {
    // Validate the incoming request data
    $request->validate([
      'jk' => 'required|string',
      'tgl_lahir' => 'required|date',
      'agama' => 'nullable|string',
      'provinsi_id' => 'nullable|exists:provinces,id',
      'kabupaten_id' => 'nullable|exists:regencies,id',
      'no_tlp' => 'nullable|string',
      'sosial_media' => 'nullable|string',
      'pekerjaan' => 'nullable|string',
      'latar_belakang' => 'nullable|string',
      'peran_organisasi' => 'nullable|string',
      'isPertukaran' => 'nullable|boolean',
      'motivasi' => 'nullable|string',
      'file_ijazah' => 'nullable|file|mimes:pdf,jpg,png',
      'file_ktp' => 'nullable|file|mimes:jpg,png',
      'file_cv' => 'nullable|file|mimes:pdf',
      'file_transkrip' => 'nullable|file|mimes:pdf',
      'file_kegiatan_sosial.*' => 'nullable|file',
      'file_penghargaan.*' => 'nullable|file',
      'file_surat_rekomendasi' => 'nullable|file|mimes:pdf',
      'foto' => 'nullable|image',
    ]);
    $user = Auth::user();
    $peserta = $user->peserta;

    // Handle the uploaded photo
    // if ($request->hasFile('foto')) {
    //   $fotoPath = $request->file('foto')->store('public/fotos');
    //   $peserta->foto = basename($fotoPath);
    // }
    $peserta->jk = $request->jk;
    $peserta->tgl_lahir = $request->tgl_lahir;
    $peserta->agama = $request->agama;
    $peserta->provinsi_id = $request->provinsi_id;
    $peserta->kabupaten_id = $request->kabupaten_id;
    $peserta->no_tlp = $request->no_tlp;
    $peserta->sosial_media = $request->sosial_media;
    $peserta->pekerjaan = $request->pekerjaan;
    $peserta->latar_belakang = $request->latar_belakang;
    $peserta->periode_mengikuti = $request->peran_organisasi;
    $peserta->isPertukaran = $request->has('isPertukaran');
    $peserta->motivasi = $request->motivasi;
    $peserta->foto = $request->foto;

    if ($request->hasFile('file_ijazah')) {
      $peserta->file_ijazah = $request->file('file_ijazah')->store('uploads');
    }
    if ($request->hasFile('file_ktp')) {
      $peserta->file_ktp = $request->file('file_ktp')->store('uploads');
    }
    if ($request->hasFile('foto')) {
      $peserta->foto = $request->file('foto')->store('uploads');
    }
    if ($request->hasFile('file_cv')) {
      $peserta->file_cv = $request->file('file_cv')->store('uploads');
    }
    if ($request->hasFile('file_transkrip')) {
      $peserta->file_score_report = $request->file('file_transkrip')->store('uploads');
    }
    if ($request->hasFile('file_kegiatan_sosial')) {
      $peserta->file_kegiatan_sosial = json_encode(array_map(function ($file) {
        return $file->store('uploads');
      }, $request->file('file_kegiatan_sosial')));
    }
    if ($request->hasFile('file_penghargaan')) {
      $peserta->file_penghargaan = json_encode(array_map(function ($file) {
        return $file->store('uploads');
      }, $request->file('file_penghargaan')));
    }
    if ($request->hasFile('file_surat_rekomendasi')) {
      $peserta->file_surat_rekomendasi = $request->file('file_surat_rekomendasi')->store('uploads');
    }


    $peserta->status_berkas = 'proses';
    $peserta->status = 'mengajukan-berkas';

    // Save the peserta data
    $peserta->save();

    return redirect()
      ->route('dashboard.peserta')
      ->with('success', 'Berkas berhasil diperbarui.');
  }
}
