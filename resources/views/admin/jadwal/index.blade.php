@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="fw-bold text-primary mb-4">Jadwal Ronda Bulan {{ \Carbon\Carbon::create()->month($bulan)->translatedFormat('F') }} {{ $tahun }}</h2>

    {{-- Filter Bulan & Tahun --}}
    <form method="GET" action="{{ route('jadwal.index') }}" class="mb-3">
        <div class="row g-2 align-items-end">
            <div class="col-md-4">
                <label>Bulan</label>
                <select name="bulan" class="form-select">
                    @for ($i = 1; $i <= 12; $i++)
                        <option value="{{ $i }}" {{ $bulan == $i ? 'selected' : '' }}>
                            {{ \Carbon\Carbon::create()->month($i)->translatedFormat('F') }}
                        </option>
                    @endfor
                </select>
            </div>
            <div class="col-md-4">
                <label>Tahun</label>
                <input type="number" name="tahun" value="{{ $tahun }}" class="form-control">
            </div>
            <div class="col-md-4">
                <button class="btn btn-primary w-100">Tampilkan</button>
            </div>
        </div>
    </form>

    {{-- Tabel Jadwal --}}
    <div class="table-responsive">
        <table class="table table-bordered text-center align-middle">
            <thead class="table-primary">
                <tr>
                    <th>Tanggal</th>
                    <th>Petugas</th>
                    <th>Shift</th>
                    <th>Keterangan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @for ($tanggal = $tanggal_awal->copy(); $tanggal->lte($tanggal_akhir); $tanggal->addDay())
                    @php
                        $jadwal = $jadwals->get($tanggal->toDateString());
                    @endphp
                    <tr>
                        <td>{{ $tanggal->translatedFormat('d F Y') }}</td>
                        <td>{{ $jadwal ? $jadwal->petugas->name : '-' }}</td>
                        <td>{{ $jadwal->shift ?? '-' }}</td>
                        <td>{{ $jadwal->keterangan ?? '-' }}</td>
                        <td>
                            <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#editModal{{ $tanggal->format('Ymd') }}">Atur</button>
                        </td>
                    </tr>

                    {{-- Modal --}}
                    <div class="modal fade" id="editModal{{ $tanggal->format('Ymd') }}" tabindex="-1" aria-labelledby="editModalLabel{{ $tanggal->format('Ymd') }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <form method="POST" action="{{ route('jadwal.store') }}">
                                @csrf
                                <div class="modal-content">
                                    <div class="modal-header bg-primary text-white">
                                        <h5 class="modal-title" id="editModalLabel{{ $tanggal->format('Ymd') }}">Atur Jadwal Ronda ({{ $tanggal->translatedFormat('d F Y') }})</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <input type="hidden" name="tanggal" value="{{ $tanggal->toDateString() }}">

                                        <div class="mb-3">
                                            <label for="petugas_id" class="form-label">Petugas</label>
                                            <select name="petugas_id" class="form-select" required>
                                                <option value="">-- Pilih Petugas --</option>
                                                @foreach ($petugas as $p)
                                                    <option value="{{ $p->id }}" {{ $jadwal && $jadwal->petugas_id == $p->id ? 'selected' : '' }}>
                                                        {{ $p->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="mb-3">
                                            <label for="shift" class="form-label">Shift</label>
                                            <input type="text" name="shift" value="{{ $jadwal->shift ?? '' }}" class="form-control" placeholder="Contoh: Malam">
                                        </div>

                                        <div class="mb-3">
                                            <label for="keterangan" class="form-label">Keterangan</label>
                                            <textarea name="keterangan" class="form-control" placeholder="Opsional">{{ $jadwal->keterangan ?? '' }}</textarea>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                @endfor
            </tbody>
        </table>
    </div>
</div>
@endsection
