<?php

namespace App\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Generation;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Columns\BooleanColumn;
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

            Column::make("Level id", "level.level")
                ->searchable()
                ->sortable(),
            Column::make("Created at", "created_at")
                ->sortable(),
            Column::make("Updated at", "updated_at")
                ->sortable(),
        ];
    }

    public function filters(): array
    {
        return [

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
}
