@extends('layouts.dashboard')

@section('title', 'Tambah Kategori')

@section('content')
<h2>Tambah Kategori</h2>

@if ($errors->any())
    <div style="color:red; margin-bottom:10px;">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
    </div>
@endif

<form method="POST" action="{{ route('admin.kategori.store') }}">
    @csrf

    <label>Nama Kategori</label><br>
    <input type="text" name="nama" value="{{ old('nama') }}"><br><br>

    <label>Deskripsi</label><br>
    <textarea name="deskripsi">{{ old('deskripsi') }}</textarea><br><br>

    <button type="submit">Simpan</button>
    <a href="{{ route('admin.kategori.index') }}">Kembali</a>
</form>
@endsection
