<?php

namespace App\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Personnel;
use Illuminate\Database\Eloquent\Builder;

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
            Column::make("Titulo", "titulo")
                ->sortable(),
            Column::make("Nombre", "nombre")
                ->sortable(),
            Column::make("Apellido paterno", "apellido_paterno")
                ->sortable(),
            Column::make("Apellido materno", "apellido_materno")
                ->sortable(),
            Column::make("CURP", "CURP")
                ->sortable(),
            Column::make("RFC", "RFC")
                ->sortable(),
            Column::make("Email", "email")
                ->sortable(),
            Column::make("Telefono", "telefono")
                ->sortable(),
            Column::make("Direccion", "direccion")
                ->sortable(),
            Column::make("Perfil", "perfil")
                ->sortable(),
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
