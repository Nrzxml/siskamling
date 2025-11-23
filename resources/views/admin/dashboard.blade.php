@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4 fw-bold text-primary">Dashboard Admin</h1>

    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card shadow-sm border-0 bg-light">
                <div class="card-body text-center">
                    <h4 class="fw-bold">{{ $totalWarga }}</h4>
                    <p class="text-muted mb-0">Total Warga</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm border-0 bg-light">
                <div class="card-body text-center">
                    <h4 class="fw-bold">{{ $totalPetugas }}</h4>
                    <p class="text-muted mb-0">Total Petugas Ronda</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm border-0 bg-light">
                <div class="card-body text-center">
                    <h4 class="fw-bold">{{ $totalLaporan }}</h4>
                    <p class="text-muted mb-0">Total Laporan Warga</p>
                </div>
            </div>
        </div>
    </div>

    <div class="container py-4">

    <div class="d-flex gap-3">
        <a href="{{ route('admin.users.index') }}" class="btn btn-outline-primary">
            Kelola Pengguna
        </a>

        <a href="{{ route('laporan.index') }}" class="btn btn-outline-success">
            Lihat Laporan Warga
        </a>

        <a href="{{ route('jadwal.index') }}" class="btn btn-outline-warning">
            Atur Jadwal Ronda
        </a>
    </div>
</div>


    <h4 class="fw-bold mb-3">Laporan Terbaru</h4>
    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            <table class="table mb-0">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Pelapor</th>
                        <th>Judul</th>
                        <th>Status</th>
                        <th>Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($laporanTerbaru as $laporan)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $laporan->user->name ?? '-' }}</td>
                            <td>{{ $laporan->judul ?? '(Tanpa Judul)' }}</td>
                            <td>{{ $laporan->status ?? '-' }}</td>
                            <td>{{ $laporan->created_at->format('d M Y') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-3">Belum ada laporan</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
