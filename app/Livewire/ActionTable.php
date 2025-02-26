<?php

namespace App\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Action;
use Illuminate\Database\Eloquent\Builder;

class ActionTable extends DataTableComponent
{

    protected $listeners = ['resfreshTable' => '$refresh'];


    protected $model = Action::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id')
        ->setReorderEnabled();
        $this->setBulkActionConfirmMessage('deleteSelected', '¿Estás seguro de que quieres eliminar las acciones seleccionadas?');


        $this->setBulkActions([
            'deleteSelected' => 'Eliminar',
        ]);
    }

    public function deleteSelected()
    {
        foreach($this->getSelected() as $item)
        {
           $eliminar = Action::find($item);
              $eliminar->delete();

        }
        $this->clearSelected();
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),
            Column::make("Acción", "accion")
                ->searchable()
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
            Action::find($item[$this->getPrimaryKey()])->update(['sort' => (int)$item[$this->getDefaultReorderColumn()]]);
        }
    }

    public function builder(): Builder
    {
        return Action::query()
        ->orderBy('actions.sort', 'asc');
    }
}
