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
    protected $model = Tutor::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id')
        ->setReorderEnabled()
        ->setSingleSortingDisabled()
        ->setHideReorderColumnUnlessReorderingEnabled()
        // ->setFilterLayoutPopover()
        ->setFilterLayoutSlideDown()
        ->setRememberColumnSelectionDisabled();

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
                ->sortable(),
            Column::make("Nombre", "nombre")
                ->sortable(),
            Column::make("Apellido paterno", "apellido_paterno")
                ->sortable(),
            Column::make("Apellido materno", "apellido_materno")
                ->sortable(),
            Column::make("Calle", "calle")
                ->sortable(),
            Column::make("Num ext", "num_ext")
                ->sortable(),
            Column::make("Num int", "num_int")
                ->sortable(),
            Column::make("Localidad", "localidad")
                ->sortable(),
            Column::make("Colonia", "colonia")
                ->sortable(),
            Column::make("CP", "CP")
                ->sortable(),
            Column::make("Municipio", "municipio")
                ->sortable(),
            Column::make("Estado", "estado")
                ->sortable(),
            Column::make("Telefono", "telefono")
                ->sortable(),
            Column::make("Celular", "celular")
                ->sortable(),
            Column::make("Email", "email")
                ->sortable(),
            Column::make("Parentesco", "parentesco")
                ->sortable(),
            Column::make("Ocupacion", "ocupacion")
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
        ->orderBy('tutors.sort', 'asc');
    }

}
