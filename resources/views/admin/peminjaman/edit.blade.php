@extends('layouts.dashboard')

@section('title', 'Edit Peminjaman')

@section('content')
    <h2>Edit Peminjaman</h2>

    <form action="{{ route('admin.peminjaman.update', $peminjaman->id) }}" method="POST">
        @csrf
        @method('PUT')

        <p>
            <strong>Peminjam:</strong>
            {{ $peminjaman->user->name }}
        </p>

        <p>
            <strong>Alat:</strong>
            {{ $peminjaman->alat->nama_alat }}
        </p>

        <p>
            <label>Tanggal Pinjam</label><br>
            <input type="date" name="tanggal_pinjam"
                value="{{ old('tanggal_pinjam', $peminjaman->tanggal_pinjam) }}" required>
        </p>

        <p>
            <label>Tanggal Jatuh Tempo</label><br>
            <input type="date" name="tanggal_jatuh_tempo"
                value="{{ old('tanggal_jatuh_tempo', $peminjaman->tanggal_jatuh_tempo) }}" required>
        </p>

        <button type="submit">Update</button>
        <a href="{{ route('admin.peminjaman.index') }}">Kembali</a>
    </form>
@endsection
