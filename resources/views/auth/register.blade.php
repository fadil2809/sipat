@extends('layouts.landing')

@section('title', 'Register')

@section('content')

<style>
    body {
        background: linear-gradient(135deg, #0f2027, #203a43, #2c5364);
        min-height: 100vh;
    }

    .register-wrapper {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .register-card {
        width: 100%;
        max-width: 450px;
        padding: 40px;
        border-radius: 20px;
        background: #ffffff;
        box-shadow: 0 15px 40px rgba(0,0,0,0.2);
    }

    .register-title {
        font-weight: bold;
        margin-bottom: 25px;
        color: #2c5364;
    }

    .form-control {
        border-radius: 10px;
        padding: 12px;
    }

    .form-control:focus {
        border-color: #17c1e8;
        box-shadow: 0 0 0 2px rgba(23,193,232,0.2);
    }

    .btn-register {
        background: linear-gradient(90deg, #17c1e8, #00bcd4);
        border: none;
        padding: 12px;
        border-radius: 30px;
        font-weight: 600;
        color: white;
        transition: 0.3s;
    }

    .btn-register:hover {
        opacity: 0.9;
        transform: translateY(-3px);
    }

    .error-message {
        background: #ffe5e5;
        color: #c0392b;
        padding: 10px;
        border-radius: 8px;
        margin-bottom: 15px;
        font-size: 14px;
    }

    .auth-footer a {
        color: #17c1e8;
        text-decoration: none;
        font-weight: 500;
    }

    .auth-footer a:hover {
        text-decoration: underline;
    }
</style>

<div class="register-wrapper">
    <div class="register-card">
        <h2 class="text-center register-title">Buat Akun Baru</h2>

        @if ($errors->any())
            <div class="error-message">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="mb-3">
                <label class="mb-1">Nama Lengkap</label>
                <input type="text" name="name" class="form-control" placeholder="Masukkan nama lengkap" required>
            </div>

            <div class="mb-3">
                <label class="mb-1">Email</label>
                <input type="email" name="email" class="form-control" placeholder="Masukkan email aktif" required>
            </div>

            <div class="mb-3">
                <label class="mb-1">Password</label>
                <input type="password" name="password" class="form-control" placeholder="Buat password" required>
            </div>

            <div class="mb-4">
                <label class="mb-1">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" class="form-control" placeholder="Ulangi password" required>
            </div>

            <button class="btn btn-register w-100">Daftar Sekarang</button>
        </form>

        <div class="auth-footer text-center mt-4">
            Sudah punya akun? 
            <a href="{{ route('login') }}">Login di sini</a>
        </div>
    </div>
</div>

@endsection
