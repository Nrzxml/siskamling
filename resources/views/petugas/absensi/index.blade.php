@extends('layouts.app')

@section('content')
<div class="container">
    <h3 class="mb-4">📋 Daftar Jadwal Ronda Kamu</h3>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            <table class="table table-bordered align-middle text-center">
                <thead class="table-dark">
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Shift</th>
                        <th>Keterangan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($jadwalSaya as $index => $jadwal)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ \Carbon\Carbon::parse($jadwal->tanggal)->translatedFormat('d F Y') }}</td>
                            <td>{{ $jadwal->shift ?? '-' }}</td>
                            <td>{{ $jadwal->keterangan ?? '-' }}</td>
                            <td>
                                @if ($jadwal->tanggal == $today->toDateString())
                                    @if ($jadwal->sudah_absen)
    <button class="btn btn-secondary btn-sm" disabled>Sudah Absen ✅</button>
@elseif ($jadwal->tanggal == $today->toDateString())
    <a href="{{ route('petugas.absensi.form', $jadwal->id) }}" class="btn btn-success btn-sm">Lakukan Absensi</a>
@else
    <button class="btn btn-outline-secondary btn-sm" disabled>Belum Waktunya</button>
@endif

                                @else
                                    <button class="btn btn-secondary btn-sm" disabled>Belum Waktunya/Sudah Lewat</button>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-muted">Kamu belum memiliki jadwal ronda.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
