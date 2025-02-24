<?php

namespace App\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Student;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Columns\ImageColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;

class StudentTable extends DataTableComponent
{
    protected $model = Student::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id')
        ->setReorderEnabled();

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
            ImageColumn::make('Foto', 'imagen')
                ->location(
                    fn($row) => $row->imagen
                        ? asset('storage/students/' . $row->imagen)
                        : "https://cdn-icons-png.flaticon.com/512/3237/3237472.png"
                )
                ->attributes(fn($row) => [
                    'class' => 'rounded-full w-15 h-10',
                    'alt' => $row->nombre . ' Avatar',
                ]),
            Column::make("CURP", "CURP")
                ->sortable(),
            Column::make("Nombre completo", "nombre")
            ->format(
                fn($value, $row, Column $column) =>  $row->apellido_paterno . ' ' . $row->apellido_materno
            )
                ->sortable(),
                Column::make("Status", "status")
                ->format(function($value) {
                    return $value == 1 ? '<span class="bg-blue-500 p-1 rounded-lg text-white">Activo</span>' : '<span style="color: red;">Inactivo</span>';
                })
                ->html()
                ->sortable(),

            Column::make("Edad", "edad")
                ->sortable(),
            Column::make("Fecha nacimiento", "fecha_nacimiento")
                ->format(fn($value) => \Carbon\Carbon::parse($value)->format('d, m, Y'))
                ->sortable(),
            Column::make("Sexo", "sexo")
                ->sortable(),

            Column::make("Nivel", "level.level")
                ->sortable(),
            Column::make("Grado", "grade.grado")
                ->sortable(),
            Column::make("Grupo", "group.grupo")
                ->sortable(),
            // Column::make("Generación", "generation.anio_inicio")
            //     ->format(function($value, $column, $row) {
            //         return $row->generation->anio_inicio . ' - ' . $row->generation->anio_termino;
            //     })
            //     ->sortable(),
            LinkColumn::make("Tutor", 'tutor_id')
            ->title(fn($row) => $row->tutor->nombre . ' ' . $row->tutor->apellido_paterno . ' ' . $row->tutor->apellido_materno)
            ->location(fn($row) => route('admin.tutors.show', $row->tutor->id))
            ->attributes(fn($row) => [
                'class' => 'rounded-full underline cursor-pointer text-blue-800 hover:text-blue-800',
            ])
            // ->format(
            //         fn($value, $row, Column $column) => $row->tutor->nombre . ' ' . $row->tutor->apellido_paterno . ' ' . $row->tutor->apellido_materno
            //     )
                ->sortable(),

            Column::make("Inscrito", "created_at")
                ->format(fn($value) => \Carbon\Carbon::parse($value)->format('d/m/Y'))
                ->sortable(),
            Column::make("Actualizado", "updated_at")
                ->format(fn($value) => \Carbon\Carbon::parse($value)->format('d/m/Y'))
                ->sortable(),

                Column::make('Editar')
                ->label(
                    fn ($row, Column $column) => view('livewire.component.datatables.action-column')->with(
                        [
                            'editLink' => route('admin.students.edit', $row),

                        ]
                    )
                )->html(),


        ];
    }

    public function reorder($items): void
    {
        foreach ($items as $item) {
            Student::find($item[$this->getPrimaryKey()])->update(['sort' => (int)$item[$this->getDefaultReorderColumn()]]);
        }
    }


    public function builder(): Builder
{
    return Student::query()
    ->orderBy('sort', 'asc');
}

}
