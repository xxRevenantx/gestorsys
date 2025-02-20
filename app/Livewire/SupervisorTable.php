<?php

namespace App\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Supervisor;
use Rappasoft\LaravelLivewireTables\Views\Columns\ButtonGroupColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;

class SupervisorTable extends DataTableComponent
{
    // protected $model = Supervisor::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');

        $this->setBulkActionConfirmMessage('deleteSelected', '¿Estás seguro de que quieres eliminar los supervisores seleccionados?');


    $this->setBulkActions([
        'deleteSelected' => 'Eliminar',
    ]);

    }

    public function deleteSelected()
    {
        foreach($this->getSelected() as $item)
        {
           $eliminar = Supervisor::find($item);
              $eliminar->delete();
        }
        $this->clearSelected();
    }







    public function columns(): array
    {
        return [

            // ->format(
            //     fn($value, $row, Column $column) => $row->first_name . ' ' . $row->last_name
            // ),

            Column::make("Id", "id")
                ->sortable(),
            Column::make("Nombre", "nombre")
                ->sortable()
                ->searchable()
                ,
            Column::make("Apellido Paterno", "apellido_paterno")
                ->sortable()
                ->searchable()
                ,
            Column::make("Apellido Materno", "apellido_materno")
                ->sortable()
                ->searchable()
                ,

            Column::make("Email", "email")
                ->sortable()
                ->searchable()
                ,
            Column::make("Telefono", "telefono")
                ->sortable()
                ->searchable()
                ,
            Column::make("Zona", "zona")
                ->sortable(),
            Column::make("Sector", "sector")
                ->sortable(),

                Column::make('Editar')
                ->label(
                    fn ($row, Column $column) => view('livewire.component.datatables.action-column')->with(
                        [
                            'editLink' => route('admin.supervisores.edit', $row),

                        ]
                    )
                )->html(),


                // ButtonGroupColumn::make('Acciones')
                // ->buttons([
                //     LinkColumn::make('Action')
                //     ->title(fn($row) => 'Editar')
                //     ->location(fn($row) => route('admin.supervisores.edit', $row))
                //     ->attributes(fn($row) => [
                //         'class' => 'btn btn-yellow'
                //     ]),
                //     LinkColumn::make('Action')
                //     ->title(fn($row) => 'Ver')
                //     ->location(fn($row) => route('dashboard', [
                //         'post' => $row->id
                //     ]))
                //     ->attributes(fn($row) => [
                //         'class' => 'btn btn-blue'
                //     ]),
                //     LinkColumn::make('Action')
                //     ->title(fn($row) => 'Eliminar')


                // ])

        ];
    }

    public function builder(): Builder // Query Builder sirve para hacer consultas a la base de datos
    {
        return Supervisor::query();
    }
}
