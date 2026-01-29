<?php

namespace App\Http\Controllers\Peminjam;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use App\Models\LogAktivitas;
use App\Models\Alat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PeminjamanController extends Controller
{
    public function index()
    {
        $peminjamans = Peminjaman::with('alat')
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('peminjam.peminjaman.index', compact('peminjamans'));
    }

    public function create()
    {
        $alats = Alat::where('stok', '>', 0)->get();
        return view('peminjam.peminjaman.create', compact('alats'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'alat_id' => 'required|exists:alats,id',
            'tanggal_pinjam' => 'required|date',
            'tanggal_jatuh_tempo' => 'required|date|after_or_equal:tanggal_pinjam',
        ]);

        $alat = Alat::findOrFail($request->alat_id);

        if ($alat->stok < 1) {
            return back()->withErrors('Stok alat habis');
        }

        // ❗ CEGAH PINJAM DOBEL
        $sudahPinjam = Peminjaman::where('user_id', Auth::id())
            ->where('alat_id', $alat->id)
            ->where('status', 'dipinjam')
            ->exists();

        if ($sudahPinjam) {
            return back()->withErrors('Anda masih meminjam alat ini');
        }

        Peminjaman::create([
            'user_id' => Auth::id(),
            'alat_id' => $alat->id,
            'tanggal_pinjam' => $request->tanggal_pinjam,
            'tanggal_jatuh_tempo' => $request->tanggal_jatuh_tempo,
            'status' => 'dipinjam',
        ]);
        LogAktivitas::create([
            'user_id' => auth()->id(),
            'aktivitas' => 'Mengajukan peminjaman alat',
        ]);

        $alat->decrement('stok');

        return redirect()
            ->route('peminjam.peminjaman.index')
            ->with('success', 'Peminjaman berhasil diajukan');
    }

    // ✅ PENGEMBALIAN USER
    public function kembalikan($id)
    {
        $peminjaman = Peminjaman::where('id', $id)
            ->where('user_id', Auth::id())
            ->where('status', 'dipinjam')
            ->firstOrFail();

        $peminjaman->update([
            'status' => 'dikembalikan',
            'tanggal_kembali' => now(),
        ]);

        $peminjaman->alat->increment('stok');

        return back()->with('success', 'Alat berhasil dikembalikan');
    }
}
