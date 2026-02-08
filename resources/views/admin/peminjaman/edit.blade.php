@extends('layouts.dashboard')

@section('title', 'Edit Peminjaman')

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

            <form action="{{ route('admin.peminjaman.update', $peminjaman->id) }}" method="POST">
                @csrf
                @method('PUT')

                {{-- PEMINJAM --}}
                <div class="mb-3">
                    <label class="form-label">Peminjam</label>
                    <select name="user_id" class="form-select" required>
                        <option value="">-- Pilih Peminjam --</option>
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}"
                                {{ $peminjaman->user_id == $user->id ? 'selected' : '' }}>
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
                            <option value="{{ $kategori->id }}"
                                {{ $peminjaman->alat->kategori_id == $kategori->id ? 'selected' : '' }}>
                                {{ $kategori->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- ALAT --}}
                <div class="mb-3">
                    <label class="form-label">Alat</label>
                    <select name="alat_id" id="alat" class="form-select" required>
                        <option value="">Loading...</option>
                    </select>
                    <small id="infoAlat" class="text-muted"></small>
                </div>

                {{-- TANGGAL --}}
                <div class="mb-3">
                    <label class="form-label">Tanggal Pinjam</label>
                    <input type="date" name="tanggal_pinjam" class="form-control"
                        value="{{ old('tanggal_pinjam', \Carbon\Carbon::parse($peminjaman->tanggal_pinjam)->format('Y-m-d')) }}"
                        required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Tanggal Jatuh Tempo</label>
                    <input type="date" name="tanggal_jatuh_tempo" class="form-control"
                        value="{{ old('tanggal_jatuh_tempo', \Carbon\Carbon::parse($peminjaman->tanggal_jatuh_tempo)->format('Y-m-d')) }}"
                        required>
                </div>

                {{-- BUTTON --}}
                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">Update</button>
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

    const alatTerpilih = "{{ $peminjaman->alat_id }}";

    function loadAlat(kategoriId, selectedAlat = null){
        alatSelect.innerHTML = '<option value="">Loading...</option>';
        alatSelect.disabled = true;

        fetch(`/admin/get-alat/${kategoriId}`)
            .then(res => res.json())
            .then(data => {
                alatSelect.innerHTML = '<option value="">-- Pilih Alat --</option>';

                if(data.length === 0){
                    alatSelect.innerHTML += '<option value="">Tidak ada alat</option>';
                }

                data.forEach(alat => {
                    let selected = (alat.id == selectedAlat) ? 'selected' : '';
                    alatSelect.innerHTML += 
                        `<option value="${alat.id}" ${selected}>
                            ${alat.nama_alat} (Stok: ${alat.stok})
                        </option>`;
                });

                alatSelect.disabled = false;
                infoAlat.innerText = "";
            });
    }

    // auto-load saat halaman dibuka
    window.addEventListener('load', function(){
        const kategoriId = kategoriSelect.value;
        if(kategoriId){
            loadAlat(kategoriId, alatTerpilih);
        }
    });

    // saat kategori diganti
    kategoriSelect.addEventListener('change', function(){
        let kategoriId = this.value;
        if(kategoriId){
            loadAlat(kategoriId);
        }else{
            alatSelect.innerHTML = '<option value="">-- Pilih Alat --</option>';
            alatSelect.disabled = true;
            infoAlat.innerText = "Pilih kategori terlebih dahulu";
        }
    });

    // alert kalau klik alat sebelum pilih kategori
    alatSelect.addEventListener('click', function(){
        if(kategoriSelect.value === ""){
            alert("⚠️ Pilih kategori alat terlebih dahulu!");
        }
    });
</script>
@endsection
