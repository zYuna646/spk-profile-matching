<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

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
}
