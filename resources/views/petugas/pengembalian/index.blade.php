@extends('layouts.dashboard')

@section('title', 'Memantau Pengembalian')

@section('content')
<h3>Alat Sedang Dipinjam</h3>

<table border="1" cellpadding="8" width="100%">
    <tr>
        <th>No</th>
        <th>Peminjam</th>
        <th>Alat</th>
        <th>Tanggal Pinjam</th>
        <th>Jatuh Tempo</th>
    </tr>

    @foreach ($peminjamans as $p)
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $p->user->name }}</td>
        <td>{{ $p->alat->nama_alat }}</td>
        <td>{{ $p->tanggal_pinjam }}</td>
        <td>{{ $p->tanggal_jatuh_tempo }}</td>
    </tr>
    @endforeach
</table>
@endsection
