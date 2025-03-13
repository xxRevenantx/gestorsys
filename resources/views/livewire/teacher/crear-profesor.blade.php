<div class="w-full mt-15 p-4 bg-white border border-gray-200 rounded-lg shadow-sm sm:p-8 dark:bg-gray-800 dark:border-gray-700">




    @include('admin.partials.loader')

    <form  wire:submit.prevent="guardarProfesor">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="mb-4">
                <label for="personnel_id" class="block text-sm font-medium text-gray-700">Personal</label>
                <select id="personnel_id" wire:model.live="personnel_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    <option value="">---Seleccione una opción---</option>
                    @foreach($personal as $persona)
                        <option value="{{ $persona->id }}"> {{ strtoupper($persona->titulo) }}. {{ $persona->nombre }} {{ $persona->apellido_paterno }} {{ $persona->apellido_materno }} </option>
                    @endforeach
                </select>
                @error('personnel_id')
                    <span class="text-red-500 ">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="level_id" class="block text-sm font-medium text-gray-700">Nivel</label>
                <select id="level_id" wire:model.live="level_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    <option value="">---Seleccione un nivel---</option>
                    @foreach($niveles as $nivel)
                        <option value="{{ $nivel->id }}">{{ $nivel->level }}</option>
                    @endforeach
                </select>
                @error('level_id')
                    <span class="text-red-500 ">{{ $message }}</span>

                @enderror
            </div>

            <div class="mb-4">
                <label for="grade_id" class="block text-sm font-medium text-gray-700">Grados</label>
                <select id="grade_id" wire:model.live="grade_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    <option value="">---Seleccione una grado---</option>
                    @foreach($grados as $grado)
                        <option value="{{ $grado->id }}">{{ $grado->grado }}° GRADO</option>
                    @endforeach
                </select>
                @error('grade_id')
                    <span class="text-red-500 ">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="group_id" class="block text-sm font-medium text-gray-700">Grupos</label>
                <select id="group_id" wire:model.live="group_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    <option value="">---Seleccione un grupo---</option>
                    @foreach($grupos as $grupo)
                        <option value="{{ $grupo->id }}">{{ $grupo->grupo }}</option>
                    @endforeach
                </select>
                @error('group_id')
                    <span class="text-red-500 ">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="funcion" class="block text-sm font-medium text-gray-700">Funcion</label>
                <input type="text" id="funcion" wire:model.live="funcion" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                @error('funcion')
                    <span class="text-red-500 ">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="director" class="block text-sm font-medium text-gray-700">Director</label>
                <select id="director" wire:model.live="director" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                    <option value="">---Seleccione una opción---</option>
                    <option value="1">SI</option>
                    <option value="0">NO</option>
                </select>
                @error('director')
                    <span class="text-red-500 ">{{ $message }}</span>

                @enderror
            </div>
        </div>

        <div class="flex justify-start items-center mb-5">
            <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none
            focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center
            dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                Asignar
                <svg wire:loading style="width: 30px; height: 40px; margin-left: 5px;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 200"><path fill="#FFFFFF" stroke="#FFFFFF" stroke-width="6" transform-origin="center" d="m148 84.7 13.8-8-10-17.3-13.8 8a50 50 0 0 0-27.4-15.9v-16h-20v16A50 50 0 0 0 63 67.4l-13.8-8-10 17.3 13.8 8a50 50 0 0 0 0 31.7l-13.8 8 10 17.3 13.8-8a50 50 0 0 0 27.5 15.9v16h20v-16a50 50 0 0 0 27.4-15.9l13.8 8 10-17.3-13.8-8a50 50 0 0 0 0-31.7Zm-47.5 50.8a35 35 0 1 1 0-70 35 35 0 0 1 0 70Z"><animateTransform type="rotate" attributeName="transform" calcMode="spline" dur="2" values="0;120" keyTimes="0;1" keySplines="0 0 1 1" repeatCount="indefinite"></animateTransform></path></svg>
            </button>
        </div>
    </form>
</div>
