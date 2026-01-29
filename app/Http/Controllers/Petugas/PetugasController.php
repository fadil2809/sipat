<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use App\Models\LogAktivitas;

class PetugasController extends Controller
{
    // ===============================
    // DAFTAR PEMINJAMAN MENUNGGU
    // ===============================
    public function menyetujuiPeminjaman()
    {
        $peminjamans = Peminjaman::with(['user', 'alat'])
            ->where('status', 'menunggu')
            ->get();

        return view('petugas.peminjaman.index', compact('peminjamans'));
    }

    // ===============================
    // SETUJUI PEMINJAMAN
    // ===============================
    public function setujui($id)
    {
        $peminjaman = Peminjaman::with('alat')->findOrFail($id);

        if ($peminjaman->alat->stok < 1) {
            return back()->with('error', 'Stok alat habis');
        }

        $peminjaman->update([
            'status' => 'dipinjam',
        ]);

        // kurangi stok
        $peminjaman->alat->decrement('stok');

        LogAktivitas::create([
            'user_id' => auth()->id(),
            'aktivitas' => 'Petugas menyetujui peminjaman alat: ' . $peminjaman->alat->nama_alat,
        ]);

        return back()->with('success', 'Peminjaman disetujui');
    }

    // ===============================
    // MONITOR ALAT DIPINJAM
    // ===============================
    public function memantauPengembalian()
    {
        $peminjamans = Peminjaman::with(['user', 'alat'])
            ->where('status', 'dipinjam')
            ->get();

        return view('petugas.pengembalian.index', compact('peminjamans'));
    }
    // ===============================
    // LAPORAN PEMINJAMAN
    // ===============================
    public function laporanPeminjaman()
    {
        $peminjamans = Peminjaman::with(['user', 'alat'])
            ->latest()
            ->get();

        return view('petugas.laporan.index', compact('peminjamans'));
    }

    // ===============================
    // CETAK LAPORAN
    // ===============================
    public function cetakLaporan()
    {
        $peminjamans = Peminjaman::with(['user', 'alat'])
            ->latest()
            ->get();

        return view('petugas.laporan.cetak', compact('peminjamans'));
    }

}
