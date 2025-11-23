@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h3 class="mb-4 fw-bold text-primary text-center">Daftar Laporan Anda</h3>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="text-end mb-3">
        <a href="{{ route('laporan.create') }}" class="btn btn-success">+ Buat Laporan Baru</a>
    </div>

    <div class="card shadow border-0">
        <div class="card-body">
            @if($laporans->isEmpty())
                <p class="text-center text-muted">Belum ada laporan yang dibuat.</p>
            @else
                <table class="table table-bordered align-middle">
                    <thead class="table-primary">
                        <tr class="text-center">
                            <th>No</th>
                            <th>Judul</th>
                            <th>Lokasi</th>
                            <th>Tanggal</th>
                            <th>Foto</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($laporans as $laporan)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td>{{ $laporan->judul }}</td>
                        <td>{{ $laporan->lokasi }}</td>
                        <td class="text-center">{{ $laporan->tanggal }}</td>
                        <td class="text-center">
                            @if ($laporan->foto)
                                <img src="{{ asset('storage/' . $laporan->foto) }}" alt="Foto laporan"
                                    width="80" class="rounded shadow-sm">
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('laporan.show', $laporan->id) }}" class="btn btn-sm btn-primary">
                                <i class="bi bi-eye"></i> Lihat
                            </a>
                        </td>

                    </tr>
                    @endforeach
                    </tbody>

                                    </table>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endsection
