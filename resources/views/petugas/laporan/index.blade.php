@extends('layouts.dashboard')

@section('title', 'Laporan Peminjaman')

@section('content')
<h2>Laporan Peminjaman</h2>

<a href="{{ route('petugas.laporan-peminjaman.cetak') }}" target="_blank">
    <button>Cetak Laporan</button>
</a>

<br><br>

<table border="1" cellpadding="8" width="100%">
    <tr>
        <th>No</th>
        <th>Peminjam</th>
        <th>Alat</th>
        <th>Tgl Pinjam</th>
        <th>Tgl Kembali</th>
        <th>Status</th>
    </tr>

    @foreach($peminjamans as $p)
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $p->user->name }}</td>
        <td>{{ $p->alat->nama_alat }}</td>
        <td>{{ $p->tanggal_pinjam }}</td>
        <td>{{ $p->tanggal_kembali ?? '-' }}</td>
        <td>{{ $p->status }}</td>
    </tr>
    @endforeach
</table>
@endsection
