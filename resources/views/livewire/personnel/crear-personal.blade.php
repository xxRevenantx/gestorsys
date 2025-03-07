<div class="w-full mt-15 p-4 bg-white border border-gray-200 rounded-lg shadow-sm sm:p-8 dark:bg-gray-800 dark:border-gray-700">

    <form  wire:submit.prevent="guardarPersonal">
        @include('admin.partials.loader')
        <div class="grid grid-cols-4 gap-4">
            <div class="mb-4">
                <label for="titulo" class="block text-sm font-medium text-gray-700">Título</label>
                <x-input type="text" class="mt-1 block w-full" wire:model.live="titulo" placeholder="Título"/>
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
        </div>

        <div class="flex justify-start items-center mb-5">
            <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none
            focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center
            dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                Agregar Nivel
                <svg wire:loading style="width: 30px; height: 40px; margin-left: 5px;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 200"><path fill="#FFFFFF" stroke="#FFFFFF" stroke-width="6" transform-origin="center" d="m148 84.7 13.8-8-10-17.3-13.8 8a50 50 0 0 0-27.4-15.9v-16h-20v16A50 50 0 0 0 63 67.4l-13.8-8-10 17.3 13.8 8a50 50 0 0 0 0 31.7l-13.8 8 10 17.3 13.8-8a50 50 0 0 0 27.5 15.9v16h20v-16a50 50 0 0 0 27.4-15.9l13.8 8 10-17.3-13.8-8a50 50 0 0 0 0-31.7Zm-47.5 50.8a35 35 0 1 1 0-70 35 35 0 0 1 0 70Z"><animateTransform type="rotate" attributeName="transform" calcMode="spline" dur="2" values="0;120" keyTimes="0;1" keySplines="0 0 1 1" repeatCount="indefinite"></animateTransform></path></svg>
            </button>
        </div>
    </form>

</div>
