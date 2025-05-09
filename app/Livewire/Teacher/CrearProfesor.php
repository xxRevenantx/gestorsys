<?php

namespace App\Livewire\Teacher;

use App\Models\Grade;
use App\Models\Group;
use App\Models\Level;
use App\Models\Personnel;
use App\Models\Teacher;
use Livewire\Component;

class CrearProfesor extends Component
{
    public $personnel_id;
    public $level_id;
    public $grade_id;
    public $group_id;
    public $funcion;
    public $director;
    public $extra;
    public $ingreso_seg;
    public $ingreso_ct;
    public $color;

    public $grados = [];
    public $grupos = [];

    public $habilitarInput = true;

    protected $rules = [
        'personnel_id' => 'required|exists:personnels,id',
        'level_id' => 'required|exists:levels,id',
        'grade_id' => 'nullable|exists:grades,id',
        'group_id' => 'nullable|exists:groups,id', // Cambiado a nullable
        'funcion' => 'required|string',
        'director' => 'required|in:0,1',
        'extra' => 'required|in:0,1',
        'ingreso_seg' => 'nullable|date',
        'ingreso_ct' => 'nullable|date',
        'color' => 'required|string',
    ];

    protected $messages = [
        'personnel_id.required' => 'El personal es requerido.',
        'personnel_id.exists' => 'El personal seleccionado no existe.',
        'level_id.required' => 'El nivel es requerido.',
        'level_id.exists' => 'El nivel seleccionado no existe.',
        'grade_id.exists' => 'El grado seleccionado no existe.',
        'group_id.required' => 'El grupo es requerido.',
        'group_id.exists' => 'El grupo seleccionado no existe.',
        'funcion.required' => 'La función es requerida.',
        'funcion.string' => 'La función debe ser una cadena de texto.',
        'director.required' => 'El campo director es requerido.',
        'director.in' => 'El campo director es inválido.',
        'extra.required' => 'El campo extra es requerido.',
        'extra.in' => 'El campo extra es inválido.',
        'ingreso_seg.date' => 'El campo ingreso a SEG debe ser una fecha.',
        'ingreso_ct.date' => 'El campo ingreso a CT debe ser una fecha.',
        'color.required' => 'El color es requerido.',

    ];

    public function updated($propertyName)
    {
        if ($propertyName == 'level_id') {
            if (!empty($this->level_id)) {
            $this->grados = Grade::where('level_id', $this->level_id)
                ->orderBy('grado', 'ASC')
                ->get();
            } else {
            $this->grados = [];
            $this->grade_id = null;
            }
            $this->grupos = [];
            $this->group_id = null;
        }

        // CUANDO EL NIVEL SEA SECUNDARIA NO SE PODRÁ SELECCIONAR UN GRUPO NI UN GRADO
        if ($this->level_id == 3) {
            $this->habilitarInput = false;
            $this->dispatch('swal',[
                'title' => 'Para nivel secundaria, no es necesario seleccionar un grado ni un grupo',
                'icon' => 'info',
                'position' => 'top',
            ]);
        }else{
            $this->habilitarInput = true;
        }

        if ($propertyName == 'grade_id') {
            if (!empty($this->grade_id)) {
                $this->grupos = Group::where('grade_id', $this->grade_id)
                    ->orderBy('grupo', 'ASC')
                    ->get();
            } else {
                $this->grupos = [];
                $this->group_id = null;
            }
        }

        if ($propertyName == 'extra' ) {
            if ($this->extra == 1) {
                $this->grados = [];
                $this->grupos = [];
                $this->grade_id = null;
                $this->group_id = null;
             }else{
                $this->habilitarInput = true;
             }

        }

        $this->validateOnly($propertyName);
    }

    public function guardarProfesor()
    {
        // $this->validate();

        $validationRules = [];

        if ($this->level_id == 3 || $this->extra == 1) {
            $validationRules = [
                'group_id' => 'nullable|exists:groups,id',
                'grade_id' => 'nullable|exists:grades,id',
            ];
        } elseif ($this->director === "0") {
            $validationRules = [
                'group_id' => 'required|exists:groups,id',
                'grade_id' => 'required|exists:grades,id',
            ];
        }

        $this->validate($validationRules ?: $this->rules);

        Teacher::create([
            'personnel_id' => $this->personnel_id,
            'level_id' => $this->level_id,
            'grade_id' => $this->grade_id ?: null,
            'group_id' => $this->group_id ?: null,
            'funcion' => $this->funcion,
            'director' => $this->director,
            'extra' => $this->extra,
            'ingreso_seg' => $this->ingreso_seg,
            'ingreso_ct' => $this->ingreso_ct,
            'color' => $this->color,
        ]);

        $this->reset();

        $this->dispatch('resfreshTable');

        $this->dispatch('swal', [
            'title' => '¡Personal creado con éxito!',
            'icon' => 'success',
            'position' => 'top',
        ]);


    }

    public function placeholder()
    {
        return view('placeholder');
    }

    public function render()
    {
        $personal = Personnel::select('id', 'titulo', 'nombre', 'apellido_paterno', 'apellido_materno')->where('status', 1)->get();
        $niveles = Level::select('id', 'level')->orderBy('sort', 'ASC')->get();
        $grupos = Group::select('id', 'grupo')->get();
        return view('livewire.teacher.crear-profesor', compact('personal', 'niveles', 'grupos'));
    }
}
