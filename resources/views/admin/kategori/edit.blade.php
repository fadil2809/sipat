@extends('layouts.dashboard')

@section('title', 'Edit Kategori')

@section('content')
<div class="container-fluid">

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
        <div class="card-body">

            <form method="POST" action="{{ route('admin.kategori.update', $kategori->id) }}">
                @csrf
                @method('PUT')

                {{-- Nama Kategori --}}
                <div class="mb-3">
                    <label class="form-label">
                        Nama Kategori <span class="text-danger">*</span>
                    </label>
                    <input type="text"
                           name="nama"
                           class="form-control"
                           value="{{ old('nama', $kategori->nama) }}"
                           maxlength="50"
                           required>
                    <small class="text-muted">
                        Wajib diisi, maksimal 50 karakter
                    </small>
                </div>

                {{-- Deskripsi --}}
                <div class="mb-3">
                    <label class="form-label">
                        Deskripsi <span class="text-danger">*</span>
                    </label>
                    <textarea name="deskripsi"
                              class="form-control"
                              rows="3"
                              maxlength="255"
                              required>{{ old('deskripsi', $kategori->deskripsi) }}</textarea>
                    <small class="text-muted">
                        Wajib diisi, maksimal 255 karakter
                    </small>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        Update
                    </button>
                    <a href="{{ route('admin.kategori.index') }}" class="btn btn-secondary">
                        Kembali
                    </a>
                </div>

            </form>

        </div>
    </div>

</div>
@endsection
