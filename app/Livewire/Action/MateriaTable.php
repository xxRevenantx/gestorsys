<?php

namespace App\Livewire\Action;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Materia;

class MateriaTable extends DataTableComponent
{
    protected $model = Materia::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),
            Column::make("Materia", "materia")
                ->sortable(),
            Column::make("Slug", "slug")
                ->sortable(),
            Column::make("Clave", "clave")
                ->sortable(),
            Column::make("Level id", "level_id")
                ->sortable(),
            Column::make("Grade id", "grade_id")
                ->sortable(),
            Column::make("Teacher id", "teacher_id")
                ->sortable(),
            Column::make("Campo formativo id", "campo_formativo_id")
                ->sortable(),
            Column::make("Calificacion", "calificacion")
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
