@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h4>Detail Laporan</h4>
        </div>
        <div class="card-body">
            <p><strong>Judul:</strong> {{ $laporan->judul }}</p>
            
            <p><strong>Isi Laporan:</strong></p>
            <div class="border rounded p-3 bg-light mb-3">
                {!! nl2br(e($laporan->isi)) !!}
            </div>

            <p><strong>Lokasi:</strong> {{ $laporan->lokasi ?? '-' }}</p>
            <p><strong>Tanggal Kejadian:</strong> {{ \Carbon\Carbon::parse($laporan->tanggal)->format('d M Y') }}</p>
            <p><strong>Dibuat oleh:</strong> {{ $laporan->user->name ?? 'Tidak diketahui' }}</p>
            <p><strong>Dikirim pada:</strong> {{ $laporan->created_at->format('d M Y H:i') }}</p>

            <a href="{{ route('laporan.index') }}" class="btn btn-secondary mt-3">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
        </div>
    </div>
</div>
@endsection
