@extends('layouts.landing')

@section('title', 'Register')

@push('styles')
<style>
    .auth-container {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 80vh;
    }

    .auth-card {
        background: white;
        padding: 40px;
        width: 380px;
        border-radius: 12px;
        box-shadow: 0 10px 25px rgba(0,0,0,.1);
    }

    .auth-card h2 {
        text-align: center;
        margin-bottom: 25px;
    }

    .form-group {
        margin-bottom: 15px;
    }

    .form-group label {
        font-weight: 500;
    }

    .form-group input {
        width: 100%;
        padding: 10px;
        margin-top: 5px;
        border-radius: 8px;
        border: 1px solid #ccc;
    }

    .btn-auth {
        width: 100%;
        background: #020617;
        color: white;
        padding: 12px;
        border-radius: 8px;
        border: none;
        margin-top: 10px;
        font-weight: 600;
        cursor: pointer;
    }

    .auth-footer {
        text-align: center;
        margin-top: 15px;
        font-size: 14px;
    }

    .auth-footer a {
        color: #020617;
        font-weight: 600;
        text-decoration: none;
    }

    /* Pesan error sementara */
    .password-message {
        font-size: 13px;
        margin-top: 6px;
        padding: 6px 10px;
        border-radius: 6px;
        display: none;
        transition: all 0.3s ease;
    }

    .error {
        background: #fee2e2;
        color: #dc2626;
        border: 1px solid #fecaca;
    }
</style>
@endpush

@section('content')
<div class="auth-container">
    <div class="auth-card">
        <h2>Register</h2>

        <form method="POST" action="{{ route('register') }}" id="registerForm">
            @csrf

            <div class="form-group">
                <label>Nama</label>
                <input type="text" name="name" required>
            </div>

            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" required>
            </div>

            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" id="password" required>
                <div id="passwordStrengthMessage" class="password-message"></div>
            </div>

            <div class="form-group">
                <label>Konfirmasi Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" required>
                <div id="passwordMatchMessage" class="password-message"></div>
            </div>

            <button type="submit" class="btn-auth">Register</button>
        </form>

        <div class="auth-footer">
            Sudah punya akun?
            <a href="{{ route('login') }}">Login</a>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    const passwordInput = document.getElementById('password');
    const confirmInput = document.getElementById('password_confirmation');
    const strengthMessage = document.getElementById('passwordStrengthMessage');
    const matchMessage = document.getElementById('passwordMatchMessage');
    const form = document.getElementById('registerForm');

    // Fungsi show message sementara
    function showMessage(element, text) {
        element.textContent = text;
        element.className = 'password-message error';
        element.style.display = 'block';

        // Hilang otomatis setelah 5 detik
        setTimeout(() => {
            element.style.opacity = '0';
            setTimeout(() => {
                element.style.display = 'none';
                element.style.opacity = '1';
                element.textContent = '';
            }, 300);
        }, 5000);
    }

    // Fungsi hide message
    function hideMessage(element) {
        element.style.display = 'none';
        element.textContent = '';
    }

    // Validasi kekuatan password
    function validatePassword(password) {
        const hasMinLength = password.length >= 8;
        const hasUpper = /[A-Z]/.test(password);
        const hasLower = /[a-z]/.test(password);
        const hasNumber = /[0-9]/.test(password);
        const hasSpecial = /[!@#$%^&*(),.?":{}|<>]/.test(password);

        let messages = [];

        if (!hasMinLength) messages.push("Minimal 8 karakter");
        if (!hasUpper) messages.push("Huruf besar (A-Z)");
        if (!hasLower) messages.push("Huruf kecil (a-z)");
        if (!hasNumber) messages.push("Angka (0-9)");
        if (!hasSpecial) messages.push("Karakter khusus (!@#$%^&*)");

        if (messages.length === 0) {
            return { isValid: true, message: "" };
        }

        return { 
            isValid: false, 
            message: "Password kurang aman: " + messages.join(", ")
        };
    }

    // Validasi hanya saat submit
    form.addEventListener('submit', function(e) {
        // Reset pesan sebelumnya
        hideMessage(strengthMessage);
        hideMessage(matchMessage);

        const password = passwordInput.value;
        const confirmPassword = confirmInput.value;

        let hasError = false;

        // Cek kekuatan password
        const passwordCheck = validatePassword(password);
        if (!passwordCheck.isValid) {
            showMessage(strengthMessage, passwordCheck.message);
            hasError = true;
        }

        // Cek kecocokan konfirmasi
        if (password !== confirmPassword) {
            showMessage(matchMessage, "Konfirmasi password tidak sama");
            hasError = true;
        }

        // Jika ada error, batalkan submit
        if (hasError) {
            e.preventDefault();
        }
    });
</script>
@endpush