@extends('layouts.dashboard')

@section('title', 'Edit Alat')

@section('content')
<div class="container-fluid">

    {{-- Alert Error --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-header bg-white fw-semibold">
            Form Edit Alat
        </div>

        <div class="card-body">
            <form action="{{ route('admin.alat.update', $alat->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Nama Alat -->
                <div class="mb-3">
                    <label class="form-label">Nama Alat</label>
                    <input type="text"
                           name="nama_alat"
                           class="form-control"
                           value="{{ old('nama_alat', $alat->nama_alat) }}"
                           maxlength="100"
                           placeholder="Maksimal 100 karakter"
                           required>
                </div>

                <!-- Deskripsi -->
                <div class="mb-3">
                    <label class="form-label">Deskripsi Alat</label>
                    <textarea name="deskripsi"
                              class="form-control"
                              rows="3"
                              maxlength="255"
                              placeholder="Maksimal 255 karakter"
                              required>{{ old('deskripsi', $alat->deskripsi) }}</textarea>
                </div>

                <!-- Kategori -->
                <div class="mb-3">
                    <label class="form-label">Kategori</label>
                    <select name="kategori_id" class="form-select" required>
                        <option value="">-- Pilih Kategori --</option>
                        @foreach ($kategoris as $kategori)
                            <option value="{{ $kategori->id }}"
                                {{ old('kategori_id', $alat->kategori_id) == $kategori->id ? 'selected' : '' }}>
                                {{ $kategori->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Stok -->
                <div class="mb-3">
                    <label class="form-label">Stok</label>
                    <input type="number"
                           name="stok"
                           class="form-control"
                           value="{{ old('stok', $alat->stok) }}"
                           min="0"
                           placeholder="Masukkan jumlah stok"
                           required>
                </div>

                <!-- Harga -->
                <div class="mb-3">
                    <label class="form-label">Harga per Item (Rp)</label>
                    <input type="number"
                           name="harga"
                           class="form-control"
                           value="{{ old('harga', $alat->harga) }}"
                           min="0"
                           placeholder="Masukkan harga"
                           required>
                </div>

                <!-- Gambar -->
                <div class="mb-3">
                    <label class="form-label">Gambar Alat</label>
                    <input type="file"
                           name="gambar_alat"
                           class="form-control"
                           accept="image/*">

                    <small class="text-muted">
                        Kosongkan jika tidak ingin mengganti gambar
                    </small>

                    @if ($alat->gambar_alat)
                        <div class="mt-2">
                            <p class="mb-1 text-muted">Gambar saat ini:</p>
                            <img src="{{ asset('storage/' . $alat->gambar_alat) }}"
                                 style="width: 120px; height: 120px; object-fit: cover;"
                                 class="img-thumbnail">
                        </div>
                    @endif
                </div>

                <!-- Button -->
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        Update
                    </button>
                    <a href="{{ route('admin.alat.index') }}" class="btn btn-secondary">
                        Kembali
                    </a>
                </div>

            </form>
        </div>
    </div>

</div>
@endsection
