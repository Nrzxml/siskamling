<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AbsensiRonda extends Model
{
    use HasFactory;

    protected $fillable = [
        'jadwal_id',
        'petugas_id',
        'foto_bukti',
        'keterangan',
        'waktu_absen',
    ];

    public function jadwal()
    {
        return $this->belongsTo(JadwalRonda::class, 'jadwal_id');
    }

    public function petugas()
    {
        return $this->belongsTo(User::class, 'petugas_id');
    }
}
