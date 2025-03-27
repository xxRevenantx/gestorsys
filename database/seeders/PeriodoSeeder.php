<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PeriodoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $periodos = [
            [
                'num_periodo' => '1',
                'fechas' => '27/01/2025 - 27/03/2025',
            ],
            [
                'num_periodo' => '2',
                'fechas' => '25/03/2025 - 28/03/2025',
            ],
            [
                'num_periodo' => '3',
                'fechas' => '29/05/2025 - 29/07/2025',
            ],

        ];

        foreach ($periodos as $periodo) {
            \App\Models\Periodo::create($periodo);
        }
    }
}
