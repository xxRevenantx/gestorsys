<?php

namespace App\Livewire\Level;

use App\Models\Director;
use App\Models\Level;
use App\Models\Supervisor;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Illuminate\Support\Str;


class CrearNivel extends Component
{

    use WithFileUploads;

    public $level;
    public $slug;
    public $imagen;
    public $color;
    public $cct;
    public $director_id;
    public $supervisor_id;



    protected $rules = [
        'level' => 'required|unique:levels',
        'slug' => 'required|unique:levels',
        'cct' => 'nullable|unique:levels',
        'imagen' =>  'image|nullable|max:2048|mimes:jpeg,jpg,png',
    ];

    protected $messages = [
        'level.required' => 'El campo nivel es obligatorio',
        'level.unique' => 'El nivel ya existe',
        'slug.required' => 'El campo slug es obligatorio',
        'slug.unique' => 'El slug ya existe',
        'cct.unique' => 'El C.C.T. ya existe',
        'imagen.image' => 'El archivo debe ser una imagen',
        'imagen.max' => 'El archivo no debe pesar más de 2MB',
        'imagen.mimes' => 'El archivo debe ser formato jpeg, jpg o png',
    ];


    public function updatedLevel($value)
    {
        // Genera el slug automáticamente cuando el título cambia
        $this->slug = Str::slug(trim($value));
    }

    public function guardarNivel()
    {
        $datos = $this->validate();



        if ($this->imagen) {
            $imagen = $this->imagen->store('levels');
            $datos["imagen"] = str_replace('levels/', '', $imagen);
        } else {
            $datos["imagen"] = null;
        }



        Level::create([
            'level' => trim($this->level),
            'slug' => $this->slug,
            'imagen' => $datos["imagen"],
            'color' => $this->color,
            'cct' => strtoupper(trim($this->cct)),
            'director_id' => $this->director_id,
            'supervisor_id' => $this->supervisor_id,

        ]);

        $this->reset();

        session()->flash('mensaje', 'Nivel creado con éxito');

        return redirect()->route('admin.levels.index');

    }


    public function render()
    {
        $directores = Director::all();
        $supervisores = Supervisor::all();

        return view('livewire.level.crear-nivel', compact('directores', 'supervisores'));
    }
}
