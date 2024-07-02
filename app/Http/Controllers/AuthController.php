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
    return view('content.authentications.auth-register-basic');
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
    $pendaftaran = Pendaftaran::find($request->pendaftaran_id);
    $peserta = Peserta::create([
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
      return redirect()->intended('/dashboard');

      //   switch ($role) {
      //     case 'admin':
      //       return redirect()->intended('/dashboard/admin');
      //     case 'dosen':
      //       return redirect()->intended('/dashboard/dpl');
      //     case 'mahasiswa':
      //       return redirect()->intended('/dashboard/student');
      //     case 'guru':
      //       return redirect()->intended('/dashboard/pamong');
      //     case 'operator':
      //       return redirect()->intended('/dashboard/operator');
      //     // Add more cases for other roles if needed
      //     default:
      //       return redirect()->intended('/dashboard_default');
      //   }
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
    return view('content.pages.profile');
  }

  public function update(User $user)
  {
    return view('content.pages.profile');
  }
}
