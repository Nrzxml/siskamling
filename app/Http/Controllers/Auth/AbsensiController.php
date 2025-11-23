<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Absensi;
use App\Models\JadwalRonda;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class AbsensiController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $today = Carbon::today();

        $jadwal = JadwalRonda::where('petugas_id', $user->id)
            ->whereDate('tanggal', $today)
            ->first();

        if (!$jadwal) {
            return back()->with('error', 'Tidak ada jadwal ronda untuk hari ini.');
        }

        return view('petugas.absensi', compact('jadwal', 'today'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'foto' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $user = Auth::user();
        $today = Carbon::today();

        $jadwal = JadwalRonda::where('petugas_id', $user->id)
            ->whereDate('tanggal', $today)
            ->firstOrFail();

        $path = $request->file('foto')->store('absensi', 'public');

        Absensi::create([
            'user_id' => $user->id,
            'jadwal_id' => $jadwal->id,
            'tanggal' => $today->toDateString(),
            'foto' => $path,
        ]);

        return redirect()->route('petugas.dashboard')->with('success', 'Absensi berhasil disimpan!');
    }
}
