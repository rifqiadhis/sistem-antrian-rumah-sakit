<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Antrian;

class AntrianSeeder extends Seeder
{
    public function run(): void
    {
        Antrian::factory()->count(30)->create();
    }
}