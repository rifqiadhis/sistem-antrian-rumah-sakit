<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Dokter; // Pastikan model Dokter di-import

class DokterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Baris ini akan membuat 10 data dokter menggunakan DokterFactory
        Dokter::factory()->count(10)->create();
    }
}