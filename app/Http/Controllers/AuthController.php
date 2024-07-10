<?php

namespace App\Http\Controllers;

use App\Models\Pendaftaran;
use App\Models\Peserta;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
  public function login()
  {
    return view('content.authentications.auth-login-basic');
  }

  public function register()
  {
    $periode = Pendaftaran::all();
    return view('content.authentications.auth-register-basic', compact('periode'));
  }

  public function forgot()
  {
    return view('content.authentications.auth-forgot-password-basic');
  }

  public function create(Request $request)
  {
    $request->validate([
      'name' => 'required|string|max:255|unique:users',
      'email' => 'required|string|email|max:255|unique:users',
      'gender' => 'required|in:L,P', // Menentukan jenis kelamin hanya boleh 'L' atau 'P'
      'birthdate' => 'required|date',
      'password' => 'required|string|min:8|confirmed',
      'periode' => 'required',
    ]);

    // Create the user
    $role = Role::where('name', 'peserta')->first();
    $user = User::create([
      'name' => $request->name,
      'email' => $request->email,
      'password' => bcrypt($request->password),
      'role_id' => $role->id,
    ]);

    // Create the associated Peserta record
    $pendaftaran = Pendaftaran::find($request->periode);
    Peserta::create([
      'user_id' => $user->id,
      'jk' => $request->gender, // Menyimpan jenis kelamin dari input form
      'tgl_lahir' => $request->birthdate, // Menyimpan tanggal lahir dari input form
      'pendaftaran_id' => $pendaftaran->id,
    ]);

    return redirect()->route('login'); // Ganti dengan rute yang sesuai untuk redirect setelah pendaftaran
  }

  public function authenticate(Request $request)
  {
    $credential = $request->validate(
      [
        'email' => 'required',
        'password' => 'required',
      ],
      [
        'email.required' => 'Kolom email pengguna harus diisi.',
        'password.required' => 'Kolom kata sandi harus diisi.',
      ]
    );

    if (Auth::attempt($credential)) {
      $request->session()->regenerate();
      $role = Auth::user()->role->name;
      // return redirect()->intended('/dashboard');

      switch ($role) {
        case 'peserta':
          return redirect()->intended('/dashboard/peserta');
        case 'dosen':
          return redirect()->intended('/dashboard/dpl');
        case 'mahasiswa':
          return redirect()->intended('/dashboard/student');
        case 'guru':
          return redirect()->intended('/dashboard/pamong');
        case 'operator':
          return redirect()->intended('/dashboard/operator');
        // Add more cases for other roles if needed
        default:
          return redirect()->intended('/dashboard');
      }
    }

    return back()->with('loginError', 'Username Atau Password Salah');
  }

  public function logout()
  {
    Auth::logout();
    return redirect()->route('login');
  }

  public function profile()
  {
    return view('admin.peserta.account');
  }

  public function update(Request $request, User $user)
  {
    $user = Auth::user();
    // Validate the request data
    $request->validate([
      'name' => 'required|string|max:255',
      'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
      'password' => 'nullable|string|min:8|confirmed',
      'alamat' => 'nullable|string',
    ]);

    // Update the user details
    $user->name = $request->input('name');
    $user->email = $request->input('email');
    if ($request->filled('password')) {
      $user->password = bcrypt($request->input('password'));
    }
    $user->alamat = $request->input('alamat');
    $user->save();

    // Redirect back with a success message
    return redirect()
      ->route('profile', $user)
      ->with('success', 'Profile updated successfully.');
  }
}
