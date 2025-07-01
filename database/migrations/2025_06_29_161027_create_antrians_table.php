<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('antrians', function (Blueprint $table) {
            $table->id('antrian_id');
            $table->foreignId('pasien_id')->constrained('pasiens', 'id')->onDelete('cascade');
            $table->foreignId('dokter_id')->constrained('dokters', 'dokter_id')->onDelete('cascade');
            $table->integer('nomor_antrian');
            $table->string('status', 50)->default('Menunggu'); // Contoh: Menunggu, Diproses, Selesai, Batal
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('antrians');
    }
};