<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('absensi_rondas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('jadwal_id');
            $table->unsignedBigInteger('petugas_id');
            $table->string('foto_bukti')->nullable();
            $table->timestamp('waktu_absen')->nullable();
            $table->timestamps();

            $table->foreign('jadwal_id')->references('id')->on('jadwal_rondas')->onDelete('cascade');
            $table->foreign('petugas_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('absensi_rondas');
    }
};
