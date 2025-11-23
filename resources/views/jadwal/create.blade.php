@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h3 class="fw-bold text-primary text-center mb-4">Tambah Jadwal Ronda</h3>

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
        <form action="{{ route('jadwal.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="tanggal" class="form-label fw-bold">Tanggal Ronda</label>
                <input type="date" name="tanggal" id="tanggal" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="petugas_id" class="form-label fw-bold">Petugas Ronda</label>
                <select name="petugas_id" id="petugas_id" class="form-select" required>
                    <option value="">-- Pilih Petugas --</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="shift" class="form-label fw-bold">Shift</label>
                <select name="shift" id="shift" class="form-select">
                    <option value="Malam">Malam</option>
                    <option value="Siang">Siang</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="keterangan" class="form-label fw-bold">Keterangan</label>
                <textarea name="keterangan" id="keterangan" rows="3" class="form-control"
                          placeholder="Opsional, misal: ronda tambahan untuk 17-an"></textarea>
            </div>

            <div class="text-center mt-4">
                <button type="submit" class="btn btn-success px-4">Simpan</button>
                <a href="{{ route('jadwal.index') }}" class="btn btn-secondary px-4 ms-2">Kembali</a>
            </div>
        </form>
    </div>
</div>
@endsection
