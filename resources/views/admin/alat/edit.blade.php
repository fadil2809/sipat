@extends('layouts.dashboard')

@section('title', 'Edit Alat')

@section('content')
<h2>Edit Alat</h2>

@if ($errors->any())
    <div style="color:red; margin-bottom:10px;">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('admin.alat.update', $alat->id) }}" method="POST">
    @csrf
    @method('PUT')

    <label>Nama Alat</label><br>
    <input type="text" name="nama_alat" value="{{ old('nama_alat', $alat->nama_alat) }}"><br><br>

    <label>Kategori</label><br>
    <select name="kategori_id">
        @foreach($kategoris as $kategori)
            <option value="{{ $kategori->id }}"
                {{ $alat->kategori_id == $kategori->id ? 'selected' : '' }}>
                {{ $kategori->nama }}
            </option>
        @endforeach
    </select><br><br>

    <label>Stok</label><br>
    <input type="number" name="stok" value="{{ old('stok', $alat->stok) }}"><br><br>

    <button type="submit">Update</button>
    <a href="{{ route('admin.alat.index') }}">Kembali</a>
</form>
@endsection
