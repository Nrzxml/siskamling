@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h3 class="mb-4 fw-bold text-primary text-center">Form Laporan Kejadian</h3>

    {{-- Pesan sukses --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Pesan error --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Terjadi kesalahan!</strong>
            <ul class="mb-0 mt-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card shadow-lg border-0 p-4">
        <form action="{{ route('laporan.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="judul" class="form-label fw-bold">Judul Kejadian</label>
                <input type="text" name="judul" id="judul" class="form-control"
                       placeholder="Contoh: Pencurian di depan rumah" value="{{ old('judul') }}" required>
            </div>

            <div class="mb-3">
                <label for="isi" class="form-label fw-bold">Deskripsi Kejadian</label>
                <textarea name="isi" id="isi" class="form-control" rows="5"
                          placeholder="Ceritakan kronologi kejadian..." required>{{ old('isi') }}</textarea>
            </div>

            <div class="mb-3">
                <label for="lokasi" class="form-label fw-bold">Lokasi Kejadian</label>
                <input type="text" name="lokasi" id="lokasi" class="form-control"
                       placeholder="Contoh: Jalan Mawar No. 12" value="{{ old('lokasi') }}">
            </div>

            <div class="mb-3">
                <label for="tanggal" class="form-label fw-bold">Tanggal Kejadian</label>
                <input type="date" name="tanggal" id="tanggal" class="form-control"
                       value="{{ old('tanggal') }}" required>
            </div>

            <div class="mb-3">
                <label for="foto" class="form-label fw-bold">Unggah Foto (opsional)</label>
                <input type="file" name="foto" id="foto" class="form-control" accept="image/*">
                <small class="text-muted">Format: JPG, PNG — Maksimal 2MB</small>
            </div>

            <div class="text-center mt-4">
                <button type="submit" class="btn btn-primary px-5">Simpan Laporan</button>
                <a href="{{ route('laporan.index') }}" class="btn btn-secondary px-5 ms-2">Kembali</a>
            </div>
        </form>
    </div>
</div>
@endsection
