<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use Illuminate\Http\Request;

class KriteriaController extends Controller
{
    public function index()
    {
        $data = Kriteria::all();
        return view('admin.kriteria.index', compact('data'));
    }


    public function create()
    {
        return view('admin.kriteria.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'bobot' => 'required|numeric',
        ]);

        Kriteria::create($request->all());

        return redirect()
            ->route('kriteria.kriteria.index')
            ->with('success', 'Berhasil Ditambahkan');
    }

    public function edit($kriteria)
    {
        $kriteria = Kriteria::find($kriteria);
        return view('admin.kriteria.edit', compact('kriteria'));
    }

    public function update(Request $request, $kriteria)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'bobot' => 'required|numeric',
        ]);

        $kriteria = Kriteria::find($kriteria);
        $kriteria->fill($request->only(['name', 'bobot']));
        $kriteria->save();

        return redirect()
            ->route('kriteria.kriteria.index')
            ->with('success', 'Berhasil Diperbarui');
    }

    public function destroy($id)
    {
        $kriteria = Kriteria::find($id);
        $kriteria->delete();

        return redirect()
            ->route('kriteria.kriteria.index')
            ->with('success', 'Berhasil Dihapus');
    }
}
