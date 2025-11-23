@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="fw-bold text-primary mb-3">Selamat Datang, {{ $user->name }}</h2>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card mb-4 shadow-sm">
        <div class="card-body">
            <h5 class="card-title">Jadwal Ronda Hari Ini ({{ $today->translatedFormat('d F Y') }})</h5>

            @if ($jadwalHariIni)
                <p><strong>Shift:</strong> {{ $jadwalHariIni->shift ?? '-' }}</p>
                <p><strong>Keterangan:</strong> {{ $jadwalHariIni->keterangan ?? '-' }}</p>

                <a href="{{ route('petugas.absensi.index') }}" class="btn btn-success">
                    Lakukan Absensi
                </a>
            @else
                <p class="text-muted">Tidak ada jadwal ronda untuk hari ini.</p>
            @endif
        </div>
    </div>

    <div class="row g-3">
        <div class="col-md-4">
            <a href="{{ route('petugas.jadwal') }}" class="btn btn-outline-primary w-100">
                📅 Lihat Jadwal Ronda
            </a>
        </div>
        <div class="col-md-4">
            <a href="{{ route('petugas.laporan') }}" class="btn btn-outline-secondary w-100">
                📝 Lihat Laporan Warga
            </a>
        </div>
        <div class="col-md-4">
            <a href="{{ route('petugas.absensi.index') }}" class="btn btn-outline-success w-100">
                ✅ Absensi Hari Ini
            </a>
        </div>
    </div>
</div>
@endsection
