@extends('layouts.dashboard')

@section('title', 'Data Alat')

@section('content')
<h2>Data Alat</h2>

<a href="{{ route('admin.alat.create') }}">+ Tambah Alat</a>
<br><br>

@if (session('success'))
    <p style="color:green">{{ session('success') }}</p>
@endif

@if (session('error'))
    <p style="color:red">{{ session('error') }}</p>
@endif

<table border="1" cellpadding="10" cellspacing="0" width="100%">
    <tr>
        <th>No</th>
        <th>Nama Alat</th>
        <th>Kategori</th>
        <th>Stok</th>
        <th>Aksi</th>
    </tr>

    @foreach ($alats as $alat)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $alat->nama_alat }}</td>
            <td>{{ $alat->kategori->nama ?? '-' }}</td>
            <td>{{ $alat->stok }}</td>
            <td>
                <a href="{{ route('admin.alat.edit', $alat->id) }}">Edit</a>

                <form action="{{ route('admin.alat.destroy', $alat->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button onclick="return confirm('Hapus data?')">Hapus</button>
                </form>
            </td>
        </tr>
    @endforeach
</table>
@endsection
