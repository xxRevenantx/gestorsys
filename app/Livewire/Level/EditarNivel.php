<?php

namespace App\Livewire\Level;

use App\Models\Director;
use App\Models\Level;
use App\Models\Supervisor;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;

class EditarNivel extends Component
{
    use WithFileUploads;

    public $level;
    public $level_id;
    public $slug;
    public $color;
    public $cct;
    public $director_id;
    public $supervisor_id;
    public $imagen;
    public $imagen_nueva;




    public function actualizarNivel()
    {
        $datos = $this->validate([
            'level' => 'required|unique:levels,level,' . $this->level_id,
            'slug' => 'required|unique:levels,slug,' . $this->level_id,
            'cct' => 'nullable|unique:levels,cct,' . $this->level_id,
            'director_id' => 'nullable',
            'supervisor_id' => 'nullable',
            'imagen_nueva' => 'image|nullable|max:5120|mimes:jpeg,jpg,png',
        ], [
            'level.required' => 'El campo nivel es obligatorio',
            'level.unique' => 'El nivel ya existe',
            'slug.required' => 'El campo slug es obligatorio',
            'slug.unique' => 'El slug ya existe',
            'color.required' => 'El campo color es obligatorio',
            'cct.unique' => 'El C.C.T. ya existe',
            'imagen_nueva.image' => 'El archivo debe ser una imagen',
            'imagen_nueva.max' => 'El archivo no debe pesar más de 5MB',
            'imagen_nueva.mimes' => 'El archivo debe ser formato jpeg, jpg o png',

        ]
    );

        if($this->imagen_nueva){
            $imagen = $this->imagen_nueva->store('levels');
            $datos['imagen'] = str_replace('levels/', '', $imagen);
        }

        // ENCONRAR EL NIVEL

        $level = Level::find($this->level_id);


        $level->level = trim($this->level);
        $level->slug = $this->slug;
        $level->color = $this->color;
        $level->cct = $this->cct;
        $level->director_id = $this->director_id;
        $level->supervisor_id = $this->supervisor_id;
        $level->imagen = $datos['imagen'] ?? $level->imagen;

        $level->save();



        session()->flash('mensaje', 'Nivel actualizado con éxito');

        return redirect()->route('admin.levels.index');

    }



    public function updatedLevel($value)
    {
        // Genera el slug automáticamente cuando el título cambia
        $this->slug = Str::slug(trim($value));
    }

    public function mount($level)
    {
        $this->level_id = $level->id;
        $this->level = trim($level->level);
        $this->slug = $level->slug;
        $this->color = $level->color;
        $this->cct = $level->cct;
        $this->director_id = $level->director_id;
        $this->supervisor_id = $level->supervisor_id;
        $this->imagen = $level->imagen;
    }


    public function render()
    {
        $directores = Director::all();
        $supervisores = Supervisor::all();

        return view('livewire.level.editar-nivel', compact('directores', 'supervisores'));
    }
}
