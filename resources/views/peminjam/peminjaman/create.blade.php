@extends('layouts.dashboard')

@section('title', 'Ajukan Peminjaman')

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

        <form action="{{ route('peminjam.peminjaman.store') }}"
              method="POST"
              enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label class="form-label">Pilih Alat</label>
                <select name="alat_id" id="alatSelect" class="form-select" required>
                    <option value="">-- Pilih Alat --</option>
                    @foreach($alats as $alat)
                        <option value="{{ $alat->id }}"
                            data-gambar="{{ $alat->gambar_alat ? asset('storage/'.$alat->gambar_alat) : '' }}"
                            data-deskripsi="{{ $alat->deskripsi }}">
                            {{ $alat->nama_alat }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Gambar Alat</label>
                <div class="border p-2 rounded text-center">
                    <img id="previewGambar" src="" width="150" class="img-thumbnail d-none">
                    <p id="noGambar" class="text-muted">Pilih alat untuk melihat gambar</p>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Deskripsi Alat</label>
                <textarea id="deskripsiAlat" class="form-control" rows="3" readonly></textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Tanggal Pinjam</label>
                <input type="date"
                       name="tanggal_pinjam"
                       class="form-control"
                       required>
            </div>

            <div class="mb-3">
                <label class="form-label">Tanggal Jatuh Tempo</label>
                <input type="date"
                       name="tanggal_jatuh_tempo"
                       class="form-control"
                       required>
            </div>

            <div class="mb-3">
                <label class="form-label">Upload Foto Anda (Identitas)</label>
                <input type="file" name="foto_peminjam" class="form-control" required>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">
                    Ajukan Peminjaman
                </button>
                <a href="{{ route('peminjam.peminjaman.index') }}"
                   class="btn btn-secondary">
                    Kembali
                </a>
            </div>

        </form>
    </div>
</div>

</div>

<script>
document.getElementById('alatSelect').addEventListener('change', function() {
    const selected = this.options[this.selectedIndex];
    const gambar = selected.getAttribute('data-gambar');
    const deskripsi = selected.getAttribute('data-deskripsi');

    const img = document.getElementById('previewGambar');
    const noGambar = document.getElementById('noGambar');
    const descBox = document.getElementById('deskripsiAlat');

    descBox.value = deskripsi || '';

    if (gambar) {
        img.src = gambar;
        img.classList.remove('d-none');
        noGambar.classList.add('d-none');
    } else {
        img.classList.add('d-none');
        noGambar.classList.remove('d-none');
    }
});
</script>

@endsection
