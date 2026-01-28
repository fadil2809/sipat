@extends('layouts.dashboard')

@section('title', 'Dashboard Peminjam')

@section('content')
<h2>Dashboard Peminjam</h2>

<ul>
    <li>Jumlah alat tersedia: <strong>{{ $alatTersedia }}</strong></li>
    <li>Alat sedang dipinjam: <strong>{{ $dipinjam }}</strong></li>
</ul>

<hr>

<h3>Riwayat Terakhir</h3>

@if($riwayat->isEmpty())
    <p>Belum ada peminjaman.</p>
@else
<table border="1" cellpadding="8">
    <tr>
        <th>Alat</th>
        <th>Tanggal</th>
        <th>Status</th>
    </tr>
    @foreach($riwayat as $p)
    <tr>
        <td>{{ $p->alat->nama_alat }}</td>
        <td>{{ $p->tanggal_pinjam }}</td>
        <td>{{ $p->status }}</td>
    </tr>
    @endforeach
</table>
@endif
@endsection
