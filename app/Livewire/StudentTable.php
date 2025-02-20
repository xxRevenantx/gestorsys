<?php

namespace App\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Student;

class StudentTable extends DataTableComponent
{
    protected $model = Student::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),
            Column::make("CURP", "CURP")
                ->sortable(),
            Column::make("Nombre", "nombre")
                ->sortable(),
            Column::make("Apellido paterno", "apellido_paterno")
                ->sortable(),
            Column::make("Apellido materno", "apellido_materno")
                ->sortable(),
            Column::make("Edad", "edad")
                ->sortable(),
            Column::make("Fecha nacimiento", "fecha_nacimiento")
                ->sortable(),
            Column::make("Sexo", "sexo")
                ->sortable(),
            Column::make("Status", "status")
                ->sortable(),
            Column::make("Level id", "level_id")
                ->sortable(),
            Column::make("Grade id", "grade_id")
                ->sortable(),
            Column::make("Group id", "group_id")
                ->sortable(),
            Column::make("Generation id", "generation_id")
                ->sortable(),
            Column::make("Tutor id", "tutor_id")
                ->sortable(),
            Column::make("Sort", "sort")
                ->sortable(),
            Column::make("Created at", "created_at")
                ->sortable(),
            Column::make("Updated at", "updated_at")
                ->sortable(),
        ];
    }
}
