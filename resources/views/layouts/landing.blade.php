<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Sistem Peminjaman Alat')</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        :root {
            --primary: #0f172a;
            --secondary: #1e40af;
            --accent: #3b82f6;
            --light-bg: #f8fafc;
        }

        html, body {
            height: 100%;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: var(--light-bg);
            display: flex;
            flex-direction: column;
        }

        /* NAVBAR */
        .navbar-custom {
            background: #ffffff;
            box-shadow: 0 4px 20px rgba(0,0,0,0.05);
        }

        .navbar-brand {
            font-weight: 700;
            color: var(--primary) !important;
        }

        .nav-link {
            color: #334155 !important;
            font-weight: 500;
            transition: 0.3s;
        }

        .nav-link:hover {
            color: var(--secondary) !important;
        }

        .btn-register {
            background: var(--secondary);
            color: #fff;
            border-radius: 10px;
            padding: 6px 16px;
            font-weight: 500;
            transition: 0.3s;
        }

        .btn-register:hover {
            background: var(--accent);
            color: #fff;
        }

        /* HERO */
        .hero {
            min-height: calc(100vh - 140px);
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            background: linear-gradient(135deg, #1e3a8a, #2563eb);
            color: #fff;
            padding: 60px 20px;
        }

        .hero h1 {
            font-size: 3rem;
            font-weight: 700;
        }

        .hero p {
            font-size: 1.15rem;
            max-width: 600px;
            margin: 20px auto 30px;
            opacity: 0.95;
        }

        .btn-primary-custom {
            background: #ffffff;
            color: var(--secondary);
            border-radius: 12px;
            padding: 12px 28px;
            font-weight: 600;
            transition: 0.3s;
        }

        .btn-primary-custom:hover {
            background: #f1f5f9;
            transform: translateY(-2px);
        }

        /* AUTH CARD */
        .page-wrapper {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 60px 16px;
        }

        .card-auth {
            background: #ffffff;
            border-radius: 18px;
            padding: 40px;
            width: 100%;
            max-width: 420px;
            box-shadow: 0 15px 40px rgba(0,0,0,0.08);
        }

        .card-auth h2 {
            font-weight: 700;
            color: var(--primary);
        }

        .form-control {
            border-radius: 10px;
            padding: 12px;
        }

        .form-control:focus {
            border-color: var(--secondary);
            box-shadow: 0 0 0 2px rgba(37, 99, 235, 0.2);
        }

        .error-message {
            background: #fee2e2;
            color: #991b1b;
            padding: 10px 14px;
            border-radius: 10px;
            margin-bottom: 12px;
            font-size: 14px;
        }

        .auth-footer a {
            color: var(--secondary);
            font-weight: 600;
            text-decoration: none;
        }

        .auth-footer a:hover {
            text-decoration: underline;
        }

        /* FOOTER */
        footer {
            background: #0f172a;
            color: #cbd5e1;
            text-align: center;
            padding: 18px 0;
            font-size: 14px;
        }
    </style>

    @stack('styles')
</head>

<body>

    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg navbar-custom px-4 px-lg-5">
        <div class="container-fluid">
            <a class="navbar-brand" href="/">Sistem Peminjaman</a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav align-items-lg-center gap-lg-3">
                    <li class="nav-item">
                        <a class="nav-link" href="/">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-register btn-sm" href="{{ route('register') }}">Register</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- CONTENT -->
    @yield('content')

    <!-- FOOTER -->
    <footer>
        © {{ date('Y') }} Sistem Peminjaman Alat • All Rights Reserved
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')

</body>
</html>
