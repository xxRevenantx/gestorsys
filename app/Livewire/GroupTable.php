<?php

namespace App\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Group;
use Illuminate\Database\Eloquent\Builder;

class GroupTable extends DataTableComponent
{
    protected $model = Group::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setBulkActionConfirmMessage('deleteSelected', '¿Estás seguro de que quieres eliminar los grupos seleccionados?');


        $this->setBulkActions([
            'deleteSelected' => 'Eliminar',
        ]);
    }

    public function deleteSelected()
    {
        foreach($this->getSelected() as $item)
        {
           $eliminar = Group::find($item);
              $eliminar->delete();
        }
        $this->clearSelected();
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),
            Column::make("Grupo", "grupo")
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
                            'editLink' => route('admin.groups.edit', $row),

                        ]
                    )
                )->html(),
        ];
    }



    public function builder(): Builder
{
    return Group::query()
    ->orderBy('grupo', 'asc');
}


}
