<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use App\Models\subKriteria;
use Illuminate\Http\Request;

class SubController extends Controller
{
    public function index(Request $request)
    {
        $data = subKriteria::all();
        return view('admin.sub.index', compact('data'));
    }

    public function create()
    {
        $kriterias = Kriteria::all();
        return view('admin.sub.create', compact('kriterias'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'bobot' => 'required|numeric',
            'isCF' => 'boolean',
            'kriteria_id' => 'required|exists:kriterias,id',
        ]);

        subKriteria::create($request->all());

        return redirect()
            ->route('kriteria.sub.index')
            ->with('success', 'Berhasil Ditambahkan');
    }

    public function edit($sub)
    {
        $sub = subKriteria::find($sub);
        $kriterias = Kriteria::all();
        return view('admin.sub.edit', compact('sub', 'kriterias'));
    }

    public function update(Request $request, $sub)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'bobot' => 'required|numeric',
            'isCF' => 'boolean',
            'kriteria_id' => 'required|exists:kriterias,id',
        ]);

        $sub = subKriteria::find($sub);
        $sub->fill($request->all());
        $sub->save();

        return redirect()
            ->route('kriteria.sub.index')
            ->with('success', 'Berhasil Diperbarui');
    }

    public function destroy($id)
    {
        $sub = subKriteria::find($id);
        $sub->delete();

        return redirect()
            ->route('kriteria.sub.index')
            ->with('success', 'Berhasil Dihapus');
    }
}
