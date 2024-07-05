<?php

namespace App\Http\Controllers;

use App\Models\Pendaftaran;
use Illuminate\Http\Request;

class PeriodeController extends Controller
{
  public function index()
  {
    $data = Pendaftaran::all();
    return view('admin.periode.index', compact('data'));
  }

  public function create()
  {
    return view('admin.periode.create');
  }

  public function store(Request $request)
  {
    $request->validate([
      'name' => 'required|string|max:255',
      'periode' => 'required|regex:/^[0-9]{4}$/', // Validate that periode is a four-digit year
    ]);

    Pendaftaran::create($request->all());

    return redirect()
      ->route('pendaftaran.periode.index')
      ->with('success', 'Berhasil Ditambahkan');
  }

  public function edit($pendaftaran)
  {
    $pendaftaran = Pendaftaran::find($pendaftaran);
    return view('admin.periode.edit', compact('pendaftaran'));
  }

  public function update(Request $request, $pendaftaran)
  {
    $request->validate([
      'name' => 'required|string|max:255',
      'periode' => 'required|regex:/^[0-9]{4}$/', // Validate that periode is a four-digit year
    ]);
    dd($pendaftaran);

    $pendaftaran->fill($request->only(['name', 'periode']));
    $pendaftaran->save();

    return redirect()
      ->route('pendaftaran.periode.index')
      ->with('success', 'Berhasil Diperbarui');
  }

  public function show(Request $request, $pendaftaran)
  {
    $request->validate([
      'name' => 'required|string|max:255',
      'periode' => 'required|regex:/^[0-9]{4}$/', // Validate that periode is a four-digit year
    ]);

    $pendaftaran = Pendaftaran::find($pendaftaran);

    $pendaftaran->fill($request->only(['name', 'periode']));
    $pendaftaran->save();

    return redirect()
      ->route('pendaftaran.periode.index')
      ->with('success', 'Berhasil Diperbarui');
  }

  public function destroy($pendaftaran)
  {
    $pendaftaran = Pendaftaran::find($pendaftaran);
    $pendaftaran->delete();
    return redirect()
      ->route('pendaftaran.periode.index')
      ->with('success', 'Berhasil Dihapus');
  }
}
