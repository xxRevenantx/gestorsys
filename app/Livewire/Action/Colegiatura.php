<?php

namespace App\Livewire\Action;

use App\Models\Colegiatura as ModelsColegiatura;
use App\Models\Month;
use App\Models\Student;
use Livewire\Component;

class Colegiatura extends Component
{
    public $level_id;


    public $alumnos; // Resultados de la búsqueda
    public $selectedIndex = 0; // Índice para navegación con teclado
    public $alumnoSeleccionadoId = null; // ID del alumno seleccionado

    public $matricula;
    public $apellido_materno;
    public $apellido_paterno;
    public $nombre;
    public $CURP;


    // VARIABLES DE PAGO
    public $pagoExistente = null;
    public $textoPago = "$ Pagar";
    public $query = ''; // Input del usuario
    public $nombre_pago;
    public $tipo_pago;
    public $month_id;
    public $monto;
    public $descuento;
    public $fecha_pago;
    public $observaciones;

    // INPUT HABILIDATADOS
    public $habilitarInput = false; // Estado del botón

    public $pagado = false;


    protected $rules = [
        'query' => 'required',
        'nombre_pago' => 'required|string',
        'tipo_pago' => 'required|string|in:Efectivo,Tarjeta,Transferencia',
        'month_id' => 'required|exists:months,id',
        'monto' => 'required|numeric|min:1',
        'descuento' => 'nullable|numeric|min:0',
        'fecha_pago' => 'required|date',
        'observaciones' => 'nullable|string',

    ];

    protected $messages = [
        'query.required' => 'El alumno es obligatorio',
        'nombre_pago.required' => 'El campo nombre es obligatorio',
        'nombre_pago.string' => 'El campo nombre debe ser una cadena de texto',
        'tipo_pago.required' => 'El campo tipo de pago es obligatorio',
        'tipo_pago.string' => 'El campo tipo de pago debe ser una cadena de texto',
        'tipo_pago.in' => 'El campo tipo de pago debe ser Efectivo, Tarjeta o Transferencia',
        'month_id.required' => 'El campo mes es obligatorio',
        'month_id.exists' => 'El mes seleccionado no es válido',
        'monto.required' => 'El campo monto es obligatorio',
        'monto.min' => 'El campo monto debe ser mayor a 0',
        'descuento.numeric' => 'El campo descuento debe ser un número',
        'descuento.min' => 'El campo descuento debe ser mayor o igual a 0',
        'descuento.required' => 'El campo descuento es obligatorio',
        'monto.numeric' => 'El campo monto debe ser un número',
        'fecha_pago.required' => 'El campo fecha es obligatorio',
        'fecha_pago.date' => 'El campo fecha debe ser una fecha válida',
        'observaciones.string' => 'El campo observaciones debe ser una cadena de texto',
    ];

    public function updatedQuery()
    {
        // Verifica que haya al menos 2 caracteres antes de buscar
        if (strlen($this->query) > 1) {
            $this->alumnos = Student::where('level_id', $this->level_id)
                ->where(function($query) {
                    $query->where('CURP', 'like', '%' . $this->query . '%')
                          ->orWhere('matricula', 'like', '%' . $this->query . '%')
                          ->orWhere('nombre', 'like', '%' . $this->query . '%')
                          ->orWhere('apellido_paterno', 'like', '%' . $this->query . '%')
                          ->orWhere('apellido_materno', 'like', '%' . $this->query . '%')
                          ->orWhereRaw("CONCAT(nombre, ' ', apellido_paterno, ' ', apellido_materno) like ?", ['%' . $this->query . '%']);
                })
                ->get();

            if (empty($this->alumnos)) {
                $this->dispatch('swal', [
                    'title' => 'No se encontraron alumnos con los criterios de búsqueda',
                    'icon' => 'warning',
                    'position' => 'top',
                ]);
            }

            // LIMPIAR VARIABLES DE PAGO AL BUSCAR UN NUEVO ALUMNO para rellenar neuvament el formulario
            $this->nombre_pago = '';
            $this->tipo_pago = '';
            $this->monto = 0;
            $this->month_id = '';
            $this->descuento = 0;
            $this->fecha_pago = '';
            $this->observaciones = '';
            $this->habilitarInput = true; //Habilitar los input al selecciona un alumnos

        } else {

            // Limpia los resultados si el input está vacío o tiene menos de 2 caracteres de longitud
            $this->alumnos = [];
            $this->matricula = '';
            $this->nombre = '';
            $this->apellido_paterno = '';
            $this->apellido_materno = '';
            $this->CURP = '';
            $this->nombre_pago = '';
            $this->tipo_pago = '';
            $this->month_id = '';
            $this->monto = 0;
            $this->descuento = 0;
            $this->fecha_pago = '';
            $this->observaciones = '';

            $this->textoPago = "$ Pagar";
            $this->habilitarInput = false; //Desabillitarlos inputs  si no hay nada en el input de alumno

        }
    }

    public function selectAlumno($index)
    {
        if (isset($this->alumnos[$index])) {
            // Establece el usuario seleccionado en el input
            $this->query = $this->alumnos[$index]['nombre'] . ' ' . $this->alumnos[$index]['apellido_paterno'] . ' ' . $this->alumnos[$index]['apellido_materno'];
            $this->alumnoSeleccionadoId = $this->alumnos[$index]['id']; // Obtiene el ID del alumno seleccionado
            $this->alumnos = []; // Limpia los resultados

            $alumno = Student::find($this->alumnoSeleccionadoId);

            // Llena los campos del formulario con los datos del alumno seleccionado si el alumnoexiste en la base de datos
            if ($alumno) {
            $this->textoPago = "$ Pagar";
            $this->matricula = $alumno->matricula;
            $this->nombre = $alumno->nombre;
            $this->apellido_paterno = $alumno->apellido_paterno;
            $this->apellido_materno = $alumno->apellido_materno;
            $this->CURP = $alumno->CURP;

            // HABILIDAD LOS INPUT CUANDO SE ENCUENTRE UN ALUMNO
            // $this->inputNombrePago = true;


            // Verifica si el alumno tiene un pago existente, si ya hay un pago se llenan los datos del fomrulario para editar
            $this->pagoExistente = ModelsColegiatura::where('student_id', $this->alumnoSeleccionadoId)
                ->where('month_id', $this->month_id)
                ->latest()
                ->first();
            if ($this->pagoExistente) {
                $this->textoPago = "$ Actualizar pago";
                $this->nombre_pago = $this->pagoExistente->nombre_pago;
                $this->tipo_pago = $this->pagoExistente->tipo_pago;
                $this->monto = $this->pagoExistente->monto;
                $this->month_id = $this->pagoExistente->month_id;
                $this->descuento = $this->pagoExistente->descuento;
                $this->fecha_pago = $this->pagoExistente->fecha_pago;
                $this->observaciones = $this->pagoExistente->observaciones;
            }
            }
        }
    }

    public function updated($propertyName){ // Se ejecuta al modificar el descuento para validar que no sea nulo y asignar 0 si es así (para evitar errores)

        if (empty($this->descuento)) {
            $this->descuento = 0;
        }
        if(empty($this->monto)){
            $this->monto = 0;
            }

            // SI SE SELECCIONÓ UN ALUMNO QUE SE HABILITEN LOS BOTONES
        if ($this->alumnoSeleccionadoId) {
            $this->habilitarInput = true;
        } else {
            $this->habilitarInput = false;
        }



        if ($propertyName === 'month_id') {
            $existingPayment = ModelsColegiatura::where('student_id', $this->alumnoSeleccionadoId) // Verifica si ya existe un pago para el alumno y el mes seleccionado
            ->where('month_id', $this->month_id)
            ->first();

            if ($existingPayment) {
            $this->dispatch('swal', [
                'title' => 'El alumno ya tiene un pago registrado para este mes. Puedes actualizarlo si lo deseas',
                'text' => 'Si deseas registrar un nuevo pago, selecciona otro mes',
                'icon' => 'warning',
                'position' => 'top',
            ]);
            $this->textoPago = "$ Actualizar pago";
            $this->nombre_pago = $existingPayment->nombre_pago;
            $this->tipo_pago = $existingPayment->tipo_pago;
            $this->monto = $existingPayment->monto;
            $this->descuento = $existingPayment->descuento;
            $this->fecha_pago = $existingPayment->fecha_pago;
            $this->observaciones = $existingPayment->observaciones;

            } else {
                // Si no existe un pago, se muestra un mensaje de que se puede registrar un nuevo pago
                $this->dispatch('swal', [
                    'title' => 'Colegiatura disponible. Puedes registrar un nuevo pago',
                    'icon' => 'success',
                    'position' => 'top',
                ]);
            $this->textoPago = "$ Pagar";
            $this->nombre_pago = '';
            $this->tipo_pago = '';
            $this->monto = 0;
            $this->descuento = 0;
            $this->fecha_pago = '';
            $this->observaciones = '';
            }
        }

        $this->validateOnly($propertyName);

    }

    public function mount() // Se ejecuta al cargar el componente
    {
        $this->descuento = 0;
        $this->monto = 0;



    }


    public function guardarPago(){

        $this->validate();

        $alumno = Student::find($this->alumnoSeleccionadoId);

        $total = $this->monto - $this->descuento;

        if ($alumno) {

            // Verifica si ya existe un pago para el alumno y el mes seleccionado para actualizarlo
            $pagoExistente = ModelsColegiatura::where('student_id', $this->alumnoSeleccionadoId)
            ->where('month_id', $this->month_id)
            ->latest()
            ->first();

            if ($pagoExistente) {
            $pagoExistente->update([
                'nombre_pago' => $this->nombre_pago,
                'monto' => $this->monto,
                'descuento' => $this->descuento,
                'total' => $total,
                'tipo_pago' => $this->tipo_pago,
                'month_id' => $this->month_id,
                'fecha_pago' => $this->fecha_pago,
                'observaciones' => $this->observaciones,
            ]);

            $this->dispatch('swal', [
                'title' => '¡Pago actualizado correctamente!',
                'icon' => 'success',
                'position' => 'top',
            ]);


            $this->dispatch('refreshColegiatura'); // actualizar la tabla


            } else {


            ModelsColegiatura::create([ // Si no existe un pago, se crea uno nuevo con los datos del formulario
                'nombre_pago' => $this->nombre_pago,
                'monto' => $this->monto,
                'descuento' => $this->descuento,
                'total' => $total,
                'tipo_pago' => $this->tipo_pago,
                'month_id' => $this->month_id,
                'fecha_pago' => $this->fecha_pago,
                'student_id' => $this->alumnoSeleccionadoId,
                'level_id' => $this->level_id,
                'observaciones' => $this->observaciones,
            ]);

            $this->dispatch('swal', [
                'title' => '¡Pago registrado correctamente!',
                'icon' => 'success',
                'position' => 'top',
            ]);
            $this->dispatch('refreshColegiatura'); // actualizar la tabla
            }

            $this->reset([
            'query',
            'nombre_pago',
            'tipo_pago',
            'month_id',
            'monto',
            'descuento',
            'fecha_pago',
            'alumnoSeleccionadoId',
            'matricula',
            'nombre',
            'apellido_paterno',
            'apellido_materno',
            'CURP',
            'observaciones',
            'pagoExistente',
            ]);
        } else {
            $this->dispatch('swal', [
            'title' => 'No se encontró el alumno seleccionado',
            'icon' => 'error',
            'position' => 'top',
            ]);
        }
    }


    public function placeholder(){
        return view('placeholder');
    }

    public function render()
    {
        /**
         * Recupera todos los meses y verifica si existe un pago para el estudiante seleccionado y cada mes.
         *
         * Esta función obtiene todos los meses del modelo Month y mapea cada mes para determinar
         * si existe un pago para el estudiante seleccionado (alumnoSeleccionadoId) y el mes actual.
         * Agrega una propiedad 'hasPayment' a cada mes indicando si existe un pago.
         *
         * @return \Illuminate\Support\Collection Una colección de meses con una propiedad adicional 'hasPayment'.
         */
        $meses = Month::all()->map(function ($month) {
            $month->hasPayment = ModelsColegiatura::where('student_id', $this->alumnoSeleccionadoId) // Verifica si ya existe un pago para el alumno y el mes seleccionado para actualizarlo
            ->where('month_id', $month->id)
            ->exists();
            return $month;
        });


        return view('livewire.action.colegiatura', compact('meses'));
    }
}
