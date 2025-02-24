<?php

namespace App\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Tutor;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;

use Maatwebsite\Excel\Facades\Excel;
use App\Exports\TutorExport;

class TutorTable extends DataTableComponent
{

    protected $listeners = ['resfreshTable' => '$refresh'];

    protected $model = Tutor::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id')
        ->setReorderEnabled();

        $this->setBulkActionConfirmMessage('deleteSelected', '¿Estás seguro de que quieres eliminar los tutores seleccionados?');




    $this->setBulkActions([
        'deleteSelected' => 'Eliminar',
        'exportSelected' => 'Exportar a excel',
    ]);

    }

    public function deleteSelected()
    {
        foreach($this->getSelected() as $item)
        {
           $eliminar = Tutor::find($item);
              $eliminar->delete();
        }
        $this->clearSelected();
    }

    public function exportSelected()
    {
        if($this->getSelected()){
            $this->getSelected();
            $tutors = Tutor::whereIn('id', $this->getSelected())->get();
            return Excel::download(new TutorExport($tutors), 'tutores.xlsx');
        }else{
            return Excel::download(new TutorExport($this->getRows()), 'tutores.xlsx');
        }


    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),
            Column::make("#", "sort")
                ->sortable(),
            Column::make("CURP", "CURP")
            ->searchable()
                ->sortable(),
            Column::make("Nombre", "nombre")
            ->searchable()
                ->sortable(),
            Column::make("Apellido paterno", "apellido_paterno")
            ->searchable()
                ->sortable(),
            Column::make("Apellido materno", "apellido_materno")
            ->searchable()
                ->sortable(),
            Column::make("Calle", "calle")
            ->searchable()
                ->sortable(),
            Column::make("Num ext", "num_ext")
            ->searchable()
                ->sortable(),
            Column::make("Num int", "num_int")
            ->searchable()
                ->sortable(),
            Column::make("Localidad", "localidad")
            ->searchable()
                ->sortable(),
            Column::make("Colonia", "colonia")
            ->searchable()
                ->sortable(),
            Column::make("CP", "CP")
                ->sortable(),
            Column::make("Municipio", "municipio")
            ->searchable()
                ->sortable(),
            Column::make("Estado", "estado")
            ->searchable()
                ->sortable(),
            Column::make("Telefono", "telefono")
            ->searchable()
                ->sortable(),
            Column::make("Celular", "celular")
            ->searchable()
                ->sortable(),
            Column::make("Email", "email")
            ->searchable()
                ->sortable(),
            Column::make("Parentesco", "parentesco")
            ->searchable()
                ->sortable(),
            Column::make("Ocupacion", "ocupacion")
            ->searchable()
                ->sortable(),
            Column::make("Último grado", "ultimo_grado")
            ->searchable()
                ->sortable(),

                Column::make('Editar')
                ->label(
                    fn ($row, Column $column) => view('livewire.component.datatables.action-column')->with(
                        [
                            'editLink' => route('admin.tutors.edit', $row),
                            'viewLink' => route('admin.tutors.show', $row),

                        ]
                    )
                )->html(),
        ];
    }



    public function reorder($items): void
    {
        foreach ($items as $item) {
            Tutor::find($item[$this->getPrimaryKey()])->update(['sort' => (int)$item[$this->getDefaultReorderColumn()]]);
        }
    }

    public function builder(): Builder
    {
        return Tutor::query()
        ->orderBy('tutors.sort', 'desc');
    }

}
