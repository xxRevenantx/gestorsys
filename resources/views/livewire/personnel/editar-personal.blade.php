<div class="w-full mt-15 p-4 bg-white border border-gray-200 rounded-lg shadow-sm sm:p-8 dark:bg-gray-800 dark:border-gray-700">


    <div class="bg-blue-100 border-t border-b border-blue-500 text-blue-700 px-4 py-2 mb-4" role="alert">
        <p class="font-bold">Modificar personal</p>
        <p class="text-sm"> {{ strtoupper($titulo) }}. {{$nombre}} {{$apellido_paterno}} {{$apellido_materno}} | CURP: {{$CURP}} | RFC: {{$RFC}} </p>
    </div>

    <form  wire:submit.prevent="actualizarPersonal">
        @include('admin.partials.loader')
        <div class="grid grid-cols-4 gap-4">
            <div class="mb-4">
                <label for="titulo" class="block text-sm font-medium text-gray-700">Título</label>
                <select wire:model.live="titulo" class="w-full p-2 border rounded-md text-gray-700 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    <option value="">---Selecciona un título---</option>
                    <option value="dr">Dr. - Doctor</option>
                    <option value="dra">Dra. - Doctora</option>
                    <option value="mtro">Mtro. - Maestro</option>
                    <option value="mtra">Mtra. - Maestra</option>
                    <option value="profr">Profr. - Profesor</option>
                    <option value="profa">Profa. - Profesora</option>
                    <option value="ing">Ing. - Ingeniero</option>
                    <option value="inga">Inga. - Ingeniera</option>
                    <option value="lic">Lic. - Licenciado</option>
                    <option value="lica">Lica. - Licenciada</option>
                    <option value="arq">Arq. - Arquitecto</option>
                    <option value="arqa">Arqa. - Arquitecta</option>
                    <option value="c.p.">C.P. - Contador Público</option>
                    <option value="lcda">Lcda. - Licenciada</option>
                    <option value="qfb">Q.F.B. - Químico Farmacéutico Biólogo</option>
                </select>
                @error('titulo')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-4">
                <label for="nombre" class="block text-sm font-medium text-gray-700">Nombre</label>
                <x-input type="text" class="mt-1 block w-full" wire:model.live="nombre" placeholder="Nombre" />
                @error('nombre')
                    <span class="text-red-500">{{ $message }}</span>

                @enderror
            </div>
            <div class="mb-4">
                <label for="apellido_paterno" class="block text-sm font-medium text-gray-700">Apellido Paterno</label>
                <x-input type="text" class="mt-1 block w-full" wire:model.live="apellido_paterno" placeholder="Apellido paterno" />
                @error('apellido_paterno')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-4">
                <label for="apellido_materno" class="block text-sm font-medium text-gray-700">Apellido Materno</label>
                <x-input type="text" class="mt-1 block w-full" wire:model.live="apellido_materno" placeholder="Apellido materno"/>
                @error('apellido_materno')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-4">
                <label for="CURP" class="block text-sm font-medium text-gray-700">CURP</label>
                <x-input type="text" class="mt-1 block w-full" wire:model.live="CURP" placeholder="CURP"/>
                @error('CURP')
                    <span class="text-red-500">{{ $message }}</span>

                @enderror
            </div>
            <div class="mb-4">
                <label for="RFC" class="block text-sm font-medium text-gray-700">RFC</label>
                <x-input type="text" class="mt-1 block w-full" wire:model.live="RFC" placeholder="RFC"/>
                @error('RFC')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <x-input type="email" class="mt-1 block w-full" wire:model.live="email" placeholder="Email"/>
                @error('email')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-4">
                <label for="telefono" class="block text-sm font-medium text-gray-700">Teléfono</label>
                <x-input type="text" class="mt-1 block w-full" wire:model.live="telefono" placeholder="Teléfono"/>
                @error('telefono')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror

            </div>
            <div class="mb-4">
                <label for="direccion" class="block text-sm font-medium text-gray-700">Dirección</label>
                <x-input type="text" class="mt-1 block w-full" wire:model.live="direccion" placeholder="Dirección"/>
                @error('direccion')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-4">
                <label for="perfil" class="block text-sm font-medium text-gray-700">Perfil</label>
                <x-input type="text" class="mt-1 block w-full" wire:model.live="perfil" placeholder="Perfil"/>
                @error('perfil')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-4">
                <label for="genero" class="block text-sm font-medium text-gray-700">Género</label>
                <select wire:model.live="genero" class="w-full p-2 border rounded-md text-gray-700 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    <option value="">---Seleccione género---</option>
                    <option value="H">Masculino</option>
                    <option value="M">Femenino</option>
                    <option value="otro">Otro</option>
                </select>
                @error('genero')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="status" class="block text-sm font-medium text-gray-700">Status</label>

                    <label class="inline-flex items-center cursor-pointer mt-3">
                        <input type="checkbox" class="sr-only peer" @if ($status) checked @endif wire:model.live="status">
                        <div class="relative w-11 h-6 bg-gray-200 rounded-full peer peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600 dark:peer-checked:bg-blue-600"></div>
                        <span class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">
                            @if ($status)
                            Activo
                        @else
                            Inactivo

                        @endif
                        </span>
                    </label>


            </div>
        </div>

        <div class="flex justify-start items-center mb-5">
            <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none
            focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center
            dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
               Actualizar
                <svg wire:loading style="width: 30px; height: 40px; margin-left: 5px;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 200"><path fill="#FFFFFF" stroke="#FFFFFF" stroke-width="6" transform-origin="center" d="m148 84.7 13.8-8-10-17.3-13.8 8a50 50 0 0 0-27.4-15.9v-16h-20v16A50 50 0 0 0 63 67.4l-13.8-8-10 17.3 13.8 8a50 50 0 0 0 0 31.7l-13.8 8 10 17.3 13.8-8a50 50 0 0 0 27.5 15.9v16h20v-16a50 50 0 0 0 27.4-15.9l13.8 8 10-17.3-13.8-8a50 50 0 0 0 0-31.7Zm-47.5 50.8a35 35 0 1 1 0-70 35 35 0 0 1 0 70Z"><animateTransform type="rotate" attributeName="transform" calcMode="spline" dur="2" values="0;120" keyTimes="0;1" keySplines="0 0 1 1" repeatCount="indefinite"></animateTransform></path></svg>
            </button>
        </div>
    </form>

</div>
