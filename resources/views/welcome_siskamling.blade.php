@extends('layouts.app')

@section('content')
<div class="container text-center py-5">
    <h1 class="fw-bold text-primary mb-3">Siskamling Online</h1>
    <p class="lead mb-4">Sistem Informasi Keamanan Lingkungan — RT Digital & Aman.</p>

    @guest
        <a href="{{ route('login') }}" class="btn btn-primary btn-lg px-5">Masuk</a>
        <a href="{{ route('register') }}" class="btn btn-outline-primary btn-lg px-5 ms-3">Daftar</a>
    @else
        <a href="{{ route('dashboard') }}" class="btn btn-success btn-lg px-5">Masuk ke Dashboard</a>
    @endguest

    <div class="mt-5">
        <img src="https://cdn-icons-png.flaticon.com/512/9121/9121413.png" alt="Siskamling" width="200">
    </div>

    <footer class="mt-5 text-muted small">
         Siskamling Online — Sistem Keamanan Terpadu RT
    </footer>
</div>
@endsection
