@extends('layouts.dashboard')

@section('title', 'Edit Kategori')

@section('content')
<h2>Edit Kategori</h2>

@if ($errors->any())
    <div style="color:red; margin-bottom:10px;">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="POST" action="{{ route('admin.kategori.update', $kategori->id) }}">
    @csrf
    @method('PUT')

    <label>Nama Kategori</label><br>
    <input type="text" name="nama" value="{{ old('nama', $kategori->nama) }}"><br><br>

    <label>Deskripsi</label><br>
    <textarea name="deskripsi">{{ old('deskripsi', $kategori->deskripsi) }}</textarea><br><br>

    <button type="submit">Update</button>
    <a href="{{ route('admin.kategori.index') }}">Kembali</a>
</form>
@endsection
