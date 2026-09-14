<?php

namespace Database\Seeders;

use App\Models\Machine;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MachineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (range(1, 6) as $numero) {
            Machine::firstOrCreate(
                ['numero' => 'M-'.str_pad((string) $numero, 2, '0', STR_PAD_LEFT)],
                ['nombre' => 'Lavadora '.$numero, 'disponible' => true]
            );
        }
    }
}
