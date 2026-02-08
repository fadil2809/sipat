<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Alat;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
            'deskripsi'   => 'nullable|string',
            'stok'        => 'required|integer|min:0',
            'kategori_id' => 'required|exists:kategoris,id',
            'harga'       => 'required|integer|min:0', // 🔥 VALIDASI HARGA
            'gambar_alat' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $gambarPath = null;
        if ($request->hasFile('gambar_alat')) {
            $gambarPath = $request->file('gambar_alat')
                ->store('gambar_alat', 'public');
        }

        Alat::create([
            'nama_alat'   => $request->nama_alat,
            'deskripsi'   => $request->deskripsi,
            'stok'        => $request->stok,
            'kategori_id' => $request->kategori_id,
            'harga'       => $request->harga, // 🔥 SIMPAN HARGA
            'gambar_alat' => $gambarPath,
        ]);

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
            'deskripsi'   => 'nullable|string',
            'stok'        => 'required|integer|min:0',
            'kategori_id' => 'required|exists:kategoris,id',
            'harga'       => 'required|integer|min:0', // 🔥 VALIDASI HARGA
            'gambar_alat' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $alat = Alat::findOrFail($id);

        // Data utama
        $alat->nama_alat   = $request->nama_alat;
        $alat->deskripsi   = $request->deskripsi;
        $alat->stok        = $request->stok;
        $alat->kategori_id = $request->kategori_id;
        $alat->harga       = $request->harga; // 🔥 UPDATE HARGA

        // Gambar
        if ($request->hasFile('gambar_alat')) {
            if ($alat->gambar_alat) {
                Storage::disk('public')->delete($alat->gambar_alat);
            }
            $alat->gambar_alat = $request->file('gambar_alat')
                ->store('gambar_alat', 'public');
        }

        $alat->save();

        return redirect()
            ->route('admin.alat.index')
            ->with('success', 'Alat berhasil diupdate');
    }

    public function destroy($id)
    {
        $alat = Alat::findOrFail($id);

        if ($alat->gambar_alat) {
            Storage::disk('public')->delete($alat->gambar_alat);
        }

        $alat->delete();

        return redirect()
            ->route('admin.alat.index')
            ->with('success', 'Alat berhasil dihapus');
    }
}
