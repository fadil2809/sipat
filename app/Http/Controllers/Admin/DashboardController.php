<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Alat;
use App\Models\Peminjaman;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard', [
            'totalUser' => User::count(),
            'totalAlat' => Alat::count(),
            'dipinjam'  => Peminjaman::where('status', 'dipinjam')->count(),
        ]);
    }
}
