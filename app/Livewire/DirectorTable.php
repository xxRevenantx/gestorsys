<?php

namespace App\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Director;

class DirectorTable extends DataTableComponent
{
    protected $model = Director::class;



    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setBulkActionConfirmMessage('deleteSelected', '¿Estás seguro de que deseas eliminar estos directores?');


    $this->setBulkActions([
        'deleteSelected' => 'Eliminar',
    ]);

    }

    public function deleteSelected()
    {
        foreach($this->getSelected() as $item)
        {
           $eliminar = Director::find($item);
              $eliminar->delete();
        }
        $this->clearSelected();
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),
            Column::make("Nombre", "nombre")
                ->searchable()
                ->sortable(),
            Column::make("Apellido", "apellido_paterno")
                ->searchable()
                ->sortable(),
            Column::make("Apellido", "apellido_materno")
                ->searchable()
                ->sortable(),
            Column::make("Email", "email")
                ->searchable()
                ->sortable(),
            Column::make("Teléfono", "telefono")
                ->searchable()
                ->sortable(),

            Column::make("Created at", "created_at")
                ->sortable(),
            Column::make("Updated at", "updated_at")
                ->sortable(),

                Column::make('Editar')
                ->label(
                    fn ($row, Column $column) => view('livewire.component.datatables.action-column')->with(
                        [
                            'editLink' => route('admin.directores.edit', $row),

                        ]
                    )
                )->html(),
        ];
    }
}
