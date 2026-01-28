<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Alat;
use App\Models\Kategori;
use Illuminate\Http\Request;

class AlatController extends Controller
{
    public function index()
    {
        $alats = Alat::with('kategori')->orderBy('id', 'desc')->get();
        return view('admin.alat.index', compact('alats'));
    }

    public function create()
    {
        $kategoris = Kategori::all();
        return view('admin.alat.create', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_alat'   => 'required|unique:alats,nama_alat',
            'stok'        => 'required|integer|min:0',
            'kategori_id' => 'required|exists:kategoris,id',
        ]);

        Alat::create($request->all());

        return redirect()
            ->route('admin.alat.index')
            ->with('success', 'Alat berhasil ditambahkan');
    }


    public function edit($id)
    {
        $alat = Alat::findOrFail($id);
        $kategoris = Kategori::all();

        return view('admin.alat.edit', compact('alat', 'kategoris'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_alat'   => 'required|unique:alats,nama_alat,' . $id,
            'stok'        => 'required|integer|min:0',
            'kategori_id' => 'required|exists:kategoris,id',
        ]);

        $alat = Alat::findOrFail($id);
        $alat->update($request->all());

        return redirect()
            ->route('admin.alat.index')
            ->with('success', 'Alat berhasil diupdate');
    }


    public function destroy($id)
    {
        Alat::findOrFail($id)->delete();

        return redirect()
            ->route('admin.alat.index')
            ->with('success', 'Alat berhasil dihapus');
    }
}
