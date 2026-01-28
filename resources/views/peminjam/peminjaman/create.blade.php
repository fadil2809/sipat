@extends('layouts.dashboard')

@section('title', 'Ajukan Peminjaman')

@section('content')
<h2>Ajukan Peminjaman</h2>

@if($errors->any())
    <p style="color:red">{{ $errors->first() }}</p>
@endif

<form method="POST" action="{{ route('peminjam.peminjaman.store') }}">
@csrf

<label>Alat</label><br>
<select name="alat_id" required>
    <option value="">-- Pilih Alat --</option>
    @foreach($alats as $alat)
        <option value="{{ $alat->id }}">
            {{ $alat->nama_alat }} (stok: {{ $alat->stok }})
        </option>
    @endforeach
</select>

<br><br>

<label>Tanggal Pinjam</label><br>
<input type="date" name="tanggal_pinjam" required>

<br><br>

<label>Tanggal Jatuh Tempo</label><br>
<input type="date" name="tanggal_jatuh_tempo" required>

<br><br>

<button type="submit">Ajukan</button>
</form>
@endsection
