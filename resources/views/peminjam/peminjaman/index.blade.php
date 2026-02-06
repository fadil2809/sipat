@extends('layouts.dashboard')

@section('title', 'Riwayat Peminjaman')

@section('content')
<div class="container-fluid">

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle">
            <thead class="table-dark text-center">
                <tr>
                    <th>No</th>
                    <th>Alat</th>
                    <th>Deskripsi Alat</th>
                    <th>Foto Peminjam</th>
                    <th>Tgl Pinjam</th>
                    <th>Jatuh Tempo</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($peminjamans as $p)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td>{{ $p->alat->nama_alat }}</td>

                        <td>
                            {{ Str::limit($p->alat->deskripsi, 80) }}
                        </td>

                        <td class="text-center">
                            @if ($p->foto_peminjam)
                                <img src="{{ asset('storage/'.$p->foto_peminjam) }}"
                                     width="80"
                                     class="img-thumbnail">
                            @else
                                <span class="text-muted">Belum ada foto</span>
                            @endif
                        </td>

                        <td class="text-center">{{ $p->tanggal_pinjam }}</td>
                        <td class="text-center">{{ $p->tanggal_jatuh_tempo }}</td>

                        <td class="text-center">
                            @php
                                $badge = match ($p->status) {
                                    'pending' => 'bg-secondary',
                                    'dipinjam' => 'bg-warning text-dark',
                                    'dikembalikan' => 'bg-success',
                                    default => 'bg-light text-dark',
                                };
                            @endphp

                            <span class="badge {{ $badge }}">
                                {{ ucfirst($p->status) }}
                            </span>
                        </td>

                        <td class="text-center">
                            @if ($p->status === 'dipinjam')
                                <form method="POST"
                                      action="{{ route('peminjam.peminjaman.kembalikan', $p->id) }}">
                                    @csrf
                                    <button class="btn btn-sm btn-success"
                                            onclick="return confirm('Kembalikan alat?')">
                                        Kembalikan
                                    </button>
                                </form>
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center text-muted">
                            Belum ada riwayat peminjaman
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
