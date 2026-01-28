@extends('layouts.dashboard')

@section('title', 'Pengembalian Alat')

@section('content')
    <h2>Pengembalian Alat</h2>

    @if (session('success'))
        <p style="color:green">{{ session('success') }}</p>
    @endif

    @if (session('error'))
        <p style="color:red">{{ session('error') }}</p>
    @endif

    <table border="1" cellpadding="10" cellspacing="0" width="100%">
        <tr>
            <th>No</th>
            <th>Peminjam</th>
            <th>Alat</th>
            <th>Tanggal Pinjam</th>
            <th>Jatuh Tempo</th>
            <th>Aksi</th>
        </tr>

        @foreach ($peminjamans as $peminjaman)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $peminjaman->user->name }}</td>
                <td>{{ $peminjaman->alat->nama_alat }}</td>
                <td>{{ $peminjaman->tanggal_pinjam }}</td>
                <td>{{ $peminjaman->tanggal_jatuh_tempo }}</td>
                <td>

                    <form action="{{ route('admin.pengembalian.kembalikan', $peminjaman->id) }}" method="POST">
                        @csrf
                        <button onclick="return confirm('Konfirmasi pengembalian?')">
                            Kembalikan
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
@endsection
