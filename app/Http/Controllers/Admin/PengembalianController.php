<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
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

    public function store($id)
    {
        $peminjaman = Peminjaman::with('alat')->findOrFail($id);

        if ($peminjaman->status === 'dikembalikan') {
            return back()->with('error', 'Alat sudah dikembalikan');
        }

        $peminjaman->update([
            'status' => 'dikembalikan',
            'tanggal_kembali' => Carbon::now(),
        ]);

        // tambah stok alat
        $peminjaman->alat->increment('stok');

        return back()->with('success', 'Pengembalian berhasil');
    }
}
