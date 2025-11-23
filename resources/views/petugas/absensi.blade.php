@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h3>Absensi Ronda - {{ $today->translatedFormat('d F Y') }}</h3>
    <p>Petugas: <strong>{{ Auth::user()->name }}</strong></p>
    <p>Shift: {{ $jadwal->shift ?? '-' }}</p>

    <form action="{{ route('petugas.absensi.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="jadwal_id" value="{{ $jadwal->id }}">
        <div class="mb-3">
            <label for="foto" class="form-label">Upload Foto Bukti Absensi</label>
            <input type="file" name="foto" id="foto" class="form-control" accept="image/*" required>
        </div>
        <button class="btn btn-primary">Kirim Absensi</button>
    </form>
</div>
@endsection
