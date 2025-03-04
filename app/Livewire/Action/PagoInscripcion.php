<?php

namespace App\Livewire\Action;

use App\Models\PagoInscripcion as ModelsPagoInscripcion;
use App\Models\Student;
use Livewire\Component;

class PagoInscripcion extends Component
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
    public $monto;
    public $descuento;
    public $fecha_pago;

    protected $rules = [
        'query' => 'required',
        'nombre_pago' => 'required|string',
        'tipo_pago' => 'required|string|in:Efectivo,Tarjeta,Transferencia',
        'monto' => 'required|numeric|min:1',
        'descuento' => 'nullable|numeric|min:0',
        'fecha_pago' => 'required|date',

    ];

    protected $messages = [
        'query.required' => 'El alumno es obligatorio',
        'nombre_pago.required' => 'El campo nombre es obligatorio',
        'nombre_pago.string' => 'El campo nombre debe ser una cadena de texto',
        'tipo_pago.required' => 'El campo tipo de pago es obligatorio',
        'tipo_pago.string' => 'El campo tipo de pago debe ser una cadena de texto',
        'tipo_pago.in' => 'El campo tipo de pago debe ser Efectivo, Tarjeta o Transferencia',
        'monto.required' => 'El campo monto es obligatorio',
        'monto.min' => 'El campo monto debe ser mayor a 0',
        'descuento.numeric' => 'El campo descuento debe ser un número',
        'descuento.min' => 'El campo descuento debe ser mayor o igual a 0',
        'descuento.required' => 'El campo descuento es obligatorio',
        'monto.numeric' => 'El campo monto debe ser un número',
        'fecha_pago.required' => 'El campo fecha es obligatorio',
        'fecha_pago.date' => 'El campo fecha debe ser una fecha válida',
    ];

    public function updatedQuery()
    {
        // Verifica que haya al menos 2 caracteres antes de buscar
        if (strlen($this->query) > 1) {
            $this->alumnos = Student::where('level_id', $this->level_id)
                ->where(function($query) {
                    $query->where('CURP', 'like', '%' . $this->query . '%')
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

            // LIMPIAR VARIABLES DE PAGO AL BUSCAR UN NUEVO ALUMNO
            $this->nombre_pago = '';
            $this->tipo_pago = '';
            $this->monto = 0;
            $this->descuento = 0;
            $this->fecha_pago = '';


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
            $this->monto = 0;
            $this->descuento = 0;
            $this->fecha_pago = '';

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

            // Llena los campos del formulario con los datos del alumno seleccionado si existe en la base de datos
            if ($alumno) {
            $this->textoPago = "$ Pagar";
            $this->matricula = $alumno->matricula;
            $this->nombre = $alumno->nombre;
            $this->apellido_paterno = $alumno->apellido_paterno;
            $this->apellido_materno = $alumno->apellido_materno;
            $this->CURP = $alumno->CURP;

            // Verifica si el alumno tiene un pago existente, si ya hay un pago se llenan los datos del fomrulario para editar
            $this->pagoExistente = ModelsPagoInscripcion::where('student_id', $this->alumnoSeleccionadoId)->first();
            if ($this->pagoExistente) {
                $this->textoPago = "$ Actualizar pago";
                $this->nombre_pago = $this->pagoExistente->nombre_pago;
                $this->tipo_pago = $this->pagoExistente->tipo_pago;
                $this->monto = $this->pagoExistente->monto;
                $this->descuento = $this->pagoExistente->descuento;
                $this->fecha_pago = $this->pagoExistente->fecha_pago->format('d/m/Y');
            }
            }
        }
    }

    public function updatedDescuento($value){ // Se ejecuta al modificar el descuento para validar que no sea nulo y asignar 0 si es así (para evitar errores)
        if (empty($value)) {
            $this->descuento = 0;
        } else {
            $this->descuento = $value;
        }
    }

    public function mount() // Se ejecuta al cargar el componente
    {
        $this->descuento = 0;
    }


    public function guardarPago(){
        $this->validate();

        $alumno = Student::find($this->alumnoSeleccionadoId);

        $total = $this->monto - $this->descuento;

        if ($alumno) {
            $pagoExistente = ModelsPagoInscripcion::where('student_id', $this->alumnoSeleccionadoId)
            ->where('nombre_pago', $this->nombre_pago)
            ->first();

            if ($pagoExistente) {
            $pagoExistente->update([
                'monto' => $this->monto,
                'descuento' => $this->descuento,
                'total' => $total,
                'tipo_pago' => $this->tipo_pago,
                'fecha_pago' => $this->fecha_pago,
            ]);

            $this->dispatch('swal', [
                'title' => '¡Pago actualizado correctamente!',
                'icon' => 'success',
                'position' => 'top',
            ]);
            } else {
            ModelsPagoInscripcion::create([
                'nombre_pago' => $this->nombre_pago,
                'monto' => $this->monto,
                'descuento' => $this->descuento,
                'total' => $total,
                'tipo_pago' => $this->tipo_pago,
                'fecha_pago' => $this->fecha_pago,
                'student_id' => $this->alumnoSeleccionadoId,
            ]);

            $this->dispatch('swal', [
                'title' => '¡Pago registrado correctamente!',
                'icon' => 'success',
                'position' => 'top',
            ]);
            }

            $this->reset([
            'query',
            'nombre_pago',
            'tipo_pago',
            'monto',
            'descuento',
            'fecha_pago',
            'alumnoSeleccionadoId',
            'matricula',
            'nombre',
            'apellido_paterno',
            'apellido_materno',
            'CURP',
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

        return view('livewire.action.pago-inscripcion');
    }
}
