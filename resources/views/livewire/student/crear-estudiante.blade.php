<div class="w-full mt-15 p-4 bg-white border border-gray-200 rounded-lg shadow-sm sm:p-8 dark:bg-gray-800 dark:border-gray-700">

    <div class="flex items-center justify-between mb-4">

        <div class="bg-indigo-100 border-l-4 border-indigo-500 text-indigo-700 p-4 w-full" role="alert">
            <p class="font-bold"><i class="fas fa-user"></i> Asigna un Nuevo Estudiante</p>
          </div>
   </div>

   @if (session('error'))
   <div class="bg-red-100 border-t-4 border-red-500 rounded-b text-red-900 px-4 py-2 my-2 shadow-md" role="alert">
       <div class="flex justify-between items-center">
           <div>
               <p class="font-bold">¡Advertencia!</p>
               <p class="text-sm">{{ session('error') }}</p>
           </div>
           <button type="button" class="text-red-900" onclick="this.parentElement.parentElement.style.display='none';">
               <span class="text-xl">&times;</span>
           </button>
       </div>
   </div>
   @endif

<div class="flow-root my-7">

<form wire:submit.prevent="guardarTutor">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
        <div>

            <div class="mb-5">
                <label for="CURP" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">CURP</label>
                <input type="text" id="CURP" wire:model.live="CURP" placeholder="Ingrese el CURP" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                @error('CURP')
                <div class="text-red-500">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-5">
                <label for="nombre" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nombre</label>
                <input type="text" id="nombre" wire:model.live="nombre" placeholder="Ingrese el nombre" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                @error('nombre')
                <div class="text-red-500">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-5">
                <label for="apellido_paterno" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Apellido Paterno</label>
                <input type="text" id="apellido_paterno" wire:model.live="apellido_paterno" placeholder="Ingrese el apellido paterno" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                @error('apellido_paterno')
                <div class="text-red-500">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-5">
                <label for="apellido_materno" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Apellido Materno</label>
                <input type="text" id="apellido_materno" wire:model.live="apellido_materno" placeholder="Ingrese el apellido materno" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                @error('apellido_materno')
                <div class="text-red-500">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-5">
                <label for="fecha_nacimiento" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Fecha de Nacimiento</label>
                <input type="date" id="fecha_nacimiento" wire:model.live="fecha_nacimiento" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                @error('fecha_nacimiento')
                <div class="text-red-500">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-5">
                <label for="edad" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Edad</label>
                <input type="number" id="edad" wire:model.live="edad" placeholder="Ingrese la edad" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                @error('edad')
                <div class="text-red-500">{{ $message }}</div>
                @enderror
            </div>



            <div class="mb-5">
                <label for="sexo" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Sexo</label>
                <div class="flex items-center">
                    <label class="inline-flex items-center">
                        <input type="radio" id="sexo_h" wire:model.live="sexo" value="H" class="form-radio text-blue-600" name="sexo">
                        <span class="ml-2 text-gray-700 dark:text-white">Hombre</span>
                    </label>
                    <label class="inline-flex items-center ml-6">
                        <input type="radio" id="sexo_m" wire:model.live="sexo" value="M" class="form-radio text-blue-600" name="sexo">
                        <span class="ml-2 text-gray-700 dark:text-white">Mujer</span>
                    </label>
                </div>
                @error('sexo')
                <div class="text-red-500">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div>



            <div class="mb-5">
                <label for="level_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nivel</label>
                <input type="text" id="level_id" wire:model.live="level_id" placeholder="Ingrese el nivel" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                @error('level_id')
                <div class="text-red-500">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-5">
                <label for="grade_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Grado</label>
                <input type="text" id="grade_id" wire:model.live="grade_id" placeholder="Ingrese el grado" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                @error('grade_id')
                <div class="text-red-500">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-5">
                <label for="group_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Grupo</label>
                <input type="text" id="group_id" wire:model.live="group_id" placeholder="Ingrese el grupo" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                @error('group_id')
                <div class="text-red-500">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-5">
                <label for="generation_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Generación</label>
                <input type="text" id="generation_id" wire:model.live="generation_id" placeholder="Ingrese la generación" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                @error('generation_id')
                <div class="text-red-500">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-5">
                <label for="tutor_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tutor</label>
                <select
                id="tutor_id" wire:model.live="tutor_id" class=" bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option value="">--Seleccione un tutor--</option>
                    @foreach($tutores as $tutor)
                        <option value="{{ $tutor->id }}">{{ $tutor->nombre }} {{ $tutor->apellido_paterno }} {{ $tutor->apellido_materno }}  </option>
                    @endforeach
                </select>
                @error('tutor_id')
                <div class="text-red-500">{{ $message }}</div>
                @enderror

            </div>

            <div>

            </div>


            <div class="mb-5">
                <label for="status" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Status</label>
                <input type="text" id="status" wire:model.live="status" placeholder="Ingrese el status" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                @error('status')
                <div class="text-red-500">{{ $message }}</div>
                @enderror
            </div>

            <div class="flex justify-start items-center mb-5">
                <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none
                focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center
                dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    Agregar Estudiante
                    <svg wire:loading style="width: 30px; height: 40px; margin-left: 5px;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 200"><path fill="#FFFFFF" stroke="#FFFFFF" stroke-width="6" transform-origin="center" d="m148 84.7 13.8-8-10-17.3-13.8 8a50 50 0 0 0-27.4-15.9v-16h-20v16A50 50 0 0 0 63 67.4l-13.8-8-10 17.3 13.8 8a50 50 0 0 0 0 31.7l-13.8 8 10 17.3 13.8-8a50 50 0 0 0 27.5 15.9v16h20v-16a50 50 0 0 0 27.4-15.9l13.8 8 10-17.3-13.8-8a50 50 0 0 0 0-31.7Zm-47.5 50.8a35 35 0 1 1 0-70 35 35 0 0 1 0 70Z"><animateTransform type="rotate" attributeName="transform" calcMode="spline" dur="2" values="0;120" keyTimes="0;1" keySplines="0 0 1 1" repeatCount="indefinite"></animateTransform></path></svg>
                </button>
            </div>
        </div>
    </div>

  </form>

   </div>
</div>




