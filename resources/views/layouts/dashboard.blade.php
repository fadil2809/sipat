<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard')</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background: #e5e7eb;
            display: flex;
            min-height: 100vh;
        }

        /* SIDEBAR */
        .sidebar {
            width: 260px;
            background: linear-gradient(180deg, #020617, #0f172a);
            color: white;
            padding: 30px 20px;
        }

        .sidebar h2 {
            font-size: 18px;
            margin-bottom: 35px;
            letter-spacing: 1px;
            text-transform: uppercase;
            color: #93c5fd;
        }

        .sidebar a {
            display: flex;
            align-items: center;
            color: #e5e7eb;
            text-decoration: none;
            padding: 12px 16px;
            border-radius: 10px;
            margin-bottom: 10px;
            font-size: 14px;
            transition: all .2s ease;
        }

        .sidebar a:hover {
            background: #1e293b;
            padding-left: 22px;
        }

        /* CONTENT */
        .content {
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        header {
            background: #0f172a;
            padding: 20px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: white;
            box-shadow: 0 4px 15px rgba(0, 0, 0, .15);
        }

        header h3 {
            font-weight: 600;
            font-size: 18px;
        }

        header form button {
            background: #2563eb;
            border: none;
            color: white;
            padding: 10px 18px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 13px;
        }

        header form button:hover {
            background: #1d4ed8;
        }

        main {
            padding: 35px;
        }

        .card {
            background: white;
            padding: 30px;
            border-radius: 16px;
            box-shadow: 0 20px 35px rgba(0, 0, 0, .1);
        }

        .card h3 {
            margin-bottom: 20px;
            color: #0f172a;
        }
    </style>
</head>

<body>

    <!-- SIDEBAR -->
    <div class="sidebar">
        <h2>{{ ucfirst(auth()->user()->role) }}</h2>

        <a href="/{{ auth()->user()->role }}/dashboard">Dashboard</a>

        {{-- ADMIN --}}
        @if (auth()->user()->role === 'admin')
            <a href="/admin/users">Manajemen User</a>
            <a href="/admin/kategori">Kategori Alat</a>
            <a href="/admin/alat">Data Alat</a>
            <a href="/admin/peminjaman">Peminjaman</a>
            <a href="/admin/pengembalian">Pengembalian</a>
            <a href="/admin/log-aktivitas">Log Aktivitas</a>
        @endif

        {{-- PETUGAS --}}
        @if (auth()->user()->role === 'petugas')
            <a href="/petugas/menyetujui-peminjaman">Persetujuan Peminjaman</a>
            <a href="/petugas/memantau-pengembalian">Monitoring Pengembalian</a>
            <a href="/petugas/laporan-peminjaman">Laporan Peminjaman</a>
        @endif

        {{-- PEMINJAM --}}
        @if (auth()->user()->role === 'peminjam')
            <a href="{{ route('peminjam.peminjaman.create') }}">Ajukan Peminjaman</a>
            <a href="{{ route('peminjam.peminjaman.index') }}">Riwayat Peminjaman</a>
        @endif
    </div>

    <!-- CONTENT -->
    <div class="content">
        <header>
            <h3>@yield('title')</h3>

            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit">Logout</button>
            </form>
        </header>

        <main>
            @yield('content')
        </main>
    </div>

</body>

</html>
