<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Pasien;
use App\Models\Dokter;

class AntrianFactory extends Factory
{
    public function definition(): array
    {
        $pasien = Pasien::inRandomOrder()->first();
        $dokter = Dokter::inRandomOrder()->first();

        return [
            'pasien_id' => $pasien->id,
            'dokter_id' => $dokter->dokter_id,
            'nomor_antrian' => $this->faker->numberBetween(1, 50),
            'status' => $this->faker->randomElement(['Menunggu', 'Diproses', 'Selesai', 'Batal']),
        ];
    }
}