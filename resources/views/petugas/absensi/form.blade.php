@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">Form Absensi Ronda</h2>

    <div class="card">
        <div class="card-body">
            <p><strong>Tanggal Ronda:</strong> {{ $jadwal->tanggal }}</p>
            <p><strong>Petugas:</strong> {{ Auth::user()->name }}</p>

            <form action="{{ route('petugas.absensi.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- kirim id jadwal secara tersembunyi --}}
                <input type="hidden" name="jadwal_id" value="{{ $jadwal->id }}">

                <div class="mb-3">
                    <label for="foto_bukti" class="form-label">Foto Bukti Kehadiran</label>
                    <input type="file" name="foto_bukti" id="foto_bukti" class="form-control" accept="image/*" required>
                </div>

                <div class="mb-3">
                    <label for="keterangan" class="form-label">Keterangan (Opsional)</label>
                    <textarea name="keterangan" id="keterangan" class="form-control" rows="3"></textarea>
                </div>

                <button type="submit" class="btn btn-primary">Kirim Absensi</button>
                <a href="{{ route('petugas.absensi.index') }}" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
</div>
@endsection
