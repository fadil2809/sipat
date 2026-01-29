<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use App\Models\LogAktivitas;
use Carbon\Carbon;

class PengembalianController extends Controller
{
    public function index()
    {
        $peminjamans = Peminjaman::with(['user', 'alat'])
            ->where('status', 'dipinjam')
            ->get();

        return view('admin.pengembalian.index', compact('peminjamans'));
    }

    public function kembalikan($id)
    {
        $peminjaman = Peminjaman::with('alat')->findOrFail($id);

        if ($peminjaman->status === 'dikembalikan') {
            return back()->with('error', 'Alat sudah dikembalikan');
        }

        // UPDATE STATUS
        $peminjaman->update([
            'status' => 'dikembalikan',
            'tanggal_kembali' => Carbon::now(),
        ]);

        // TAMBAH STOK
        $peminjaman->alat->increment('stok');

        // LOG AKTIVITAS
        LogAktivitas::create([
            'user_id' => auth()->id(),
            'aktivitas' => 'Admin mengonfirmasi pengembalian alat',
        ]);

        return back()->with('success', 'Pengembalian berhasil');
    }
}
