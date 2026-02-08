<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use App\Models\User;
use App\Models\Alat;
use App\Models\Kategori;
use App\Models\LogAktivitas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PeminjamanController extends Controller
{
    // ==============================
    // INDEX
    // ==============================
    public function index()
    {
        $peminjamans = Peminjaman::with(['user', 'alat'])
            ->latest()
            ->get();

        return view('admin.peminjaman.index', compact('peminjamans'));
    }

    // ==============================
    // CREATE
    // ==============================
    public function create()
    {
        $users = User::where('role', 'peminjam')->get();
        $kategoris = Kategori::all();

        return view('admin.peminjaman.create', compact('users', 'kategoris'));
    }

    // ==============================
    // GET ALAT BY KATEGORI (AJAX)
    // ==============================
    public function getAlatByKategori($kategoriId)
    {
        $alat = Alat::where('kategori_id', $kategoriId)
            ->where('stok', '>', 0)
            ->get();

        return response()->json($alat);
    }

    // ==============================
    // STORE
    // ==============================
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'alat_id' => 'required|exists:alats,id',
            'tanggal_pinjam' => 'required|date',
            'tanggal_jatuh_tempo' => 'required|date|after_or_equal:tanggal_pinjam',
        ], [
            'user_id.required' => 'Peminjam wajib dipilih.',
            'alat_id.required' => 'Alat wajib dipilih.',
            'tanggal_pinjam.required' => 'Tanggal pinjam wajib diisi.',
            'tanggal_jatuh_tempo.after_or_equal' => 'Tanggal jatuh tempo harus sama atau setelah tanggal pinjam.',
        ]);

        // cek duplikat
        $exists = Peminjaman::where('user_id', $validated['user_id'])
            ->where('alat_id', $validated['alat_id'])
            ->whereIn('status', ['pending', 'dipinjam'])
            ->exists();

        if ($exists) {
            return back()->with('error', 'Peminjam masih memiliki peminjaman aktif untuk alat ini.');
        }

        $alat = Alat::findOrFail($validated['alat_id']);

        if ($alat->stok <= 0) {
            return back()->with('error', 'Stok alat habis. Silakan pilih alat lain.');
        }

        // kurangi stok
        $alat->decrement('stok');

        // simpan
        Peminjaman::create([
            'user_id' => $validated['user_id'],
            'alat_id' => $validated['alat_id'],
            'tanggal_pinjam' => $validated['tanggal_pinjam'],
            'tanggal_jatuh_tempo' => $validated['tanggal_jatuh_tempo'],
            'status' => 'dipinjam',
        ]);

        // log
        LogAktivitas::create([
            'user_id' => Auth::id(),
            'aktivitas' => 'Menambahkan data peminjaman alat',
        ]);

        return redirect()
            ->route('admin.peminjaman.index')
            ->with('success', 'Peminjaman berhasil ditambahkan.');
    }

    // ==============================
    // EDIT
    // ==============================
    public function edit($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        $users = User::where('role', 'peminjam')->get();
        $kategoris = Kategori::all();

        return view('admin.peminjaman.edit', compact('peminjaman', 'users', 'kategoris'));
    }

    // ==============================
    // UPDATE
    // ==============================
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'alat_id' => 'required|exists:alats,id',
            'tanggal_pinjam' => 'required|date',
            'tanggal_jatuh_tempo' => 'required|date|after_or_equal:tanggal_pinjam',
        ], [
            'user_id.required' => 'Peminjam wajib dipilih.',
            'alat_id.required' => 'Alat wajib dipilih.',
            'tanggal_pinjam.required' => 'Tanggal pinjam wajib diisi.',
            'tanggal_jatuh_tempo.after_or_equal' => 'Tanggal jatuh tempo harus sama atau setelah tanggal pinjam.',
        ]);

        $peminjaman = Peminjaman::findOrFail($id);

        // jika ganti alat → balikin stok lama
        if ($peminjaman->alat_id != $validated['alat_id']) {
            $alatLama = Alat::find($peminjaman->alat_id);
            if ($alatLama) {
                $alatLama->increment('stok');
            }

            $alatBaru = Alat::findOrFail($validated['alat_id']);
            if ($alatBaru->stok <= 0) {
                return back()->with('error', 'Stok alat baru habis.');
            }

            $alatBaru->decrement('stok');
        }

        // update data
        $peminjaman->update([
            'user_id' => $validated['user_id'],
            'alat_id' => $validated['alat_id'],
            'tanggal_pinjam' => $validated['tanggal_pinjam'],
            'tanggal_jatuh_tempo' => $validated['tanggal_jatuh_tempo'],
        ]);

        // log
        LogAktivitas::create([
            'user_id' => Auth::id(),
            'aktivitas' => 'Mengubah data peminjaman alat',
        ]);

        return redirect()
            ->route('admin.peminjaman.index')
            ->with('success', 'Data peminjaman berhasil diperbarui.');
    }

    // ==============================
    // DESTROY
    // ==============================
    public function destroy($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);

        // balikin stok
        $alat = Alat::find($peminjaman->alat_id);
        if ($alat) {
            $alat->increment('stok');
        }

        // hapus
        $peminjaman->delete();

        // log
        LogAktivitas::create([
            'user_id' => Auth::id(),
            'aktivitas' => 'Menghapus data peminjaman alat',
        ]);

        return redirect()
            ->route('admin.peminjaman.index')
            ->with('success', 'Data peminjaman berhasil dihapus.');
    }
}
