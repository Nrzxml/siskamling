<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\JadwalRonda;
use Carbon\Carbon;

class PetugasController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $today = Carbon::today(); // <--- ini penting

        // Cek apakah petugas ini punya jadwal ronda hari ini
        $jadwalHariIni = JadwalRonda::where('petugas_id', $user->id)
            ->whereDate('tanggal', $today)
            ->first();

        // kirim ke view
        return view('petugas.dashboard', compact('user', 'jadwalHariIni', 'today'));
    }
}
