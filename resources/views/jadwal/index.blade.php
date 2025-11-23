@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2 class="fw-bold text-primary text-center mb-4">📅 Jadwal Ronda</h2>

    {{-- Pesan sukses --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Tombol tambah --}}
    <div class="d-flex justify-content-end mb-3">
        <a href="{{ route('jadwal.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Tambah Jadwal
        </a>
    </div>

    {{-- Tabel jadwal --}}
    <div class="card shadow border-0">
        <div class="card-body">
            @if($jadwals->isEmpty())
                <p class="text-center text-muted">Belum ada jadwal ronda.</p>
            @else
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-primary">
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Petugas</th>
                                <th>Shift</th>
                                <th>Keterangan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($jadwals as $i => $jadwal)
                            <tr>
                                <td>{{ $i + 1 }}</td>
                                <td>{{ \Carbon\Carbon::parse($jadwal->tanggal)->format('d M Y') }}</td>
                                <td>{{ $jadwal->petugas->name ?? 'Tidak diketahui' }}</td>
                                <td>{{ $jadwal->shift ?? '-' }}</td>
                                <td>{{ $jadwal->keterangan ?? '-' }}</td>
                                <td>
                                    <a href="{{ route('jadwal.edit', $jadwal->id) }}" class="btn btn-warning btn-sm">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <form action="{{ route('jadwal.destroy', $jadwal->id) }}" method="POST" class="d-inline"
                                          onsubmit="return confirm('Yakin ingin menghapus jadwal ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
