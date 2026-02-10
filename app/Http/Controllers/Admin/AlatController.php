<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Alat;
use App\Models\Kategori;
use App\Http\Requests\AlatRequest; 
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

    public function store(AlatRequest $request) 
    {
       
        $data = $request->validated();

        $gambarPath = null;
        if ($request->hasFile('gambar_alat')) {
            $gambarPath = $request->file('gambar_alat')->store('gambar_alat', 'public');
        }
        $data['gambar_alat'] = $gambarPath;

        Alat::create($data);

        return redirect()
            ->route('admin.alat.index')
            ->with('success', 'Alat berhasil ditambahkan');
    }

    public function update(AlatRequest $request, $id) 
    {
        $alat = Alat::findOrFail($id);
        $data = $request->validated();

        if ($request->hasFile('gambar_alat')) {
            
            if ($alat->gambar_alat) {
                Storage::disk('public')->delete($alat->gambar_alat);
            }
            $data['gambar_alat'] = $request->file('gambar_alat')->store('gambar_alat', 'public');
        }

        $alat->update($data);

        return redirect()
            ->route('admin.alat.index')
            ->with('success', 'Alat berhasil diupdate');
    }

    public function destroy($id)
    {
        $alat = Alat::findOrFail($id);
        if ($alat->peminjaman()->where('status', 'dipinjam')->exists()) {
            return redirect()
                ->route('admin.alat.index')
                ->with('error', 'Gagal dihapus! Alat sedang dalam peminjaman.');
        }

        // Hapus gambar jika ada
        if ($alat->gambar_alat) {
            Storage::disk('public')->delete($alat->gambar_alat);
        }

        $alat->delete();

        return redirect()
            ->route('admin.alat.index')
            ->with('success', 'Alat berhasil dihapus');
    }
}
