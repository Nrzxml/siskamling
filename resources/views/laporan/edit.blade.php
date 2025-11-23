@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-3">Edit Laporan</h2>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('laporan.update', $laporan->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="judul" class="form-label">Judul</label>
            <input type="text" name="judul" class="form-control" value="{{ $laporan->judul }}" required>
        </div>
        <div class="mb-3">
            <label for="isi" class="form-label">Isi Laporan</label>
            <textarea name="isi" class="form-control" rows="4" required>{{ $laporan->isi }}</textarea>
        </div>
        <div class="mb-3">
            <label for="lokasi" class="form-label">Lokasi</label>
            <input type="text" name="lokasi" class="form-control" value="{{ $laporan->lokasi }}">
        </div>
        <div class="mb-3">
            <label for="tanggal" class="form-label">Tanggal</label>
            <input type="date" name="tanggal" class="form-control" value="{{ $laporan->tanggal }}" required>
        </div>
        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ route('laporan.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
