@extends('layouts.dashboard')

@section('title', 'Data Peminjaman')

@section('content')
<div class="container-fluid">

    {{-- ALERT --}}
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">

            {{-- HEADER --}}
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="mb-0">Data Peminjaman</h5>

                <a href="{{ route('admin.peminjaman.create') }}" class="btn btn-primary">
                    + Tambah Peminjaman
                </a>
            </div>

            {{-- TABLE --}}
            <div class="table-responsive">
                <table class="table table-bordered table-striped align-middle">
                    <thead class="table-dark">
                        <tr class="text-center">
                            <th>No</th>
                            <th>Peminjam</th>
                            <th>Kategori</th> {{-- ⬅️ BARU --}}
                            <th>Alat</th>
                            <th>Tanggal Pinjam</th>
                            <th>Jatuh Tempo</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                    <tbody>
                    @forelse ($peminjamans as $peminjaman)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>

                            <td>{{ $peminjaman->user->name }}</td>

                            {{-- KATEGORI --}}
                            <td>
                                {{ $peminjaman->alat->kategori->nama ?? '-' }}
                            </td>

                            {{-- ALAT --}}
                            <td>{{ $peminjaman->alat->nama_alat }}</td>

                            {{-- TANGGAL --}}
                            <td class="text-center">
                                {{ $peminjaman->tanggal_pinjam_format }}
                            </td>

                            <td class="text-center">
                                {{ $peminjaman->tanggal_jatuh_tempo_format }}
                            </td>

                            {{-- AKSI --}}
                            <td class="text-center">
                                <a href="{{ route('admin.peminjaman.edit', $peminjaman->id) }}"
                                   class="btn btn-warning btn-sm">
                                    Edit
                                </a>

                                <form action="{{ route('admin.peminjaman.destroy', $peminjaman->id) }}"
                                      method="POST"
                                      class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm"
                                            onclick="return confirm('Apakah yakin ingin menghapus data peminjaman ini?')">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted">
                                Data peminjaman belum tersedia
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>

</div>
@endsection
