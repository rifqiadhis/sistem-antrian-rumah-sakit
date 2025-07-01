<?php

namespace Database\Seeders;

use App\Models\JadwalPraktek;
use Illuminate\Database\Seeder;

class JadwalPraktekSeeder extends Seeder
{
    public function run(): void
    {
        JadwalPraktek::factory()->count(15)->create();
    }
}