<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ActionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $acciones = [
                [
                    'accion' => 'Matrícula Escolar',
                    'slug' => 'matricula-escolar'
                ],
                [
                    'accion' => 'Inscribir alumno',
                    'slug' => 'inscribir-alumno'
                ],
                [
                    'accion' => 'Datos del alumno',
                    'slug' => 'datos-del-alumno'
                ],
                [
                    'accion' => 'Pago de inscripción',
                    'slug' => 'pago-inscripcion'
                ],
                [
                    'accion' => 'Pago de Colegiaturas',
                    'slug' => 'pago-de-colegiaturas'
                ],

                [
                    'accion' => 'Materias',
                    'slug' => 'materias'
                ],
                [
                    'accion' => 'Horarios',
                    'slug' => 'horarios'
                ],
                [
                    'accion' => 'Calificaciones',
                    'slug' => 'calificaciones'
                ],
                [
                    'accion' => 'Documentos',
                    'slug' => 'documentos'
                ],

            ];

        foreach ($acciones as $accion) {
            \App\Models\Action::create($accion);
        }

    }
}
