<?php

namespace App\Livewire;

use App\Models\Generation;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Grade;
use App\Models\Level;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;

class GradeTable extends DataTableComponent
{
    protected $model = Grade::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id')
        ->setReorderEnabled()
        ->setSingleSortingDisabled()
        ->setHideReorderColumnUnlessReorderingEnabled()
        ->setQueryStringStatusForSearch(true)

        // ->setFilterLayoutPopover()
        ->setFilterLayoutSlideDown()
        ->setRememberColumnSelectionDisabled();
        $this->setBulkActionConfirmMessage('deleteSelected', '¿Estás seguro de que deseas eliminar los elementos seleccionados?');
        $this->setBulkActionConfirmMessage('updateSelected', '¿Estás seguro de que deseas actualizar los elementos seleccionados?');




        $this->setBulkActions([
            'deleteSelected' => 'Eliminar',
            'updateSelected' => 'Actualizar',
        ]);
    }

    public function deleteSelected()
    {
        foreach($this->getSelected() as $item)
        {
           $eliminar = Grade::find($item);
              $eliminar->delete();
        }
        $this->clearSelected();
    }

    public function updateSelected()
    {
        foreach($this->getSelected() as $item)
        {

           $actualizar = Grade::find($item);

              $actualizar->update([
                'group_id' => 1
              ]);




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
            Column::make("Grado", "grado")
                ->sortable(),
            Column::make("Grado numero", "grado_numero")
                ->sortable(),
            Column::make("Nivel", "level.level")
                ->sortable(),
            Column::make("Generación Inicio", "generation.anio_inicio")
                ->sortable()
                ->format(
                    fn($value) => $value
                )
                ->html(),
            Column::make("Generación Término", "generation.anio_termino")
                ->sortable()
                ->format(
                    fn($value) => $value
                )
                ->html()
                ,
            Column::make("Grupo", "group.grupo")
                ->sortable(),

                Column::make("Status", "generation.status")
                    ->sortable()
                    ->format(
                        fn($value) => $value == 1
                            ? "<span class='bg-indigo-100 text-indigo-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-sm dark:bg-indigo-900 dark:text-indigo-300'>Activo</span>"
                            : "<span class='bg-red-100 text-red-800  font-medium me-2 px-2.5 py-0.5 rounded-sm dark:bg-red-900 dark:text-red-300'>Inactivo</span>"
                    )
                    ->html()
                ->sortable(),

                Column::make('Editar')
                ->label(
                    fn ($row, Column $column) => view('livewire.component.datatables.action-column')->with(
                        [
                            'editLink' => route('admin.grades.edit', $row),

                        ]
                    )
                )->html(),
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
                $builder->where('grades.level_id', $value); // HACE REFERENCIA AL level_id de la tabla generations
            }),


            SelectFilter::make('Año de inicio')
            ->options(
                Generation::query()
                    ->distinct()
                    ->orderBy('anio_inicio', 'desc')
                    ->pluck('anio_inicio', 'anio_inicio')
                    ->prepend('--Todos--', '')
                    ->toArray() // Asegurar que sea un array plano
            )
            ->filter(function(Builder $builder, string $value) {
                $builder->where('anio_inicio', '=', $value);
            }),
            SelectFilter::make('Año de término')
            ->options(
                Generation::query()
                    ->distinct()
                    ->orderBy('anio_termino', 'desc')
                    ->pluck('anio_termino', 'anio_termino')
                    ->prepend('--Todos--', '')
                    ->toArray() // Asegurar que sea un array plano
            )
            ->filter(function(Builder $builder, string $value) {
                $builder->where('anio_termino', '=', $value);
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


        ];


    }

    public function reorder($items): void
    {
        foreach ($items as $item) {
            Grade::find($item[$this->getPrimaryKey()])->update(['sort' => (int)$item[$this->getDefaultReorderColumn()]]);
        }
    }

    public function builder(): Builder
    {
        return Grade::query()
        ->orderBy('grades.sort', 'asc');
    }
}
