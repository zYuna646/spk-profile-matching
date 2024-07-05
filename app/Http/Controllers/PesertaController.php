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
      'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
      'jk' => 'required|string|max:1',
      'tgl_lahir' => 'required|date',
      'agama' => 'required|string|max:255',
      'asal' => 'required|string|max:255',
      'provinsi' => 'required|integer',
      'kabupaten' => 'required|integer',
      'no_tlp' => 'required|string|max:15',
      'sosial_media' => 'nullable|string|max:255',
      'pekerjaan' => 'nullable|string|max:255',
      'latar_belakang' => 'nullable|string',
      'isAnggota' => 'nullable|boolean',
      'name_organisasi' => 'nullable|string|max:255',
      'desc_organisasi' => 'nullable|string',
      'peran_organisasi' => 'nullable|string|max:255',
      'desc_essai' => 'nullable|string',
      'isPertukaran' => 'nullable|boolean',
      'motivasi_essai' => 'nullable|string',
      'file_ktp' => 'nullable|file|mimes:pdf,jpeg,png|max:2048',
      'file_cv' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
      'file_ijazah' => 'nullable|file|mimes:pdf,jpeg,png|max:2048',
      'file_kegiatan_sosial.*' => 'nullable|file|mimes:pdf,jpeg,png|max:2048',
      'file_score_report' => 'nullable|file|mimes:pdf,jpeg,png|max:2048',
      'file_penghargaan.*' => 'nullable|file|mimes:pdf,jpeg,png|max:2048',
    ]);

    $user = Auth::user();
    $peserta = $user->peserta;

    // Handle the uploaded photo
    if ($request->hasFile('foto')) {
      $fotoPath = $request->file('foto')->store('public/fotos');
      $peserta->foto = basename($fotoPath);
    }

    // Update peserta information
    $peserta->jk = $request->jk;
    $peserta->tgl_lahir = $request->tgl_lahir;
    $peserta->agama = $request->agama;
    $peserta->asal = $request->asal;
    $peserta->kabupaten_id = $request->kabupaten;
    $peserta->provinsi_id = $request->provinsi;
    $peserta->no_tlp = $request->no_tlp;
    $peserta->sosial_media = $request->sosial_media;
    $peserta->pekerjaan = $request->pekerjaan;
    $peserta->latar_belakang = $request->latar_belakang;
    $peserta->isAnggota = $request->isAnggota ? $request->isAnggota : false;
    $peserta->name_organisasi = $request->name_organisasi;
    $peserta->desc_organisasi = $request->desc_organisasi;
    $peserta->peran_organisasi = $request->peran_organisasi;
    $peserta->desc_essai = $request->desc_essai;
    $peserta->isPertukaran = $request->isPertukaran ? $request->isPertukaran : false;
    $peserta->motivasi_essai = $request->motivasi_essai;

    $peserta->status_berkas = 'proses';

    // Handle file uploads
    if ($request->hasFile('file_ktp')) {
      $ktpPath = $request->file('file_ktp')->store('public/documents');
      $peserta->file_ktp = basename($ktpPath);
    }
    if ($request->hasFile('file_cv')) {
      $cvPath = $request->file('file_cv')->store('public/documents');
      $peserta->file_cv = basename($cvPath);
    }
    if ($request->hasFile('file_ijazah')) {
      $ijazahPath = $request->file('file_ijazah')->store('public/documents');
      $peserta->file_ijazah = basename($ijazahPath);
    }
    if ($request->hasFile('file_kegiatan_sosial')) {
      $kegiatanSosialPaths = [];
      foreach ($request->file('file_kegiatan_sosial') as $file) {
        $path = $file->store('public/documents');
        $kegiatanSosialPaths[] = basename($path);
      }
      $peserta->file_kegiatan_sosial = json_encode($kegiatanSosialPaths);
    }
    if ($request->hasFile('file_score_report')) {
      $scoreReportPath = $request->file('file_score_report')->store('public/documents');
      $peserta->file_score_report = basename($scoreReportPath);
    }
    if ($request->hasFile('file_penghargaan')) {
      $penghargaanPaths = [];
      foreach ($request->file('file_penghargaan') as $file) {
        $path = $file->store('public/documents');
        $penghargaanPaths[] = basename($path);
      }
      $peserta->file_penghargaan = json_encode($penghargaanPaths);
    }

    // Save the peserta data
    $peserta->save();

    return redirect()
      ->route('dashboard.peserta')
      ->with('success', 'Berkas berhasil diperbarui.');
  }
}
