<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Sistem Peminjaman Alat')</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background: #f9fafb;
            color: #333;
        }

        /* ===== NAVBAR ===== */
        header {
            background: #020617;
            color: white;
            padding: 20px 80px;
        }

        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        nav h1 {
            font-size: 22px;
            font-weight: 700;
        }

        nav .menu a {
            color: white;
            text-decoration: none;
            margin-left: 20px;
            font-weight: 500;
        }

        nav .menu a:hover {
            text-decoration: underline;
        }

        /* ===== CONTENT ===== */
        main {
            min-height: 80vh;
        }

        /* ===== FOOTER ===== */
        footer {
            background: #020617;
            color: #cbd5e1;
            text-align: center;
            padding: 20px;
            font-size: 14px;
        }
    </style>

    @stack('styles')
</head>
<body>

<header>
    <nav>
        <h1>Peminjaman Alat</h1>

        <div class="menu">
            <a href="/">Home</a>
            <a href="#fitur">Fitur</a>
            <a href="#kontak">Kontak</a>
            <a href="{{ route('login') }}">Login</a>
            <a href="{{ route('register') }}">Register</a>
        </div>
    </nav>
</header>

<main>
    @yield('content')
</main>

<footer>
    <p>© {{ date('Y') }} Sistem Peminjaman Alat</p>
</footer>

@stack('scripts')
</body>
</html>
