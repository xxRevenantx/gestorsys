<?php

namespace Database\Seeders;

use App\Models\Tutor;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Carlos Nuñez',
            'email' => 'carlos@admin.com',
            'password' => bcrypt('12345678'),

        ]);

        $this->call([
            DirectorSeeder::class,
            SupervisorSeeder::class,
            // GroupSeeder::class,
            NivelSeeder::class,
            TutorSeeder::class,
            // GenerationSeeder::class,
            // GradeSeeder::class,
            // StudentSeeder::class,
            ActionSeeder::class,
            MonthSeeder::class,
        ]);


    }
}
