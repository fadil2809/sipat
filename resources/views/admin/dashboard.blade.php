@extends('layouts.dashboard')

@section('title', 'Dashboard Admin')

@section('content')
<div class="container-fluid py-4">

    {{-- Header --}}
    <div class="mb-4">
        <h3 class="fw-bold">Dashboard Admin</h3>
        <p class="text-muted">Halaman utama pengelolaan sistem.</p>
    </div>

    {{-- Informasi Fitur Admin --}}
    <div class="card border-0 shadow-sm rounded-4 p-4">
        
        <h5 class="fw-semibold mb-3">Fitur yang Tersedia untuk Admin:</h5>

        <ul class="list-group list-group-flush">
            <li class="list-group-item d-flex align-items-center">
                <i class="bi bi-tools me-3 text-primary"></i>
                Mengelola Data Alat
            </li>

            <li class="list-group-item d-flex align-items-center">
                <i class="bi bi-box-arrow-up me-3 text-success"></i>
                Mengelola Data Peminjaman
            </li>

            <li class="list-group-item d-flex align-items-center">
                <i class="bi bi-arrow-repeat me-3 text-warning"></i>
                Mengelola Data Pengembalian
            </li>

            <li class="list-group-item d-flex align-items-center">
                <i class="bi bi-file-earmark-text me-3 text-dark"></i>
                Melihat Data Laporan
            </li>

            <li class="list-group-item d-flex align-items-center">
                <i class="bi bi-people me-3 text-secondary"></i>
                Mengelola Data Pengguna
            </li>
        </ul>

    </div>

</div>
@endsection
