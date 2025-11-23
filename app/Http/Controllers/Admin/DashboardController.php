<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Laporan;

class DashboardController extends Controller
{
    public function index()
    {
        // Ambil data untuk dashboard
        $totalWarga = User::where('role', 'warga')->count();
        $totalPetugas = User::where('role', 'petugas')->count();
        $totalLaporan = Laporan::count();
        $laporanTerbaru = Laporan::latest()->take(5)->get();

        return view('admin.dashboard', compact('totalWarga', 'totalPetugas', 'totalLaporan', 'laporanTerbaru'));
    }
}
