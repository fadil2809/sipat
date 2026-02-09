<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard')</title>

    {{-- Font & Bootstrap --}}
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: #f4f6f9;
            min-height: 100vh;
            display: flex;
        }

        /* ================= SIDEBAR ================= */

        .sidebar {
            width: 260px;
            color: #fff;
            padding: 30px 20px;
            transition: .3s;
        }

        /* WARNA BERDASARKAN ROLE */
        .admin-sidebar {
            background: linear-gradient(180deg, #7f1d1d, #b91c1c);
        }

        .petugas-sidebar {
            background: linear-gradient(180deg, #065f46, #10b981);
        }

        .peminjam-sidebar {
            background: linear-gradient(180deg, #4c1d95, #7c3aed);
        }

        .sidebar h2 {
            font-size: 13px;
            text-transform: uppercase;
            text-align: center;
            letter-spacing: 1px;
            margin-bottom: 30px;
            opacity: .85;
        }

        .sidebar a,
        .sidebar .dropdown-toggle {
            display: block;
            color: #f1f5f9;
            text-decoration: none;
            padding: 12px 16px;
            border-radius: 12px;
            margin-bottom: 8px;
            font-size: 14px;
            transition: .25s;
            width: 100%;
            text-align: left;
        }

        .sidebar a:hover,
        .sidebar .dropdown-toggle:hover {
            background: rgba(255, 255, 255, .15);
            padding-left: 22px;
        }

        .sidebar .dropdown-menu {
            background: rgba(255, 255, 255, .15);
            border: none;
            border-radius: 12px;
        }

        .sidebar .dropdown-menu a {
            color: #fff;
        }

        /* ================= CONTENT ================= */

        .content {
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        header {
            background: #ffffff;
            padding: 18px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 10px 25px rgba(0, 0, 0, .05);
        }

        header h5 {
            margin: 0;
            font-weight: 600;
            color: #333;
        }

        main {
            padding: 30px;
            flex: 1;
        }

        .card-custom {
            background: #ffffff;
            padding: 30px;
            border-radius: 18px;
            box-shadow: 0 15px 40px rgba(0, 0, 0, .05);
        }
    </style>

    @stack('styles')
</head>

<body>

    @php
        $role = auth()->user()->role;
        $sidebarClass = '';

        if ($role === 'admin') {
            $sidebarClass = 'admin-sidebar';
        } elseif ($role === 'petugas') {
            $sidebarClass = 'petugas-sidebar';
        } elseif ($role === 'peminjam') {
            $sidebarClass = 'peminjam-sidebar';
        }
    @endphp

    {{-- SIDEBAR --}}
    <aside class="sidebar {{ $sidebarClass }}">
        <h2>{{ ucfirst($role) }}</h2>

        <a href="/{{ $role }}/dashboard">
            <i class="bi bi-speedometer2 me-2"></i> Dashboard
        </a>

        {{-- ================= ADMIN ================= --}}
        @if ($role === 'admin')
            <a href="/admin/users"><i class="bi bi-people me-2"></i> Manajemen User</a>
            <a href="/admin/kategori"><i class="bi bi-tags me-2"></i> Kategori Alat</a>
            <a href="/admin/alat"><i class="bi bi-tools me-2"></i> Data Alat</a>
            <a href="/admin/peminjaman"><i class="bi bi-box-arrow-up me-2"></i> Peminjaman</a>
            <a href="/admin/pengembalian"><i class="bi bi-box-arrow-in-down me-2"></i> Pengembalian</a>
            <a href="{{ route('admin.pengembalian.rekap') }}"><i class="bi bi-clipboard-data me-2"></i> Rekap</a>
            <a href="/admin/log-aktivitas"><i class="bi bi-clock-history me-2"></i> Log Aktivitas</a>
        @endif

        {{-- ================= PETUGAS ================= --}}
        @if ($role === 'petugas')
            <a href="{{ route('petugas.persetujuan') }}"><i class="bi bi-check2-square me-2"></i> Persetujuan</a>
            <a href="{{ route('petugas.pemantauan') }}"><i class="bi bi-eye me-2"></i> Monitoring</a>
            <a href="{{ route('petugas.pemeriksaan') }}"><i class="bi bi-search me-2"></i> Pemeriksaan</a>

            <div class="dropdown">
                <button class="dropdown-toggle btn btn-transparent text-white w-100"
                    data-bs-toggle="dropdown">
                    <i class="bi bi-file-earmark-text me-2"></i> Laporan
                </button>
                <ul class="dropdown-menu w-100">
                    <li><a class="dropdown-item" href="{{ route('petugas.laporan.user') }}">Per User</a></li>
                    <li><a class="dropdown-item" href="{{ route('petugas.laporan.bulan') }}">Per Bulan</a></li>
                </ul>
            </div>
        @endif

        {{-- ================= PEMINJAM ================= --}}
        @if ($role === 'peminjam')
            <a href="{{ route('peminjam.pengajuan.create') }}"><i class="bi bi-plus-circle me-2"></i> Ajukan</a>
            <a href="{{ route('peminjam.riwayat') }}"><i class="bi bi-clock-history me-2"></i> Riwayat</a>
        @endif
    </aside>

    {{-- CONTENT --}}
    <div class="content">
        <header>
            <h5>@yield('title')</h5>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button class="btn btn-outline-danger btn-sm">
                    <i class="bi bi-box-arrow-right"></i> Logout
                </button>
            </form>
        </header>

        <main>
            <div class="card-custom">
                @yield('content')
            </div>
        </main>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>

</html>
