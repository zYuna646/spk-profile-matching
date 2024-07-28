<?php

namespace App\Http\Controllers;

use App\Models\Alumni;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AlumniController extends Controller
{
  public function index()
  {
    $data = Alumni::all();
    return view('admin.alumni.index', compact('data'));
  }

  public function create()
  {
    return view('admin.alumni.create');
  }

  public function store(Request $request)
{
    // Validate the request data
    $request->validate([
        'name' => 'required|string|max:255',
        'tahun_start' => 'required|integer',
        'tahun_end' => 'required|integer',
        'alamat' => 'required|string',
        'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
    ]);

    // Handle the file upload if there is a file
    if ($request->hasFile('foto')) {
        $fotoPath = $request->file('foto')->store('uploads', 'public');
    } else {
        $fotoPath = null;
    }

    // Create a new alumni record
    Alumni::create([
        'name' => $request->input('name'),
        'tahun_start' => $request->input('tahun_start'),
        'tahun_end' => $request->input('tahun_end'),
        'alamat' => $request->input('alamat'),
        'foto' => $fotoPath,
    ]);

    // Redirect back with a success message
    return redirect()
        ->route('alumni.index')
        ->with('success', 'Data Alumni Berhasil Ditambahkan');
}


  public function update(Request $request, $alumni)
  {
    $alumni = Alumni::find($alumni);
    // Validasi data
    $request->validate([
      'name' => 'required|string|max:255',
      'tahun_start' => 'required|integer',
      'tahun_end' => 'required|integer',
      'alamat' => 'required|string',
      'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    // Handle the file upload if there is a file
    if ($request->hasFile('foto')) {
      // Delete the old photo if exists
      if ($alumni->foto && Storage::exists('public/' . $alumni->foto)) {
        Storage::delete('public/' . $alumni->foto);
      }
      $fotoPath = $request->file('foto')->store('uploads', 'public');
    } else {
      $fotoPath = $alumni->foto;
    }

    // Update the data in the database
    $alumni->update([
      'name' => $request->input('name'),
      'tahun_start' => $request->input('tahun_start'),
      'tahun_end' => $request->input('tahun_end'),
      'alamat' => $request->input('alamat'),
      'foto' => $fotoPath,
    ]);

    // Redirect back with a success message
    return redirect()
      ->route('alumni.index')
      ->with('success', 'Data Alumni Berhasil Diperbarui');
  }

  // Controller Methods

  public function edit($alumni)
  {
    $alumni = Alumni::find($alumni);
    return view('admin.alumni.edit', compact('alumni'));
  }

  public function show($alumni)
  {
    $alumni = Alumni::find($alumni);
    return view('admin.alumni.show', compact('alumni'));
  }

  public function destroy($user)
  {
    Alumni::find($user)->delete();
    return redirect()
      ->route('alumni.index')
      ->with('success', 'Berhasil Ditambahkan');
  }
}
