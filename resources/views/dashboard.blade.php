@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2 class="mb-5 text-center fw-bold text-primary">Dashboard Keamanan RT</h2>

    <div class="row justify-content-center g-4">
        <!-- Buat Laporan -->
        <div class="col-md-4">
            <div class="card shadow-lg border-0 h-100 dashboard-card">
                <div class="card-body text-center">
                    <div class="icon-circle bg-danger text-white mb-3">
                        <i class="bi bi-exclamation-triangle-fill fs-2"></i>
                    </div>
                    <h5 class="card-title fw-bold">Buat Laporan</h5>
                    <p class="card-text text-muted">
                        Laporkan kejadian mencurigakan, kehilangan, atau keadaan darurat di sekitar Anda.
                    </p>
                    <a href="{{ route('laporan.create') }}" class="btn btn-danger w-100">Laporkan Kejadian</a>
                </div>
            </div>
        </div>

        <!-- Berita Darurat -->
        <div class="col-md-4">
            <div class="card shadow-lg border-0 h-100 dashboard-card">
                <div class="card-body text-center">
                    <div class="icon-circle bg-primary text-white mb-3">
                        <i class="bi bi-newspaper fs-2"></i>
                    </div>
                    <h5 class="card-title fw-bold">Berita & Peringatan</h5>
                    <p class="card-text text-muted">
                        Lihat berita terbaru tentang keamanan, bencana, atau pengumuman penting dari pengurus RT.
                    </p>
                    <a href="{{ route('berita.index') }}" class="btn btn-primary w-100">Lihat Berita</a>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .dashboard-card {
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    .dashboard-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 1rem 2rem rgba(0,0,0,0.2);
    }
    .icon-circle {
        width: 70px;
        height: 70px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto;
    }
</style>
@endsection
