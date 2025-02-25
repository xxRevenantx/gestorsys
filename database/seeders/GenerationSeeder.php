<?php

namespace Database\Seeders;

use App\Models\Generation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GenerationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $generaciones = [
            [
                'anio_inicio' => '2020',
                'anio_termino' => '2023',
                'status' => '1',
                'level_id' => '1',
            ],
            [
                'anio_inicio' => '2021',
                'anio_termino' => '2024',
                'status' => '1',
                'level_id' => '1',
            ],
            [
                'anio_inicio' => '2022',
                'anio_termino' => '2025',
                'status' => '1',
                'level_id' => '1',
            ],


                [
                    'anio_inicio' => '2017',
                    'anio_termino' => '2023',
                    'status' => '1',
                    'level_id' => '2',
                ],
                [
                    'anio_inicio' => '2018',
                    'anio_termino' => '2024',
                    'status' => '1',
                    'level_id' => '2',
                ],
                [
                    'anio_inicio' => '2019',
                    'anio_termino' => '2025',
                    'status' => '1',
                    'level_id' => '2',
                ],
                [
                    'anio_inicio' => '2020',
                    'anio_termino' => '2026',
                    'status' => '1',
                    'level_id' => '2',
                ],
                [
                    'anio_inicio' => '2021',
                    'anio_termino' => '2027',
                    'status' => '1',
                    'level_id' => '2',
                ],
                [
                    'anio_inicio' => '2022',
                    'anio_termino' => '2028',
                    'status' => '1',
                    'level_id' => '2',
                ],
                [
                    'anio_inicio' => '2020',
                    'anio_termino' => '2023',
                    'status' => '1',
                    'level_id' => '3',
                ],
                [
                    'anio_inicio' => '2021',
                    'anio_termino' => '2024',
                    'status' => '1',
                    'level_id' => '3',
                ],
                [
                    'anio_inicio' => '2022',
                    'anio_termino' => '2025',
                    'status' => '1',
                    'level_id' => '3',
                ],

        ];

        foreach ($generaciones as $generacion) {
            Generation::create($generacion);
        }


    }
}
