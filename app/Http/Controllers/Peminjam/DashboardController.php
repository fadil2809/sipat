<?php

namespace App\Http\Controllers\Peminjam;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use App\Models\Alat;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        return view('peminjam.dashboard', [
            'alatTersedia' => Alat::where('stok', '>', 0)->count(),
            'dipinjam' => Peminjaman::where('user_id', $user->id)
                            ->where('status', 'dipinjam')->count(),
            'riwayat' => Peminjaman::where('user_id', $user->id)
                            ->latest()->take(5)->get()
        ]);
    }
}
