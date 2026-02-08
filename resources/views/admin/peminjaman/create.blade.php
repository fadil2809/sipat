@extends('layouts.dashboard')

@section('title', 'Tambah Peminjaman')

@section('content')
<div class="container-fluid">

    {{-- ALERT --}}
    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

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

            <form action="{{ route('admin.peminjaman.store') }}" method="POST">
                @csrf

                {{-- PEMINJAM --}}
                <div class="mb-3">
                    <label class="form-label">Peminjam</label>
                    <select name="user_id" class="form-select" required>
                        <option value="">-- Pilih Peminjam --</option>
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}">
                                {{ $user->name }} ({{ $user->email }})
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- KATEGORI --}}
                <div class="mb-3">
                    <label class="form-label">Kategori Alat</label>
                    <select id="kategori" class="form-select" required>
                        <option value="">-- Pilih Kategori --</option>
                        @foreach ($kategoris as $kategori)
                            <option value="{{ $kategori->id }}">
                                {{ $kategori->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- ALAT --}}
                <div class="mb-3">
                    <label class="form-label">Alat</label>
                    <select name="alat_id" id="alat" class="form-select" disabled required>
                        <option value="">-- Pilih Alat --</option>
                    </select>
                    <small id="infoAlat" class="text-muted">
                        Pilih kategori terlebih dahulu
                    </small>
                </div>

                {{-- TANGGAL --}}
                <div class="mb-3">
                    <label class="form-label">Tanggal Pinjam</label>
                    <input type="date" name="tanggal_pinjam" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Tanggal Jatuh Tempo</label>
                    <input type="date" name="tanggal_jatuh_tempo" class="form-control" required>
                </div>

                {{-- BUTTON --}}
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{ route('admin.peminjaman.index') }}" class="btn btn-secondary">Batal</a>
                </div>

            </form>

        </div>
    </div>

</div>

{{-- SCRIPT --}}
<script>
    const kategoriSelect = document.getElementById('kategori');
    const alatSelect = document.getElementById('alat');
    const infoAlat = document.getElementById('infoAlat');

    // Alert kalau klik alat sebelum pilih kategori
    alatSelect.addEventListener('click', function(){
        if(kategoriSelect.value === ""){
            alert("⚠️ Pilih kategori alat terlebih dahulu!");
        }
    });

    // Load alat berdasarkan kategori
    kategoriSelect.addEventListener('change', function(){
        let kategoriId = this.value;

        alatSelect.innerHTML = '<option value="">Loading...</option>';
        alatSelect.disabled = true;

        if(kategoriId){
            fetch(`/admin/get-alat/${kategoriId}`)
                .then(res => res.json())
                .then(data => {
                    alatSelect.innerHTML = '<option value="">-- Pilih Alat --</option>';

                    if(data.length === 0){
                        alatSelect.innerHTML += '<option value="">Tidak ada alat</option>';
                    }

                    data.forEach(alat => {
                        alatSelect.innerHTML += 
                            `<option value="${alat.id}">
                                ${alat.nama_alat} (Stok: ${alat.stok})
                            </option>`;
                    });

                    alatSelect.disabled = false;
                    infoAlat.innerText = "";
                });
        }else{
            alatSelect.innerHTML = '<option value="">-- Pilih Alat --</option>';
            alatSelect.disabled = true;
            infoAlat.innerText = "Pilih kategori terlebih dahulu";
        }
    });
</script>
@endsection
