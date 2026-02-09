@extends('layouts.landing')

@section('title', 'Login')

@section('content')

<style>
    body {
        background: linear-gradient(135deg, #1e1e2f, #2b2b5e);
        min-height: 100vh;
    }

    .login-wrapper {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .login-card {
        width: 100%;
        max-width: 420px;
        padding: 40px;
        border-radius: 20px;
        background: rgba(255, 255, 255, 0.08);
        backdrop-filter: blur(15px);
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
        color: white;
    }

    .login-title {
        font-weight: bold;
        margin-bottom: 30px;
    }

    .form-control {
        border-radius: 10px;
        padding: 12px;
        border: none;
    }

    .form-control:focus {
        box-shadow: 0 0 0 2px #8f5cff;
    }

    .btn-login {
        background: #8f5cff;
        border: none;
        padding: 12px;
        border-radius: 30px;
        font-weight: 600;
        transition: 0.3s;
    }

    .btn-login:hover {
        background: #a47bff;
        transform: translateY(-3px);
    }

    .error-message {
        background: rgba(255, 0, 0, 0.2);
        padding: 10px;
        border-radius: 8px;
        margin-bottom: 15px;
        font-size: 14px;
    }

    .auth-footer a {
        color: #c5b3ff;
        text-decoration: none;
    }

    .auth-footer a:hover {
        text-decoration: underline;
    }
</style>

<div class="login-wrapper">
    <div class="login-card">
        <h2 class="text-center login-title">Welcome Back 👋</h2>

        @if ($errors->any())
            <div class="error-message">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="mb-3">
                <label class="mb-1">Email</label>
                <input type="email" name="email" class="form-control" placeholder="Masukkan email" required>
            </div>

            <div class="mb-4">
                <label class="mb-1">Password</label>
                <input type="password" name="password" class="form-control" placeholder="Masukkan password" required>
            </div>

            <button class="btn btn-login w-100">Masuk</button>
        </form>

        <div class="auth-footer text-center mt-4">
            Belum punya akun? 
            <a href="{{ route('register') }}">Daftar sekarang</a>
        </div>
    </div>
</div>

@endsection
