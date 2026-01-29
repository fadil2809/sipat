@extends('layouts.dashboard')

@section('title', 'Menyetujui Peminjaman')

@section('content')
<h3>Daftar Peminjaman Menunggu</h3>

@if(session('success'))
    <p style="color:green">{{ session('success') }}</p>
@endif

@if(session('error'))
    <p style="color:red">{{ session('error') }}</p>
@endif

<table border="1" cellpadding="8" width="100%">
    <tr>
        <th>No</th>
        <th>Peminjam</th>
        <th>Alat</th>
        <th>Tgl Pinjam</th>
        <th>Aksi</th>
    </tr>

    @foreach ($peminjamans as $p)
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $p->user->name }}</td>
        <td>{{ $p->alat->nama_alat }}</td>
        <td>{{ $p->tanggal_pinjam }}</td>
        <td>
            <form action="{{ route('petugas.setujui', $p->id) }}" method="POST">
                @csrf
                <button onclick="return confirm('Setujui peminjaman?')">
                    Setujui
                </button>
            </form>
        </td>
    </tr>
    @endforeach
</table>
@endsection
