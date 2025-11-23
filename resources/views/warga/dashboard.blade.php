@extends('layouts.app')

@section('content')
<div class="container py-5 text-center">
    <h2 class="fw-bold text-success">Dashboard Warga</h2>
    <p class="mt-3">Selamat datang di Sistem Siskamling Online RT Anda.</p>
    <a href="{{ route('laporan.index') }}" class="btn btn-primary mt-3">Lihat Laporan Saya</a>
</div>
@endsection
