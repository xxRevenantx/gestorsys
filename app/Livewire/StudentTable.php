<?php

namespace App\Livewire;

use App\Models\Generation;
use App\Models\Grade;
use App\Models\Level;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Student;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Columns\DateColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\ImageColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;
use Rappasoft\LaravelLivewireTables\Views\Filters\DateFilter;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;

class StudentTable extends DataTableComponent
{
    protected $model = Student::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id')
        ->setFilterLayoutSlideDown()
        ->setBulkActionConfirmMessage('deleteSelected', '¿Estás seguro de que quieres eliminar los alumnos seleccionados?');


        $this->setAdditionalSelects(['students.nombre as nombre', 'students.apellido_paterno as apellido_paterno', 'students.apellido_materno as apellido_materno']);



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

                Column::make('Editar')
                ->label(
                    fn ($row, Column $column) => view('livewire.component.datatables.action-column')->with(
                        [
                            'editLink' => route('admin.students.edit', $row),
                            'viewLink' => route('admin.students.show', $row),

                        ]
                    )
                )->html(),


            ImageColumn::make('Foto', 'imagen')
                ->location(
                    fn($row) => $row->imagen
                        ? asset('storage/students/' . $row->imagen)
                        : "https://cdn-icons-png.flaticon.com/512/3237/3237472.png"
                )
                ->attributes(fn($row) => [
                    'class' => 'rounded-full w-15 h-15',
                    'alt' => $row->nombre . ' Avatar',
                ]),
            Column::make("CURP", "CURP")
                ->sortable()
                ->searchable(),

            Column::make("Apellido paterno", "apellido_paterno")
                ->sortable()
                ->searchable(),
            Column::make("Apellido materno", "apellido_materno")
                ->sortable()
                ->searchable(),

            Column::make('Nombre', 'nombre')
                ->searchable()
                ->sortable(),
                Column::make("Edad", "edad")
                ->sortable(),
            DateColumn::make('Fecha nacimiento', 'fecha_nacimiento')
            ->searchable()
            ->sortable(),


            Column::make("Género", "genero")
                ->searchable()
                ->sortable(),

            Column::make("Nivel", "level.level")
                ->searchable()
                ->sortable(),
            Column::make("Grado", "grade.grado")
                ->searchable()
                ->sortable(),
            Column::make("Grupo", "group.grupo")
                ->searchable()
                ->sortable(),
            LinkColumn::make("Generación", "generation_id")
            ->title(fn($row) => $row->generation->anio_inicio . '-' . $row->generation->anio_termino )
            ->location(fn($row) => route('admin.generations.edit', $row->generation->id))
            ->attributes(fn($row) => [
                'class' => 'rounded-full underline cursor-pointer text-blue-800 hover:text-blue-800',
            ])
            ->attributes(fn($row) => [
                'class' => 'rounded-full underline cursor-pointer text-blue-800 hover:text-blue-800',
            ])
            ->searchable(
                fn(Builder $query, $searchTerm) => $query->orWhereHas('generation', function ($query) use ($searchTerm) {
                    $query->where('anio_inicio', 'like', '%' . $searchTerm . '%')
                        ->orWhere('anio_termino', 'like', '%' . $searchTerm . '%')
                        ->orWhereRaw("CONCAT(anio_inicio, '-', anio_termino) LIKE ?", ['%' . $searchTerm . '%']);
                })
            )
            ->sortable(),


                Column::make("Status", "status")
                ->format(function($value) {
                    return $value == 1 ? '<span class="bg-blue-500 p-1 rounded-lg text-white">Activo</span>' : '<span style="color: red;">Inactivo</span>';
                })
                ->html()
                ->searchable()
                ->sortable(),

  


            LinkColumn::make("Tutor", 'tutor_id')
            ->title(fn($row) => $row->tutor->nombre . ' ' . $row->tutor->apellido_paterno . ' ' . $row->tutor->apellido_materno)
            ->location(fn($row) => route('admin.tutors.show', $row->tutor->id))
            ->attributes(fn($row) => [
                'class' => 'rounded-full underline cursor-pointer text-blue-800 hover:text-blue-800',
            ])
            // ->format(
            //         fn($value, $row, Column $column) => $row->tutor->nombre . ' ' . $row->tutor->apellido_paterno . ' ' . $row->tutor->apellido_materno
            //     )
                ->searchable(
                    fn(Builder $query, $searchTerm) => $query->orWhereHas('tutor', function ($query) use ($searchTerm) {
                        $query->where('nombre', 'like', '%' . $searchTerm . '%')
                            ->orWhere('apellido_paterno', 'like', '%' . $searchTerm . '%')
                            ->orWhere('apellido_materno', 'like', '%' . $searchTerm . '%');
                    })
                )
                ->sortable(),

            Column::make("Inscrito", "created_at")
                ->format(fn($value) => \Carbon\Carbon::parse($value)->format('d-m-Y'))
                ->searchable()
                ->sortable(),
            Column::make("Actualizado", "updated_at")
                ->format(fn($value) => \Carbon\Carbon::parse($value)->format('d-m-Y'))
                ->searchable(
                    fn(Builder $query, $searchTerm) => $query->where('students.updated_at', 'like', '%' . $searchTerm . '%')
                )
                ->sortable(),




        ];
    }

    public function filters(): array
    {
        return [

           SelectFilter::make('Niveles', 'level_id') // CONSULTAR CON CLAVE FORANEA
            ->options(
                Level::query()
                    ->orderBy('sort')
                    ->get()
                    ->keyBy('id')
                    ->map(fn($level) => $level->level)
                    ->prepend('--Todos--', '')
                    ->toArray()
            ) ->filter(function(Builder $builder, string $value) {
                $builder->where('students.level_id', $value); // HACE REFERENCIA AL level_id de la tabla generations
            }),





            SelectFilter::make('Status', 'status')

            ->options([
                '' => 'Todos',
                '1' => 'Activo',
                '0' => 'Inactivo',
            ])
            ->filter(function(Builder $builder, string $value) {
                if ($value === '1') {
                    $builder->where('status', true);
                } elseif ($value === '0') {
                    $builder->where('status', false);
                }
            }),

            DateFilter::make('Fecha de Nacimiento', 'fecha_nacimiento')
            ->config([
                'min' => '1988-01-01',
                'max' => '2050-12-31',
            ])
            ->filter(function(Builder $builder, string $value) {
                $builder->where('fecha_nacimiento', '=', $value);
            }),

        ];


    }



    public function builder(): Builder
{
    return Student::query()
    ->orderBy('students.level_id', 'asc')
    ->orderBy('students.grade_id', 'asc')
    ->orderBy('students.group_id', 'asc')
    ->orderBy('students.apellido_paterno', 'asc')
    ->orderBy('students.apellido_materno', 'asc');
}

}
