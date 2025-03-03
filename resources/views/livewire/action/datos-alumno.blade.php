<div>
    <!-- component -->
<!-- This is an example component -->
<div class="w-full mx-auto bg-white rounded">

     <!-- LOADER  -->
     @include('admin.partials.loader')


    <div class="mb-5">
        <label
            class="block mb-1 text-sm text-gray-700 uppercase font-bold "
            for="query">Buscar por nombre, matrícula o CURP alumnos:
        </label>
        <input
            wire:model.live.debounce.500ms="query"
            id="query"
            type="text"
            placeholder="Buscar por nombre, matrícula o CURP alumnos:"
            class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 w-full"

            wire:keydown.arrow-down="selectedIndex = (selectedIndex + 1) % count($alumnos)"
            wire:keydown.arrow-up="selectedIndex = (selectedIndex - 1 + count($alumnos)) % count($alumnos)"
            wire:keydown.enter="selectUser(selectedIndex)"
        />



        @if (!empty($alumnos))
        <ul class="absolute bg-white border mt-1 rounded shadow">
            @forelse ($alumnos as $index => $alumno)
            <li
                class="p-2 cursor-pointer {{ $selectedIndex === $index ? 'bg-blue-200' : '' }}"
                wire:click="selectAlumno({{ $index }})"
            >
             <p class="font-bold text-indigo-600">{{ $alumno->apellido_paterno}} {{ $alumno->apellido_materno }} {{ $alumno->nombre }}</p>
            <p class="text-indigo-700"> {{ $alumno->level->level }} {{ $alumno->grade->grado }}° "{{ $alumno->group->grupo }}" | {{  $alumno->CURP }} </p>
            </li>
            @empty
            <li class="p-2">No hay alumnos encontrados.</li>
            @endforelse
        </ul>
    @endif


    </div>

	<div id="accordion-collapse" data-accordion="collapse">
		<h2 id="accordion-collapse-heading-1" class="font-bold">
			<button type="button" class="flex items-center focus:ring-4 focus:ring-indigo-200 dark:focus:ring-indigo-800 justify-between p-5 w-full font-medium text-left border border-indigo-200 dark:border-indigo-700 border-b-0 text-indigo-900 dark:text-white bg-indigo-100 dark:bg-indigo-800 hover:bg-indigo-100 dark:hover:bg-indigo-800 rounded-t-xl" data-accordion-target="#accordion-collapse-body-1" aria-expanded="true" aria-controls="accordion-collapse-body-1">
      <span class="font-bold">Datos del alumnos</span>
      <svg data-accordion-icon class="w-6 h-6 shrink-0 rotate-180" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
    </button>
		</h2>

		<div id="accordion-collapse-body-1" aria-labelledby="accordion-collapse-heading-1">
			<div class="p-5 border border-gray-200 dark:border-gray-700 dark:bg-gray-900 ">

                <div class="w-full mx-auto  p-6 rounded-lg shadow-lg">


                    @isset($alumnoSeleccionadoId)
                   <div class="flex justify-end">
                    <a href="{{route('admin.students.show', $alumnoSeleccionadoId)}}" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                        <i class="fas fa-eye"></i> Ver información completa
                    </a>
                   </div>

                    @endisset


                    <form  wire:submit.prevent="guardarAlumno" class="grid grid-cols-2 gap-4">
                        <!-- Primera columna -->
                        <div>
                            <label class="block text-gray-700">Matrícula:</label>
                            <input type="text" readonly wire:model="matricula" class="w-full bg-gray-100 border-gray-300 rounded-md shadow-sm p-2">
                        </div>
                        <div>
                            <label class="block text-gray-700">Primer Apellido:</label>
                            <input type="text" readonly wire:model="apellido_paterno" class="w-full bg-gray-100 border-gray-300 rounded-md shadow-sm p-2">
                        </div>
                        <div>
                            <label class="block text-gray-700">Segundo Apellido:</label>
                            <input type="text" readonly  wire:model="apellido_materno"  class="w-full bg-gray-100 border-gray-300 rounded-md shadow-sm p-2">
                        </div>
                        <div>
                            <label class="block text-gray-700">Nombres:</label>
                            <input type="text" readonly  wire:model="nombre" class="w-full bg-gray-100 border-gray-300 rounded-md shadow-sm p-2">
                        </div>
                        <div>
                            <label class="block text-gray-700">CURP:</label>
                            <input type="text" readonly  wire:model="CURP" class="w-full bg-gray-100 border-gray-300 rounded-md shadow-sm p-2">
                        </div>
                        <div>
                            <label class="block text-gray-700">Género:</label>
                            <input type="text" readonly  wire:model="genero" class="w-full bg-gray-100 border-gray-300 rounded-md shadow-sm p-2">
                        </div>
                        <div>
                            <label class="block text-gray-700">Fecha de Nacimiento:</label>
                            <input type="text" readonly wire:model="fecha_nacimiento"  class="w-full bg-gray-100 border-gray-300 rounded-md shadow-sm p-2">
                        </div>
                        <div>
                            <label class="block text-gray-700">País de Nacimiento:</label>
                            <input type="text" wire:model="pais_nacimiento"  class="w-full border-gray-300 rounded-md shadow-sm p-2" value="México" >
                        </div>
                        <div>
                            <label class="block text-gray-700">Estado de Nacimiento:</label>
                            <input type="text" wire:model="estado_nacimiento" class="w-full border-gray-300 rounded-md shadow-sm p-2" value="México" >

                        </div>
                        <div>
                            <label class="block text-gray-700">Municipio de Nacimiento:</label>
                            <input type="text"  wire:model="municipio_nacimiento" class="w-full border-gray-300 rounded-md shadow-sm p-2">

                        </div>
                        <div>
                            <label class="block text-gray-700">Estado Donde Vive:</label>
                            <input type="text"  wire:model="estado_vive"  class="w-full border-gray-300 rounded-md shadow-sm p-2">

                        </div>
                        <div>
                            <label class="block text-gray-700">Municipio Donde Vive:</label>
                            <input type="text"  wire:model="municipio_vive"  class="w-full border-gray-300 rounded-md shadow-sm p-2">

                        </div>
                        <div>
                            <label class="block text-gray-700">Colonia:</label>
                            <input type="text"  wire:model="colonia" class="w-full border-gray-300 rounded-md shadow-sm p-2">

                        </div>
                        <div>
                            <label class="block text-gray-700">Calle:</label>
                            <input type="text"  wire:model="calle" class="w-full border-gray-300 rounded-md shadow-sm p-2">
                        </div>
                        <div>
                            <label class="block text-gray-700">Número:</label>
                            <input type="text"  wire:model="numero" class="w-full border-gray-300 rounded-md shadow-sm p-2">
                        </div>
                        <div>
                            <label class="block text-gray-700">Código Postal:</label>
                            <input type="text" wire:model="CP" class="w-full border-gray-300 rounded-md shadow-sm p-2">
                        </div>
                        <div class="mt-4">
                            <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-opacity-50">
                                Guardar
                            </button>
                        </div>
                    </form>

                </div>

			</div>
		</div>


	</div>

</div>

</div>
