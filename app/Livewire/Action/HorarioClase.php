<?php

namespace App\Livewire\Action;

use App\Models\Action;
use App\Models\Grade;
use App\Models\Horario;
use App\Models\Level;
use App\Models\Materia;
use Livewire\Attributes\On;
use Livewire\Component;

class HorarioClase extends Component
{
    public $materias;
    public $grade_id;
    public $level_id;
    public $group_id;
    public $teacher_id;
    public $horarios = [];
    public $grupos = [];
    public $materiasGrupo;

    // VARIABLES GET
    public $level;
    public $action;
    public $grade; // GRADO SELECCIONADO

    public $hora;

    // Colores de las materias
    public $materiaColors = [];

    public $observacion;

    public $horasSecundaria = [];

    public $horasPrimaria = [];


    // busqueda

    public $search = '';


    public function placeholder(){
        return view('placeholder');
    }

    // Se carga el nivel y los horarios en la inicialización
    public function mount($level_id)
    {
        $this->level_id = $level_id;


        $this->horasSecundaria = [
            "7:00am-8:00am",
            "8:00am-9:00am",
            "9:00am-9:30am",
            "9:30am-10:30am",
            "10:30am-11:30am",
            "11:30am-12:30pm",
            "12:30pm-1:30pm",
            "1:30pm-2:30pm"
        ];

        $this->horasPrimaria =[
            "8:00am-9:00am",
            "9:00am-10:00am",
            "10:00am-10:30am",
            "10:30am-11:30am",
            "11:30am-12:30pm",
            "12:30pm-1:30pm",
            "1:30pm-2:30pm"
        ];




    // Obtener los horarios y convertirlos a un arreglo simple
    $horarios = Horario::all();
    foreach ($horarios as $horario) {
        $this->horarios[$horario->id] = [
            'id' => $horario->id,
            'hora' => $horario->hora,
            'lunes' => $horario->lunes,
            'martes' => $horario->martes,
            'miercoles' => $horario->miercoles,
            'jueves' => $horario->jueves,
            'viernes' => $horario->viernes,
            'group_id' => $horario->group_id, // <-- Agregado
            'observacion' => $horario->observacion,
        ];
    }

    $this->materias = Materia::where('level_id', $this->level_id)
        ->with('teacher')
        ->orderBy('sort', 'asc')
        ->get();

    $this->level = Level::find($this->level_id);
    $this->action = Action::where('slug', 'horarios')->first();
    $this->grade_id = $this->grade->id; // GRADO SELECCIONADO POR DEFECTO EN EL SELECT DE GRADOS EN LA VISTA DE MATRICULA ESCOLAR

    $this->grupos = $this->grade->groups; // GRUPOS DEL GRADO SELECCIONADO POR DEFECTO EN EL SELECT DE GRUPOS EN LA VISTA DE MATRICULA ESCOLAR



    }




    public function guardarHora(){
        $this->validate([
            'hora' => [
            'required',
            'string',
            function ($attribute, $value, $fail) {
                $exists = Horario::where('hora', $value)
                ->where('group_id', $this->group_id)
                ->where('level_id', $this->level_id)
                ->where('grade_id', $this->grade_id)
                ->exists();
                if ($exists) {
                $fail('La hora ya existe en el mismo grupo, nivel y grado.');
                }
            },
            ],
            'group_id' => 'required|exists:groups,id',
        ],[
            'hora.required' => 'El campo hora es obligatorio',
            'group_id.required' => 'El campo grupo es obligatorio',
            'group_id.exists' => 'El grupo no existe',
        ]);



        Horario::create([
            'hora' => trim($this->hora),
            'level_id' => $this->level_id,
            'grade_id' => $this->grade_id,
            'group_id' => $this->group_id,

        ]);

        $this->hora = '';
        $this->group_id = '';

        $this->dispatch('swal', [
            'title' => 'Hora guardada correctamente',
            'icon' => 'success',
            'position' => 'top',
        ]);

        $this->dispatch('refreshTable');


    }

    #[On('refreshTable')]
    public function refreshTable()
    {
        // ESPERAR UN SEGUNDO, Y RESETEAR EL GRADO, GRUPO Y genero
        sleep(1);
        $this->horarios = Horario::all()->mapWithKeys(function ($horario) {
            return [
                $horario->id => [
                    'id' => $horario->id,
                    'hora' => $horario->hora,
                    'lunes' => $horario->lunes,
                    'martes' => $horario->martes,
                    'miercoles' => $horario->miercoles,
                    'jueves' => $horario->jueves,
                    'viernes' => $horario->viernes,
                    'group_id' => $horario->group_id, // <-- Agregado
                ],
            ];
        })->toArray();



    }

    // ACTUALIZAR HORA
    public function actualizarHora($id)
    {


        $groupId = $this->horarios[$id]['group_id'] ?? null;


        $this->validate([
            "horarios.$id.hora" => [
                'required',
                function ($attribute, $value, $fail) use ($id, $groupId) {
                    $exists = Horario::where('hora', $value)
                        ->where('level_id', $this->level_id)
                        ->where('grade_id', $this->grade_id)
                        ->where('group_id', $groupId)
                        ->where('id', '!=', $id)
                        ->exists();
                        if ($exists) {
                            // Limpiar el valor del campo
                            $this->horarios[$id]['hora'] = '';

                            // Lanzar el error de validación
                            // $fail('La hora ya existe en el mismo grupo, nivel y grado.');

                            // Mostrar alerta visual opcional
                            $this->dispatch('swal', [
                                'title' => "Hora duplicada",
                                'icon' => 'error',
                                'position' => 'top',
                            ]);
                        }
                },
            ],
        ], [
            "horarios.$id.hora.required" => 'El campo hora es obligatorio',

        ]);

        $horario = Horario::find($id);

        if ($horario) {
            $horario->hora = $this->horarios[$id]['hora'];
            $horario->save();
        }
    }

    // Actualizar la materia en el día específico del horario
    public function actualizarMateria($id, $dia, $materia)
    {
        $horario = Horario::find($id);

        if (!$horario) return;

        // Si se quiere quitar la materia
        if (!$materia) {
            $horario->$dia = null;
            $horario->save();
            return;
        }

        // Obtener la nueva materia y su maestro
        $nuevaMateria = Materia::with('teacher')->find($materia);
        if (!$nuevaMateria || !$nuevaMateria->teacher_id) return;

        $nuevoTeacherId = $nuevaMateria->teacher_id;
        $relacionDia = $dia . 'Materia';

        // Buscar conflicto específico
        $horarioConflicto = Horario::where('hora', $horario->hora)
            ->where('id', '!=', $horario->id)
            ->whereHas($relacionDia, function ($query) use ($nuevoTeacherId) {
                $query->where('teacher_id', $nuevoTeacherId);
            })
            ->with(['group', 'grade', 'level']) // Para mostrar información en el mensaje
            ->first();

        if ($horarioConflicto) {
            $grupo = $horarioConflicto->group?->grupo ?? 'Desconocido';
            $grado = $horarioConflicto->grade?->grado ?? 'Desconocido';
            $nivel = $horarioConflicto->level?->level ?? 'Desconocido';
            $hora = $horario->hora;




            $this->dispatch('swal', [
                'title' => "Este profesor ya está asignado en el $grado ° Grado, Grupo $grupo, Nivel $nivel a las $hora el día $dia.",
                'icon' => 'info',
                'position' => 'top',
            ]);

            // $horarioConflicto->observacion = "Profesor asignado en el $grado ° Grado, Grupo $grupo, Nivel $nivel a las $hora el día $dia.";
            // $horarioConflicto->save();

        }


        // No hay conflicto, guardar
        // $horario->observacion = null; // Limpiar la observación si no hay conflicto
        $horario->$dia = $materia;
        $horario->save();
    }




    public function render()
    {
        $grados = Grade::where('level_id', $this->level_id)->get();

        return view('livewire.action.horario-clase', compact('grados'));
    }
}

