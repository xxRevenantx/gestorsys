<?php

namespace App\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Teacher;
use Illuminate\Database\Eloquent\Builder;

class TeacherTable extends DataTableComponent
{
    protected $model = Teacher::class;

    public $nivel_id;

    protected $listeners = ['resfreshTable' => '$refresh'];

    public function configure(): void
    {
        $this->setPrimaryKey('id');

        $this->setReorderEnabled();

        $this->setBulkActionConfirmMessage('deleteSelected', '¿Estás seguro de que quieres eliminar los elementos seleccionados?');




    $this->setBulkActions([
        'deleteSelected' => 'Eliminar',
    ]);

    }

    public function deleteSelected()
    {
        foreach($this->getSelected() as $item)
        {
           $eliminar = Teacher::find($item);
              $eliminar->delete();
        }
        $this->clearSelected();
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),
            Column::make("#", "sort")
                ->sortable(),
            Column::make("Personal", "personnel.nombre")
                ->sortable()
                ->searchable(),
            Column::make("Nivel", "level.level")
                ->sortable(),
            Column::make("Grado", "grade.grado")
                ->sortable(),
            Column::make("Grupo", "group.grupo")
                ->sortable(),
            Column::make("Funcion", "funcion")
                ->sortable(),
            Column::make("Ingreso seg", "ingreso_seg")
                ->sortable(),
            Column::make("Ingreso ct", "ingreso_ct")
                ->sortable(),
            Column::make("Director", "director")
                ->sortable(),
            Column::make("Created at", "created_at")
                ->sortable(),
            Column::make("Updated at", "updated_at")
                ->sortable(),
        ];
    }




    public function reorder($items): void
    {

        // dd($items);

        foreach ($items as $item) {
            Teacher::find($item[$this->getPrimaryKey()])->update(['sort' => (int)$item[$this->getDefaultReorderColumn()]]);
        }
    }

    public function builder(): Builder
    {
        return Teacher::query()
            ->where('teachers.level_id', $this->nivel_id)
            ->orderBy('teachers.sort', 'asc');
    }


}
