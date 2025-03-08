<?php

namespace App\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Personnel;

class PersonnelTable extends DataTableComponent
{
    protected $model = Personnel::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),
            Column::make("Titulo", "titulo")
                ->sortable(),
            Column::make("Nombre", "nombre")
                ->sortable(),
            Column::make("Apellido paterno", "apellido_paterno")
                ->sortable(),
            Column::make("Apellido materno", "apellido_materno")
                ->sortable(),
            Column::make("CURP", "CURP")
                ->sortable(),
            Column::make("RFC", "RFC")
                ->sortable(),
            Column::make("Email", "email")
                ->sortable(),
            Column::make("Telefono", "telefono")
                ->sortable(),
            Column::make("Direccion", "direccion")
                ->sortable(),
            Column::make("Perfil", "perfil")
                ->sortable(),
            Column::make("Created at", "created_at")
                ->sortable(),
            Column::make("Updated at", "updated_at")
                ->sortable(),
        ];
    }
}
