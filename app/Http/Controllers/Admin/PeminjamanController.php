<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use App\Models\User;
use App\Models\Alat;
use App\Models\LogAktivitas;
use Illuminate\Http\Request;

class PeminjamanController extends Controller
{
    public function index()
    {
        $peminjamans = Peminjaman::with(['user', 'alat'])
            ->latest()
            ->get();

        return view('admin.peminjaman.index', compact('peminjamans'));
    }

    public function create()
    {
        $users = User::where('role', 'peminjam')->get();
        $alats = Alat::where('stok', '>', 0)->get();

        return view('admin.peminjaman.create', compact('users', 'alats'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'alat_id' => 'required|exists:alats,id',
            'tanggal_pinjam' => 'required|date',
            'tanggal_jatuh_tempo' => 'required|date|after_or_equal:tanggal_pinjam',
        ]);

        $cek = Peminjaman::where('user_id', $request->user_id)
            ->where('alat_id', $request->alat_id)
            ->exists();

        if ($cek) {
            return back()->with('error', 'User sudah meminjam alat ini');
        }

        $alat = Alat::findOrFail($request->alat_id);

        if ($alat->stok <= 0) {
            return back()->with('error', 'Stok alat habis');
        }

        $alat->decrement('stok');

        Peminjaman::create([
            'user_id' => $request->user_id,
            'alat_id' => $request->alat_id,
            'tanggal_pinjam' => $request->tanggal_pinjam,
            'tanggal_jatuh_tempo' => $request->tanggal_jatuh_tempo,
        ]);

        LogAktivitas::create([
            'user_id' => auth()->id(),
            'aktivitas' => 'Menambahkan data peminjaman alat',
        ]);

        return redirect()
            ->route('admin.peminjaman.index')
            ->with('success', 'Peminjaman berhasil ditambahkan');
    }

    public function edit(Peminjaman $peminjaman)
    {
        return view('admin.peminjaman.edit', compact('peminjaman'));
    }

    public function update(Request $request, Peminjaman $peminjaman)
    {
        $request->validate([
            'tanggal_pinjam' => 'required|date',
            'tanggal_jatuh_tempo' => 'required|date|after_or_equal:tanggal_pinjam',
        ]);

        $peminjaman->update([
            'tanggal_pinjam' => $request->tanggal_pinjam,
            'tanggal_jatuh_tempo' => $request->tanggal_jatuh_tempo,
        ]);

        LogAktivitas::create([
            'user_id' => auth()->id(),
            'aktivitas' => 'Admin mengubah data peminjaman',
        ]);

        return redirect()
            ->route('admin.peminjaman.index')
            ->with('success', 'Data peminjaman berhasil diperbarui');
    }

    public function destroy($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);

        // Kembalikan stok alat
        $peminjaman->alat->increment('stok');

        $peminjaman->delete();

        LogAktivitas::create([
            'user_id' => auth()->id(),
            'aktivitas' => 'Admin menghapus data peminjaman',
        ]);

        return redirect()
            ->route('admin.peminjaman.index')
            ->with('success', 'Peminjaman berhasil dihapus');
    }
}
