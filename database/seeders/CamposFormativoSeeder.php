<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CamposFormativoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $campos = [
            [
                'nombre' => 'Lenguajes',
                'slug' => 'Lenguajes',
                'descripcion' => 'Está orientado a que niñas, niños y adolescentes adquieran y desarrollen la expresión y la comunicación de sus formas de ser y estar en el mundo mediante la oralidad, la escucha, lectura, escritura, sensorialidad, percepción y composición de diversas producciones orales, escritas, sonoras, visuales, corporales o hápticas..'
            ],
            [
                'nombre' => 'Saberes y Pensamiento Científico',
                'slug' => 'saberes-y-pensamiento-cientifico',
                'descripcion' => 'Tiene como finalidad que los estudiantes logren la comprensión necesaria para explicar procesos y fenómenos naturales en su relación con lo social por medio de la indagación interpretación, experimentación, sistematización, representación con modelos y argumentación de tales fenómenos.'
            ],
            [
                'nombre' => 'Ética, Naturaleza y Sociedades',
                'slug' => 'etica-naturaleza-y-sociedades',
                'descripcion' => 'Aborda la relación del ser humano con la sociedad y la naturaleza desde la comprensión crítica de los procesos sociales, políticos, naturales y culturales en diversas comunidades situadas histórica y geográficamente.'
            ],
            [
                'nombre' => 'De lo Humano y lo Comunitario',
                'slug' => 'de-lo-humano-y-lo-comunitario',
                'descripcion' => 'Tiene como finalidad que niñas, niños y adolescentes construyan su identidad personal y desarrollen sus potencialidades (afectivas, motrices, creativas, de interacción y solución de problemas)..'
            ]
        ];

        foreach ($campos as $campo) {
            \App\Models\CamposFormativo::create($campo);
        }


    }
}
