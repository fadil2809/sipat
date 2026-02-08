@extends('layouts.dashboard')

@section('title', 'Dashboard Admin')

@section('content')
<div class="container-fluid py-4">

    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-sm rounded-4 bg-light">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div>
                        <h2 class="fw-bold mb-1 text-dark">Dashboard Administrator</h2>
                        <p class="text-muted mb-0">Sistem Informasi Peminjaman Alat Terpadu</p>
                    </div>
                    <div class="d-none d-md-block">
                        <i class="bi bi-speedometer2 fs-1 text-secondary"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">

        <div class="col-md-3">
            <div class="card border-0 shadow-sm rounded-4 h-100 text-center hover-card">
                <div class="card-body">
                    <div class="icon-box bg-primary text-white mb-3">
                        <i class="bi bi-tools"></i>
                    </div>
                    <h6 class="fw-semibold">Manajemen Alat</h6>
                    <p class="text-muted small">Kelola data alat dan inventaris</p>
                    <a href="#" class="btn btn-sm btn-outline-primary">Kelola</a>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card border-0 shadow-sm rounded-4 h-100 text-center hover-card">
                <div class="card-body">
                    <div class="icon-box bg-success text-white mb-3">
                        <i class="bi bi-person-badge"></i>
                    </div>
                    <h6 class="fw-semibold">Manajemen Petugas</h6>
                    <p class="text-muted small">Kelola akun petugas sistem</p>
                    <a href="#" class="btn btn-sm btn-outline-success">Kelola</a>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card border-0 shadow-sm rounded-4 h-100 text-center hover-card">
                <div class="card-body">
                    <div class="icon-box bg-warning text-white mb-3">
                        <i class="bi bi-people"></i>
                    </div>
                    <h6 class="fw-semibold">Manajemen Peminjam</h6>
                    <p class="text-muted small">Kelola data peminjam</p>
                    <a href="#" class="btn btn-sm btn-outline-warning">Kelola</a>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card border-0 shadow-sm rounded-4 h-100 text-center hover-card">
                <div class="card-body">
                    <div class="icon-box bg-dark text-white mb-3">
                        <i class="bi bi-file-earmark-text"></i>
                    </div>
                    <h6 class="fw-semibold">Laporan</h6>
                    <p class="text-muted small">Lihat laporan peminjaman</p>
                    <a href="#" class="btn btn-sm btn-outline-dark">Lihat</a>
                </div>
            </div>
        </div>

    </div>
</div>

{{-- Custom Style --}}
<style>
.icon-box{
    width:60px;
    height:60px;
    border-radius:16px;
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:26px;
    margin:0 auto;
}

.hover-card{
    transition:all 0.3s ease;
}

.hover-card:hover{
    transform:translateY(-6px);
    box-shadow:0 12px 25px rgba(0,0,0,0.08);
}
</style>
@endsection