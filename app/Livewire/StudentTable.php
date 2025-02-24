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
        $this->setPrimaryKey('id')
        ->setReorderEnabled()
        ->setSingleSortingDisabled()
        ->setHideReorderColumnUnlessReorderingEnabled()
        ->setFilterLayoutSlideDown()
        ->setRememberColumnSelectionDisabled()
        ->setLoadingPlaceholderStatus(true)
        // ->setLoadingPlaceholderContent('Cargando...');
        ->setLoadingPlaceholderBlade('loader-table');
        ;

        $this->setBulkActionConfirmMessage('deleteSelected', '¿Estás seguro de que quieres eliminar los alumnos seleccionados?');




    $this->setBulkActions([
        'deleteSelected' => 'Eliminar',
    ]);

    }

    public function deleteSelected()
    {
        foreach($this->getSelected() as $item)
        {
           $eliminar = Student::find($item);
              $eliminar->delete();
        }
        $this->clearSelected();
    }


    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),
                Column::make("#", "sort")
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
                ->format(function($value) {
                    return $value == 1 ? '<span class="bg-blue-500 p-1 rounded-lg text-white">Activo</span>' : '<span style="color: red;">Inactivo</span>';
                })
                ->html()
                ->sortable(),
            Column::make("Level id", "level.level")
                ->sortable(),
            Column::make("Grade id", "grade.grado")
                ->sortable(),
            Column::make("Group id", "group.grupo")
                ->sortable(),
            // Column::make("Generación", "generation.anio_inicio")
            //     ->format(function($value, $column, $row) {
            //         return $row->generation->anio_inicio . ' - ' . $row->generation->anio_termino;
            //     })
            //     ->sortable(),
            Column::make("Tutor id", "tutor.nombre")
                ->sortable(),

            Column::make("Created at", "created_at")
                ->sortable(),
            Column::make("Updated at", "updated_at")
                ->sortable(),
        ];
    }
}
