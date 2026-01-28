@extends('layouts.dashboard')

@section('title', 'Riwayat Peminjaman')

@section('content')
<h2>Riwayat Peminjaman</h2>

@if(session('success'))
    <p style="color:green">{{ session('success') }}</p>
@endif

<table border="1" cellpadding="8" width="100%">
<tr>
    <th>No</th>
    <th>Alat</th>
    <th>Tgl Pinjam</th>
    <th>Jatuh Tempo</th>
    <th>Status</th>
    <th>Aksi</th>
</tr>

@foreach($peminjamans as $p)
<tr>
    <td>{{ $loop->iteration }}</td>
    <td>{{ $p->alat->nama_alat }}</td>
    <td>{{ $p->tanggal_pinjam }}</td>
    <td>{{ $p->tanggal_jatuh_tempo }}</td>
    <td>{{ $p->status }}</td>
    <td>
        @if($p->status == 'dipinjam')
        <form method="POST"
            action="{{ route('peminjam.peminjaman.kembalikan', $p->id) }}">
            @csrf
            <button>Kembalikan</button>
        </form>
        @else
            -
        @endif
    </td>
</tr>
@endforeach
</table>
@endsection
