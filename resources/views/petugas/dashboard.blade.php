@extends('layouts.dashboard')

@section('title', 'Dashboard Petugas')

@section('content')
<div class="card">
    <h2>Selamat Datang, Petugas</h2>
    <p>
        Anda bertugas mengelola peminjaman dan pengembalian alat.
    </p>

    <ul style="margin-top: 15px;">
        <li>Verifikasi peminjaman</li>
        <li>Kelola pengembalian alat</li>
        <li>Cek status alat</li>
    </ul>
</div>
@endsection
