<?php

namespace App\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Level;
use Rappasoft\LaravelLivewireTables\Views\Columns\ColorColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\ImageColumn;

class LevelTable extends DataTableComponent
{
    protected $model = Level::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setBulkActionConfirmMessage('deleteSelected', '¿Estás seguro de que quieres eliminar los niveles seleccionados?');


    $this->setBulkActions([
        'deleteSelected' => 'Eliminar',
    ]);

    }

    public function deleteSelected()
    {
        foreach($this->getSelected() as $item)
        {
           $eliminar = Level::find($item);
              $eliminar->delete();
        }
        $this->clearSelected();
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),
            Column::make("Level", "level")
                ->sortable()
                ->searchable(),
            Column::make("Slug", "slug")
                ->sortable(),
                ImageColumn::make('imagen', 'imagen')
                ->location(
                    fn($row) => $row->imagen
                        ? asset('storage/levels/' . $row->imagen)
                        : "https://st4.depositphotos.com/14953852/24787/v/380/depositphotos_247872612-stock-illustration-no-image-available-icon-vector.jpg"
                )
                ->attributes(fn($row) => [
                    'class' => 'rounded-full w-10 h-10',
                    'alt' => $row->level . ' Avatar',
                ]),
            ColorColumn::make('Color', 'color'),
            Column::make("CCT", "cct")
                ->sortable()
                ->searchable(),
            Column::make("Director", "director.nombre")
                ->sortable()
                ->searchable(),
            Column::make("Supervisor", "supervisor.nombre")
                ->sortable()
                ->searchable(),
            Column::make("Created at", "created_at")
                ->sortable(),
            Column::make("Updated at", "updated_at")
                ->sortable(),


                Column::make('Action')
                ->label(
                    fn ($row, Column $column) => view('livewire.component.datatables.action-column')->with(
                        [
                            'editLink' => route('admin.levels.edit', $row),

                        ]
                    )
                )->html(),
        ];
    }
}
