<?php

namespace App\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Personnel;
use DragonCode\Support\Facades\Helpers\Boolean;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Columns\BooleanColumn;

class PersonnelTable extends DataTableComponent
{
    protected $model = Personnel::class;

    protected $listeners = ['resfreshTable' => '$refresh'];

    public function configure(): void
    {
        $this->setPrimaryKey('id')
        ->setReorderEnabled();
        $this->setBulkActionConfirmMessage('deleteSelected', '¿Estás seguro de que deseas eliminar el personal seleccionado(s)?');


        $this->setBulkActions([
            'deleteSelected' => 'Eliminar',
        ]);
    }

    public function deleteSelected()
    {
        foreach($this->getSelected() as $item)
        {
           $eliminar = Personnel::find($item);
              $eliminar->delete();

            // $this->dispatch('generacion');
        }
        $this->clearSelected();
    }

    public function columns(): array
    {
        return [
            Column::make('Acciones')
                ->label(
                    fn ($row, Column $column) => view('livewire.component.datatables.action-column')->with(
                        [
                            'editLink' => route('admin.personnels.edit', $row),
                            'viewLink' => route('admin.personnels.show', $row),

                        ]
                    )
                )->html(),

            Column::make("Id", "id")
                ->sortable(),
            Column::make("#", "sort")
                ->sortable(),
            BooleanColumn::make("Estado", "status")
                ->sortable(),
            Column::make("Titulo", "titulo")
                ->sortable()
                ->searchable()
                ->format(
                    fn ($value, $column, $row) => strtoupper($value)
                )
                ,
            // Column::make("Nombre completo", "nombre")
            //     ->sortable()
            //     ->searchable()
            //     ->format(
            //         fn ($value, $column, $row) => strtoupper($column->nombre)." ".strtoupper($column->apellido_paterno)." ".strtoupper($column->apellido_materno)
            //     ),

            Column::make('Nombre completo')
                ->label(fn ($row, Column $column) => $row),


            Column::make("CURP", "CURP")
                ->sortable()
                ->searchable()
                ,
            Column::make("RFC", "RFC")
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
            Column::make("Direccion", "direccion")
                ->sortable()
                ->searchable()
                ,
            Column::make("Perfil", "perfil")
                ->sortable()
                ->searchable()
                ,
            Column::make("Created at", "created_at")
                ->sortable(),
            Column::make("Updated at", "updated_at")
                ->sortable(),
        ];
    }

    public function reorder($items): void
    {
        foreach ($items as $item) {
            Personnel::find($item[$this->getPrimaryKey()])->update(['sort' => (int)$item[$this->getDefaultReorderColumn()]]);
        }
    }

    public function builder(): Builder
    {
        return Personnel::query()
        ->orderBy('personnels.sort', 'asc');
    }
}
