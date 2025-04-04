<?php

namespace App\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Group;
use Illuminate\Database\Eloquent\Builder;

class GroupTable extends DataTableComponent
{
    protected $listeners = ['resfreshTable' => '$refresh'];

    public $selectedItems;
    public $modalIsOpen = false;


    protected $model = Group::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id')
        ->setBulkActionConfirmMessage('deleteSelected', '¿Estás seguro de que quieres eliminar los grupos seleccionados?');


        $this->setBulkActions([
            'deleteSelected' => 'Eliminar',
              'editarModal' => 'Editar'
        ]);
    }


    public function editarModal()
    {
        $this->selectedItems = $this->getSelected();
        $this->modalIsOpen = true;
    }

    public function customView(): string
{
    return 'livewire.group.editar-grupo';
}

    public function deleteSelected()
    {
        foreach($this->getSelected() as $item)
        {
           $eliminar = Group::find($item);
              $eliminar->delete();

            $this->dispatch('grupos');
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
            Column::make("Nivel", "level.level")
                ->sortable()
                ->searchable(),
            Column::make("Grado", "grade.grado")
                ->sortable()
                ->searchable(),
            Column::make("Created at", "created_at")
                ->sortable(),
            Column::make("Updated at", "updated_at")
                ->sortable(),

                Column::make('Editar')
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
        ->with('level')
        ->with('grade')
        ->orderBy('groups.level_id', 'asc')
        ->orderBy('groups.grade_id', 'asc');
}


}
