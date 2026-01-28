@extends('layouts.dashboard')

@section('title', 'Tambah Alat')

@section('content')
<h2>Tambah Alat</h2>

@if ($errors->any())
    <div style="color:red; margin-bottom:10px;">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('admin.alat.store') }}" method="POST">
    @csrf

    <label>Nama Alat</label><br>
    <input type="text" name="nama_alat" value="{{ old('nama_alat') }}"><br><br>

    <label>Kategori</label><br>
    <select name="kategori_id">
        <option value="">-- Pilih Kategori --</option>
        @foreach($kategoris as $kategori)
            <option value="{{ $kategori->id }}"
                {{ old('kategori_id') == $kategori->id ? 'selected' : '' }}>
                {{ $kategori->nama }}
            </option>
        @endforeach
    </select><br><br>

    <label>Stok</label><br>
    <input type="number" name="stok" value="{{ old('stok') }}"><br><br>

    <button type="submit">Simpan</button>
    <a href="{{ route('admin.alat.index') }}">Kembali</a>
</form>
@endsection
