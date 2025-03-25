<?php

namespace App\Livewire\Action;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Materia;

use Rappasoft\LaravelLivewireTables\Views\Columns\BooleanColumn;
use Illuminate\Database\Eloquent\Builder;

class MateriaTable extends DataTableComponent
{

    public $listeners = ['refreshMaterias' => '$refresh'];



    protected $model = Materia::class;
    public $level_id;
    public $grade;

    public $selectedMateria;
    public $showModal = false;


        public function edit($id)
    {
        $this->selectedMateria = Materia::find($id);
        $this->showModal = true;
    }

    public function rowView(): string
{
    return 'livewire.action.materia.editar-materia';
}

    public function configure(): void
    {

        $this->setPrimaryKey('id')

        ->setReorderEnabled();
        $this->setBulkActionConfirmMessage('deleteSelected', '¿Estás seguro de que deseas eliminar los elementos seleccionados?');


        $this->setBulkActions([
            'deleteSelected' => 'Eliminar',
        ]);
    }

    public function deleteSelected()
    {
        foreach($this->getSelected() as $item)
        {
           $eliminar = Materia::find($item);
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

                            'editLink' => route('admin.materias.edit', $row),

                        ]
                    )
                )->html(),

            Column::make('#', 'sort')
            ->sortable(),
            Column::make("Id", "id")
                ->sortable(),
            Column::make("Materia", "materia")
                ->sortable()
                ->searchable( ),
            Column::make("Clave", "clave")
                ->sortable()
                ->searchable( ),
            Column::make("Nivel", "level.level")
                ->sortable()
                ->searchable( ),
            Column::make("Grado", "grade.grado")
                ->sortable(),
            Column::make("Grupo", "group.grupo")
                ->sortable(),
            Column::make("Campo Formativo", "campoFormativo.nombre")
                ->sortable()
                ->searchable( ),
            BooleanColumn::make("Calificación", "calificacion")
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
            Materia::find($item[$this->getPrimaryKey()])->update(['sort' => (int)$item[$this->getDefaultReorderColumn()]]);
        }
    }

    public function builder(): Builder
    {

        return Materia::query()
            ->where('materias.level_id', $this->level_id)
            ->where('materias.grade_id', $this->grade->id)
            ->orderBy('materias.sort', 'asc');
    }
}
