<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JadwalRonda;
use App\Models\AbsensiRonda;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class AbsensiController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Ambil semua jadwal ronda petugas
        $jadwalSaya = JadwalRonda::where('petugas_id', $user->id)
            ->orderBy('tanggal', 'asc')
            ->get();

        $today = \Carbon\Carbon::today();

        // Tambahkan flag absensi
        foreach ($jadwalSaya as $jadwal) {
            $jadwal->sudah_absen = \App\Models\AbsensiRonda::where('jadwal_id', $jadwal->id)
                ->where('petugas_id', $user->id)
                ->exists();
        }

        return view('petugas.absensi.index', compact('jadwalSaya', 'today'));
    }



    public function form($id)
    {
        $jadwal = JadwalRonda::findOrFail($id);
        $today = Carbon::today();

        // Hanya bisa absen di tanggal yang sesuai
        if ($jadwal->tanggal != $today->toDateString()) {
            return redirect()->route('petugas.absensi.index')
                ->with('error', 'Kamu hanya bisa absen pada hari jadwalmu!');
        }

        return view('petugas.absensi.form', compact('jadwal'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'jadwal_id' => 'required|exists:jadwal_rondas,id',
            'foto_bukti' => 'required|image|max:2048',
        ]);

        $user = Auth::user();
        $jadwal = JadwalRonda::findOrFail($request->jadwal_id);

        // Upload foto ke storage/app/public/absensi
        $path = $request->file('foto_bukti')->store('absensi', 'public');

        AbsensiRonda::create([
            'jadwal_id'   => $jadwal->id,
            'petugas_id'  => $user->id,
            'foto_bukti'  => $path,
            'keterangan'  => $request->keterangan, // 🟢 tambahkan ini
            'waktu_absen' => now(),
        ]);

        return redirect()->route('petugas.absensi.index')->with('success', 'Absensi berhasil dikirim!');
    }

}
