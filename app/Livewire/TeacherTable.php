<?php

namespace App\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Teacher;
use Illuminate\Database\Eloquent\Builder;

class TeacherTable extends DataTableComponent
{
    // protected $model = Teacher::class;


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
            Column::make('Acciones')
                ->label(
                    fn ($row, Column $column) => view('livewire.component.datatables.action-column')->with(
                        [
                            'editLink' => route('admin.teachers.edit', $row),
                            'viewLink' => route('admin.teachers.show', $row),

                        ]
                    )
                )->html(),

            Column::make("Id", "id")
                ->sortable(),
            Column::make("#", "sort")
                ->sortable(),

            Column::make("Nombre", "personnel.nombre")
                ->sortable()
                ->searchable(),
            Column::make("Primer Apellido", "personnel.apellido_paterno")
                ->sortable()
                ->searchable(),
            Column::make("Segundo Apellido", "personnel.apellido_materno")
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
            Column::make("Created at", "created_at")
                ->sortable(),
            Column::make("Updated at", "updated_at")
                ->sortable(),
        ];
    }




    public function reorder($items): void
    {
        foreach ($items as $item) {
            $teacher = Teacher::find($item[$this->getPrimaryKey()]);
            if ($teacher) {
                $teacher->update(['sort' => (int)$item[$this->getDefaultReorderColumn()]]);
            }
        }
    }

    public function builder(): Builder
    {

    $teacher = Teacher::with('personnel', 'level', 'grade', 'group')
                      ->whereHas('personnel', function($query) {
                          $query->where('status', 1);
                      })
                      ->orderBy('sort');


    return $teacher;

}
}
