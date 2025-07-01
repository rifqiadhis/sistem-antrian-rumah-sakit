<?php

namespace Database\Factories;

use App\Models\Dokter;
use Illuminate\Database\Eloquent\Factories\Factory;

class JadwalPraktekFactory extends Factory
{
    public function definition(): array
    {
        $dokter = Dokter::inRandomOrder()->first();
        
        $jamMulai = $this->faker->time('H:i:s');
        $jamSelesai = date('H:i:s', strtotime($jamMulai . ' +3 hours'));

        return [
            'dokter_id'   => $dokter->dokter_id,
            'hari'        => $this->faker->randomElement(['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat']),
            'jam_mulai'   => $jamMulai,
            'jam_selesai' => $jamSelesai,
        ];
    }
}