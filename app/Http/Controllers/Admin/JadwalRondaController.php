<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\JadwalRonda;
use Carbon\Carbon;

class JadwalRondaController extends Controller
{
    public function index(Request $request)
    {
        $bulan = (int) $request->input('bulan', date('m'));
        $tahun = (int) $request->input('tahun', date('Y'));

        $tanggal_awal = \Carbon\Carbon::create($tahun, $bulan, 1);
        $tanggal_akhir = $tanggal_awal->copy()->endOfMonth();

        $petugas = \App\Models\User::where('role', 'petugas')->get();
        $jadwals = \App\Models\JadwalRonda::whereBetween('tanggal', [$tanggal_awal, $tanggal_akhir])
            ->get()
            ->keyBy('tanggal');

        return view('admin.jadwal.index', compact('bulan', 'tahun', 'tanggal_awal', 'tanggal_akhir', 'petugas', 'jadwals'));
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'tanggal' => 'required|date',
            'petugas_id' => 'required|exists:users,id',
            'shift' => 'nullable|string|max:50',
            'keterangan' => 'nullable|string|max:255',
        ]);

        // Cek apakah jadwal untuk tanggal ini sudah ada
        $jadwal = JadwalRonda::whereDate('tanggal', $validated['tanggal'])->first();

        if ($jadwal) {
            // update data lama
            $jadwal->update([
                'petugas_id' => $validated['petugas_id'],
                'shift' => $validated['shift'],
                'keterangan' => $validated['keterangan'],
            ]);
        } else {
            // buat data baru
            JadwalRonda::create($validated);
        }

        return back()->with('success', 'Jadwal ronda berhasil disimpan!');
    }


}
