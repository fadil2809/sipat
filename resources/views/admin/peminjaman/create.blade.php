@extends('layouts.dashboard')

@section('title', 'Tambah Peminjaman')

@section('content')
<h2>Tambah Peminjaman</h2>

@if (session('error'))
    <div style="color:red; margin-bottom:10px;">
        {{ session('error') }}
    </div>
@endif

@if (session('success'))
    <div style="color:green; margin-bottom:10px;">
        {{ session('success') }}
    </div>
@endif

@if($errors->any())
    <div style="color:red; margin-bottom:10px;">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('admin.peminjaman.store') }}" method="POST">
    @csrf

    <div>
        <label>Peminjam</label><br>
        <select name="user_id" required>
            <option value="">-- Pilih Peminjam --</option>
            @foreach($users as $user)
                <option value="{{ $user->id }}">
                    {{ $user->name }} ({{ $user->email }})
                </option>
            @endforeach
        </select>
    </div>

    <br>

    <div>
        <label>Alat</label><br>
        <select name="alat_id" required>
            <option value="">-- Pilih Alat --</option>
            @foreach($alats as $alat)
                <option value="{{ $alat->id }}">
                    {{ $alat->nama_alat }} (Stok: {{ $alat->stok }})
                </option>
            @endforeach
        </select>
    </div>

    <br>

    <div>
        <label>Tanggal Pinjam</label><br>
        <input type="date" name="tanggal_pinjam" required>
    </div>

    <br>

    <div>
        <label>Tanggal Jatuh Tempo</label><br>
        <input type="date" name="tanggal_jatuh_tempo" required>
    </div>

    <br>

    <button type="submit">Simpan</button>
    <a href="{{ route('admin.peminjaman.index') }}">Batal</a>
</form>
@endsection
