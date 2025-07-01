<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Dokter>
 */
class DokterFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Menggunakan faker untuk menghasilkan data acak
        return [
            'nama_dokter' => 'Dr. ' . $this->faker->name(),
            'spesialisasi' => $this->faker->randomElement([
                'Dokter Umum', 
                'Spesialis Anak', 
                'Spesialis Penyakit Dalam', 
                'Dokter Gigi',
                'Spesialis THT',
                'Spesialis Mata'
            ]),
            'kontak' => $this->faker->unique()->numerify('081#########'),
        ];
    }
}