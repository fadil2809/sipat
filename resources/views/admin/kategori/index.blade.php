@extends('layouts.dashboard')

@section('title', 'Kategori')

@section('content')
<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="mb-0">Data Kategori</h5>
        <a href="{{ route('admin.kategori.create') }}" class="btn btn-primary">
            + Tambah Kategori
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle">
            <thead class="table-dark">
                <tr class="text-center">
                    <th width="5%">No</th>
                    <th width="20%">Nama</th>
                    <th>Deskripsi</th>
                    <th width="20%">Aksi</th>
                </tr>
            </thead>

            <tbody>
            @forelse ($kategoris as $kategori)
                <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td
                        style="
                            max-width: 200px;
                            white-space: normal;
                            word-break: break-word;
                            overflow-wrap: break-word;
                        ">
                        {{ $kategori->nama }}
                    </td>

                    {{-- FINAL FIX: kata panjang TANPA spasi tetap turun --}}
                    <td
                        style="
                            max-width: 400px;
                            white-space: normal;
                            word-break: break-word;
                            overflow-wrap: break-word;
                        ">
                        {{ $kategori->deskripsi }}
                    </td>

                    <td class="text-center">
                        <a href="{{ route('admin.kategori.edit', $kategori->id) }}"
                           class="btn btn-warning btn-sm">
                            Edit
                        </a>

                        <form action="{{ route('admin.kategori.destroy', $kategori->id) }}"
                              method="POST"
                              class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="btn btn-danger btn-sm"
                                    onclick="return confirm('Hapus kategori ini?')">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center text-muted">
                        Data kategori belum tersedia
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

</div>
@endsection
