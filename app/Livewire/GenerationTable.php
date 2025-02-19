<?php

namespace App\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Generation;
use App\Models\Level;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Columns\BooleanColumn;
use Rappasoft\LaravelLivewireTables\Views\Filters\DateFilter;
use Rappasoft\LaravelLivewireTables\Views\Filters\MultiSelectDropdownFilter;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;

class GenerationTable extends DataTableComponent
{
    protected $model = Generation::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id')
        ->setReorderEnabled()
        ->setSingleSortingDisabled()
        ->setHideReorderColumnUnlessReorderingEnabled()
        // ->setFilterLayoutPopover()
        ->setFilterLayoutSlideDown()
        ->setRememberColumnSelectionDisabled();
        $this->setBulkActionConfirmMessage('deleteSelected', '¿Estás seguro de que deseas eliminar los elementos seleccionados?');


        $this->setBulkActions([
            'deleteSelected' => 'Eliminar',
        ]);
    }

    public function deleteSelected()
    {
        foreach($this->getSelected() as $item)
        {
           $eliminar = Generation::find($item);
              $eliminar->delete();

            $this->dispatch('generacion-eliminada');
        }
        $this->clearSelected();
    }

    public function columns(): array
    {
        return [
            Column::make('#', 'sort')
            ->sortable()
            ->collapseOnMobile()
            ->excludeFromColumnSelect(),

            Column::make("Id", "id")
                ->sortable(),
            Column::make("Fecha inicio", "anio_inicio")
                ->searchable()
                ->sortable(),
            Column::make("Fecha termino", "anio_termino")
                ->searchable()
                ->sortable(),

            BooleanColumn::make('Status','status')
            ->sortable(),

            Column::make("Nivel perteneciente", "level.level")
                ->searchable()
                ->sortable(),
            Column::make("Creado", "created_at")
                ->format(
                    fn($value) => $value->format('d/m/Y H:i:s')
                )
                ->sortable(),
            Column::make("Actualizado", "updated_at")
            ->format(
                fn($value) => $value->format('d/m/Y H:i:s')
            )
                ->sortable(),

                Column::make('Action')
                ->label(
                    fn ($row, Column $column) => view('livewire.component.datatables.action-column')->with(
                        [
                            'editLink' => route('admin.generations.edit', $row),

                        ]
                    )
                )->html(),
        ];
    }

    public function filters(): array
    {
        return [

           SelectFilter::make('Niveles') // CONSULTAR CON CLAVE FORANEA
            ->options(
                Level::query()
                    ->orderBy('sort')
                    ->get()
                    ->keyBy('id')
                    ->map(fn($level) => $level->level)
                    ->prepend('--Todos--', '')
                    ->toArray()
            ) ->filter(function(Builder $builder, string $value) {
                $builder->where('level_id', $value); // HACE REFERENCIA AL level_id de la tabla generations
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
            Generation::find($item[$this->getPrimaryKey()])->update(['sort' => (int)$item[$this->getDefaultReorderColumn()]]);
        }
    }

    public function builder(): Builder
    {
        return Generation::query()
        ->orderBy('sort', 'asc');
    }

}
