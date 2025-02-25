<?php

namespace Database\Seeders;

use App\Models\Generation;
use App\Models\Group;
use App\Models\Level;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GradeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $grados = [
            [
                "grado" => "primero",
                "grado_numero" => "1",
                "level_id" => 1,
                "generation_id" => 1,
                "group_id" => 1,
            ],
            [
                "grado" => "segundo",
                "grado_numero" => "2",
                "level_id" => 2,
                "generation_id" => 2,
                "group_id" => 1,
            ],
            [
                "grado" => "tercero",
                "grado_numero" => "3",
                "level_id" => 3,
                "generation_id" => 3,
                "group_id" => 1,
            ],
            [
                "grado" => "primero",
                "grado_numero" => "1",
                "level_id" => 2,
                "generation_id" => 4,
                "group_id" => 1,
            ],
            [
                "grado" => "segundo",
                "grado_numero" => "2",
                "level_id" => 2,
                "generation_id" => 5,
                "group_id" => 1,
            ],
            [
                "grado" => "tercero",
                "grado_numero" => "3",
                "level_id" => 2,
                "generation_id" => 6,
                "group_id" => 1,
            ],
            [
                "grado" => "cuarto",
                "grado_numero" => "4",
                "level_id" => 2,
                "generation_id" => 7,
                "group_id" => 1,
            ],
            [
                "grado" => "quinto",
                "grado_numero" => "5",
                "level_id" => 2,
                "generation_id" => 8,
                "group_id" => 1,
            ],
            [
                "grado" => "sexto",
                "grado_numero" => "6",
                "level_id" => 2,
                "generation_id" => 9,
                "group_id" => 1,
            ],

            [
                "grado" => "primero",
                "grado_numero" => "1",
                "level_id" => 3,
                "generation_id" => 10,
                "group_id" => 1,
            ],
            [
                "grado" => "segundo",
                "grado_numero" => "2",
                "level_id" => 3,
                "generation_id" => 11,
                "group_id" => 1,
            ],
            [
                "grado" => "tercero",
                "grado_numero" => "3",
                "level_id" => 3,
                "generation_id" => 12,
                "group_id" => 1,
            ],
            [
                "grado" => "primero",
                "grado_numero" => "1",
                "level_id" => 1,
                "generation_id" => 1,
                "group_id" => 2,
            ],
            [
                "grado" => "segundo",
                "grado_numero" => "2",
                "level_id" => 2,
                "generation_id" => 2,
                "group_id" => 2,
            ],
            [
                "grado" => "tercero",
                "grado_numero" => "3",
                "level_id" => 3,
                "generation_id" => 3,
                "group_id" => 2,
            ],
            [
                "grado" => "primero",
                "grado_numero" => "1",
                "level_id" => 2,
                "generation_id" => 4,
                "group_id" => 2,
            ],
            [
                "grado" => "segundo",
                "grado_numero" => "2",
                "level_id" => 2,
                "generation_id" => 5,
                "group_id" => 2,
            ],
            [
                "grado" => "tercero",
                "grado_numero" => "3",
                "level_id" => 2,
                "generation_id" => 6,
                "group_id" => 2,
            ],
            [
                "grado" => "cuarto",
                "grado_numero" => "4",
                "level_id" => 2,
                "generation_id" => 7,
                "group_id" => 2,
            ],
            [
                "grado" => "quinto",
                "grado_numero" => "5",
                "level_id" => 2,
                "generation_id" => 8,
                "group_id" => 2,
            ],
            [
                "grado" => "sexto",
                "grado_numero" => "6",
                "level_id" => 2,
                "generation_id" => 9,
                "group_id" => 2,
            ],

            [
                "grado" => "primero",
                "grado_numero" => "1",
                "level_id" => 3,
                "generation_id" => 10,
                "group_id" => 2,
            ],
            [
                "grado" => "segundo",
                "grado_numero" => "2",
                "level_id" => 3,
                "generation_id" => 11,
                "group_id" => 2,
            ],
            [
                "grado" => "tercero",
                "grado_numero" => "3",
                "level_id" => 3,
                "generation_id" => 12,
                "group_id" => 2,
            ],
            [
                "grado" => "primero",
                "grado_numero" => "1",
                "level_id" => 1,
                "generation_id" => 1,
                "group_id" => 3,
            ],
            [
                "grado" => "segundo",
                "grado_numero" => "2",
                "level_id" => 2,
                "generation_id" => 2,
                "group_id" => 3,
            ],
            [
                "grado" => "tercero",
                "grado_numero" => "3",
                "level_id" => 3,
                "generation_id" => 3,
                "group_id" => 3,
            ],
            [
                "grado" => "primero",
                "grado_numero" => "1",
                "level_id" => 2,
                "generation_id" => 4,
                "group_id" => 3,
            ],
            [
                "grado" => "segundo",
                "grado_numero" => "2",
                "level_id" => 2,
                "generation_id" => 5,
                "group_id" => 3,
            ],
            [
                "grado" => "tercero",
                "grado_numero" => "3",
                "level_id" => 2,
                "generation_id" => 6,
                "group_id" => 3,
            ],
            [
                "grado" => "cuarto",
                "grado_numero" => "4",
                "level_id" => 2,
                "generation_id" => 7,
                "group_id" => 3,
            ],
            [
                "grado" => "quinto",
                "grado_numero" => "5",
                "level_id" => 2,
                "generation_id" => 8,
                "group_id" => 3,
            ],
            [
                "grado" => "sexto",
                "grado_numero" => "6",
                "level_id" => 2,
                "generation_id" => 9,
                "group_id" => 3,
            ],

            [
                "grado" => "primero",
                "grado_numero" => "1",
                "level_id" => 3,
                "generation_id" => 10,
                "group_id" => 3,
            ],
            [
                "grado" => "segundo",
                "grado_numero" => "2",
                "level_id" => 3,
                "generation_id" => 11,
                "group_id" => 3,
            ],
            [
                "grado" => "tercero",
                "grado_numero" => "3",
                "level_id" => 3,
                "generation_id" => 12,
                "group_id" => 3,
            ],


        ];

        foreach ($grados as $grado) {
            \App\Models\Grade::factory()->create($grado);
        }
    }
}
