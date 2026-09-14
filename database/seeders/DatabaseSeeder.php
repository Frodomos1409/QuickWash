<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Estudiante Demo',
            'email' => 'estudiante@quickwash.test',
            'role' => 'estudiante',
        ]);

        User::factory()->create([
            'name' => 'Personal Demo',
            'email' => 'personal@quickwash.test',
            'role' => 'personal',
        ]);

        $this->call(MachineSeeder::class);
    }
}
