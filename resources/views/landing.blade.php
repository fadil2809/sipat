@extends('layouts.landing')

@section('title', 'Beranda')

@section('content')
<section style="padding: 80px; display: flex; justify-content: space-between;">
    <div style="max-width: 50%;">
        <h2 style="font-size: 42px; margin-bottom: 20px;">
            Sistem Informasi Peminjaman Alat
        </h2>
        <p style="font-size: 18px; margin-bottom: 30px;">
            Kelola peminjaman alat dengan mudah, cepat, dan terstruktur
            untuk admin, petugas, dan peminjam.
        </p>

        <a href="{{ route('login') }}"
           style="background:#1e40af;color:white;padding:12px 28px;border-radius:8px;text-decoration:none;">
            Login Sekarang
        </a>
    </div>

    <img src="https://illustrations.popsy.co/blue/web-development.svg"
         alt="Ilustrasi"
         width="420">
</section>
@endsection
