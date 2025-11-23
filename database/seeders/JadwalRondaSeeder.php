<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\JadwalRonda;
use App\Models\User;
use Carbon\Carbon;

class JadwalRondaSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::take(3)->get();

        foreach ($users as $user) {
            JadwalRonda::create([
                'tanggal' => Carbon::now()->addDays(rand(1, 7)),
                'petugas_id' => $user->id,
                'shift' => ['Malam', 'Siang'][rand(0,1)],
                'keterangan' => 'Ronda rutin mingguan',
            ]);
        }
    }
}
