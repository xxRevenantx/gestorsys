<div class="w-full mt-15 p-4 bg-white border border-gray-200 rounded-lg shadow-sm sm:p-8 dark:bg-gray-800 dark:border-gray-700">
    @if (session('mensaje'))
    <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-2 my-2 shadow-md" role="alert">
        <div class="flex justify-between items-center">
            <div>
                <p class="font-bold">¡Ok!</p>
                <p class="text-sm">{{ session('mensaje') }}</p>
            </div>
            <button type="button" class="text-teal-900" onclick="this.parentElement.parentElement.style.display='none';">
                <span class="text-xl">&times;</span>
            </button>
        </div>
    </div>
@endif

    <div class="flex items-center justify-between mb-4">

        <div class="bg-indigo-100 border-l-4 border-indigo-500 text-indigo-700 p-4 w-full" role="alert">
            <p class="font-bold"><i class="fas fa-user"></i> Editar Tutor</p>
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

<form wire:submit.prevent="actualizarTutor">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-3">


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
            <label for="calle" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Calle</label>
            <input type="text" id="calle" wire:model.live="calle" placeholder="Ingrese la calle" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
            @error('calle')
            <div class="text-red-500">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-5">
            <label for="num_ext" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Número Exterior</label>
            <input type="text" id="num_ext" wire:model.live="num_ext" placeholder="Ingrese el número exterior" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
            @error('num_ext')
            <div class="text-red-500">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-5">
            <label for="num_int" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Número Interior</label>
            <input type="text" id="num_int" wire:model.live="num_int" placeholder="Ingrese el número interior" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
            @error('num_int')
            <div class="text-red-500">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-5">
            <label for="localidad" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Localidad</label>
            <input type="text" id="localidad" wire:model.live="localidad" placeholder="Ingrese la localidad" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
            @error('localidad')
            <div class="text-red-500">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-5">
            <label for="colonia" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Colonia</label>
            <input type="text" id="colonia" wire:model.live="colonia" placeholder="Ingrese la colonia" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
            @error('colonia')
            <div class="text-red-500">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-5">
            <label for="cp" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Código Postal</label>
            <input type="text" id="cp" wire:model.live="cp" placeholder="Ingrese el código postal" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
            @error('cp')
            <div class="text-red-500">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-5">
            <label for="municipio" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Municipio</label>
            <input type="text" id="municipio" wire:model.live="municipio" placeholder="Ingrese el municipio" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
            @error('municipio')
            <div class="text-red-500">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-5">
            <label for="estado" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Estado</label>
            <input type="text" id="estado" wire:model.live="estado" placeholder="Ingrese el estado" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
            @error('estado')
            <div class="text-red-500">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-5">
            <label for="telefono" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Teléfono</label>
            <input type="text" id="telefono" wire:model.live="telefono" placeholder="Ingrese el teléfono" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
            @error('telefono')
            <div class="text-red-500">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-5">
            <label for="celular" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Celular</label>
            <input type="text" id="celular" wire:model.live="celular" placeholder="Ingrese el celular" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
            @error('celular')
            <div class="text-red-500">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-5">
            <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
            <input type="email" id="email" wire:model.live="email" placeholder="Ingrese el email" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
            @error('email')
            <div class="text-red-500">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-5">
            <label for="parentesco" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Parentesco</label>
            <input type="text" id="parentesco" wire:model.live="parentesco" placeholder="Ingrese el parentesco" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
            @error('parentesco')
            <div class="text-red-500">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-5">
            <label for="ocupacion" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Ocupación</label>
            <input type="text" id="ocupacion" wire:model.live="ocupacion" placeholder="Ingrese la ocupación" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
            @error('ocupacion')
            <div class="text-red-500">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-5">
            <label for="ultimo_grado" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Último grado de estudios</label>
            <input type="text" id="ultimo_grado" wire:model.live="ultimo_grado" placeholder="Ingrese el último grado de estudios del tutor" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
            @error('ultimo_grado')
            <div class="text-red-500">{{ $message }}</div>
            @enderror
        </div>





    </div>

    <div class="flex justify-start items-center mb-5">
        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none
        focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center
        dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
            Actualizar Tutor
            <svg wire:loading style="width: 30px; height: 40px; margin-left: 5px;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 200"><path fill="#FFFFFF" stroke="#FFFFFF" stroke-width="6" transform-origin="center" d="m148 84.7 13.8-8-10-17.3-13.8 8a50 50 0 0 0-27.4-15.9v-16h-20v16A50 50 0 0 0 63 67.4l-13.8-8-10 17.3 13.8 8a50 50 0 0 0 0 31.7l-13.8 8 10 17.3 13.8-8a50 50 0 0 0 27.5 15.9v16h20v-16a50 50 0 0 0 27.4-15.9l13.8 8 10-17.3-13.8-8a50 50 0 0 0 0-31.7Zm-47.5 50.8a35 35 0 1 1 0-70 35 35 0 0 1 0 70Z"><animateTransform type="rotate" attributeName="transform" calcMode="spline" dur="2" values="0;120" keyTimes="0;1" keySplines="0 0 1 1" repeatCount="indefinite"></animateTransform></path></svg>
        </button>
    </div>


  </form>

   </div>
</div>


