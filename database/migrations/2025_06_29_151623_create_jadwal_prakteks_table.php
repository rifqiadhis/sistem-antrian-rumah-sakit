<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('jadwal_prakteks', function (Blueprint $table) {
            $table->id('jadwal_id');
            $table->foreignId('dokter_id')->constrained('dokters', 'dokter_id')->onDelete('cascade');
            $table->string('hari');
            $table->string('jam_mulai', 8);
            $table->string('jam_selesai');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jadwal_prakteks');
    }
};