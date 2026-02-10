@extends('layouts.landing')

@section('title', 'Beranda')

@section('content')
<style>
    .hero-section {
        min-height: 90vh;
        display: flex;
        align-items: center;
        background: linear-gradient(135deg, #24272c, #636363);
        color: white;
    }

    .hero-title {
        font-size: 3rem;
        font-weight: bold;
    }

    .hero-text {
        font-size: 1.1rem;
        opacity: 0.9;
    }

    .btn-custom {
        background-color: #ffffff;
        color: #4e73df;
        border-radius: 30px;
        padding: 10px 30px;
        font-weight: 600;
        transition: 0.3s;
    }

    .btn-custom:hover {
        background-color: #f8f9fa;
        transform: translateY(-3px);
    }

    .feature-box {
        padding: 20px;
        border-radius: 15px;
        background: #f8f9fa;
        transition: 0.3s;
    }

    .feature-box:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 20px rgba(0,0,0,0.1);
    }
</style>

<section class="hero-section">
    <div class="container">
        <div class="row align-items-center">
            
            <!-- Text -->
            <div class="col-md-6">
                <h1 class="hero-title">
                    Sistem Peminjaman Alat. <br> Lebih Mudah & Cepat
                </h1>
                <p class="hero-text mt-3">
                    Sistem berbasis web untuk memantau peminjaman,
                    pengembalian, dan peminjaman alat data. penggunaan secara real-time.
                </p>
                <a href="{{ route('login') }}" class="btn btn-custom mt-4">
                    Login Sekarang
                </a>
            </div>

            <!-- Visual -->
            <div class="col-md-6 text-center">
                <img src="logosipat23.png" 
                     alt="Ilustrasi"
                     class="img-fluid"
                     style="max-height: 350px;">
            </div>

        </div>
    </div>
</section>
@endsection
