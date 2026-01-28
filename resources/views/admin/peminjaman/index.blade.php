@extends('layouts.dashboard')

@section('title', 'Data Peminjaman')

@section('content')
    <h2>Data Peminjaman</h2>

    <a href="{{ route('admin.peminjaman.create') }}">+ Tambah Peminjaman</a>

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
            <th>Tgl Pinjam</th>
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
                    
                    <a href="{{ route('admin.peminjaman.edit', $peminjaman->id) }}">Edit</a>

                    <form action="{{ route('admin.peminjaman.destroy', $peminjaman->id) }}" method="POST"
                        style="display:inline">
                        @csrf
                        @method('DELETE')
                        <button onclick="return confirm('Hapus data?')">Hapus</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>
@endsection
