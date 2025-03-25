<div>
@include('admin.partials.loader')


<section class=" py-1">
<div class="w-full lg:w-12/12 px-4 mx-auto mt-6">
  <div class="relative flex flex-col min-w-0 break-words w-full mb-6 rounded-lg border-0">
    <div class="rounded-t bg-white mb-0 px-6 py-6">
      <div class="text-center flex justify-between">
        <h6 class="text-blueGray-700 text-xl font-bold">
          AGREGAR MATERIAS
        </h6>

      </div>
    </div>
    <div class="flex-auto py-10 pt-0">
        <form wire:submit.prevent="guardarMateria">
        <div class="flex flex-wrap">
          <div class="w-full lg:w-3/12 px-4">
            <div class="relative w-full mb-3">
              <label class="block uppercase text-blueGray-600 text-xs font-bold mb-2" htmlfor="grid-password">
                Materia
              </label>
              <x-input type="text" class="w-full" wire:model.live='materia' />
              @error('materia')
                <span class="text-red-500">{{ $message }}</span>
              @enderror
            </div>
          </div>
          <div class="w-full lg:w-3/12 px-4">
            <div class="relative w-full mb-3">
              <label class="block uppercase text-blueGray-600 text-xs font-bold mb-2" htmlfor="grid-password">
                SLUG
              </label>
              <x-input readonly type="text" class="w-full bg-gray-100" wire:model.live='slug' />
              @error('slug')
                <span class="text-red-500">{{ $message }}</span>
              @enderror
            </div>
          </div>
          <div class="w-full lg:w-3/12 px-4">
            <div class="relative w-full mb-3">
              <label class="block uppercase text-blueGray-600 text-xs font-bold mb-2" htmlfor="grid-password">
                Clave
              </label>
              <x-input wire:model.live='clave' type="text" class="w-full" />
                @error('clave')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>
          </div>
          <div class="w-full lg:w-3/12 px-4">
            <div class="relative w-full mb-3">
              <label class="block uppercase text-blueGray-600 text-xs font-bold mb-2" htmlfor="grid-password">
                Campo Formativo
              </label>
              <select wire:model.live='campo_formativo_id' class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" wire:model.live='campo_formativo'>
                <option value="">--Seleccione una opción--</option>
                @foreach($campos as $campo)
                  <option value="{{ $campo->id }}">{{ $campo->nombre }}</option>
                @endforeach
              </select>
              @error('campo_formativo_id')
                <span class="text-red-500">{{ $message }}</span>
              @enderror
            </div>
          </div>
          <div class="w-full lg:w-3/12 px-4">
            <div class="relative w-full mb-3">
              <label class="block uppercase text-blueGray-600 text-xs font-bold mb-2" htmlfor="grid-password">
                Grupo
              </label>
              <select wire:model.live='group_id' class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" wire:model.live='campo_formativo'>
                <option value="">--Seleccione un grupo--</option>
                @foreach($grupos as $grupo)
                  <option value="{{ $grupo->id }}">{{ $grupo->grupo }}</option>
                @endforeach
              </select>
              @error('group_id')
                <span class="text-red-500">{{ $message }}</span>
              @enderror
            </div>
          </div>
          <div class="w-full lg:w-3/12 px-4">
            <div class="relative w-full mb-3">
              <label class="block uppercase text-blueGray-600 text-xs font-bold mb-2" htmlfor="grid-password">
                Profesor
              </label>
              <select wire:model.live='teacher_id' class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" wire:model.live='campo_formativo'>
                <option value="">--Seleccione un profesor--</option>
                @foreach($profesores as $profesor)
                  <option value="{{ $profesor->id }}">{{ $profesor->personnel->nombre }} {{$profesor->personnel->apellido_paterno}} {{$profesor->personnel->apellido_materno}} </option>
                @endforeach
              </select>
              @error('teacher_id')
                <span class="text-red-500">{{ $message }}</span>
              @enderror
            </div>
          </div>
          <div class="w-full lg:w-3/12 px-4">
            <div class="relative w-full mb-3">
              <label class="block uppercase text-blueGray-600 text-xs font-bold mb-2" htmlfor="grid-password">
                Calificación
              </label>
              <select wire:model.live='calificacion' class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                <option value="">--Seleccione una opción--</option>
                <option value="1">Sí</option>
                <option value="0">No</option>
              </select>
                @error('calificacion')
                    <span class="text-red-500">{{ $message }}</span>
                @enderror
            </div>
          </div>
        </div>

        <div class="w-full lg:w-3/12 px-4">
            <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none
            focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center
            dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                Agregar materia
                <svg wire:loading style="width: 30px; height: 40px; margin-left: 5px;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 200"><path fill="#FFFFFF" stroke="#FFFFFF" stroke-width="6" transform-origin="center" d="m148 84.7 13.8-8-10-17.3-13.8 8a50 50 0 0 0-27.4-15.9v-16h-20v16A50 50 0 0 0 63 67.4l-13.8-8-10 17.3 13.8 8a50 50 0 0 0 0 31.7l-13.8 8 10 17.3 13.8-8a50 50 0 0 0 27.5 15.9v16h20v-16a50 50 0 0 0 27.4-15.9l13.8 8 10-17.3-13.8-8a50 50 0 0 0 0-31.7Zm-47.5 50.8a35 35 0 1 1 0-70 35 35 0 0 1 0 70Z"><animateTransform type="rotate" attributeName="transform" calcMode="spline" dur="2" values="0;120" keyTimes="0;1" keySplines="0 0 1 1" repeatCount="indefinite"></animateTransform></path></svg>
            </button>
        </div>



      </form>
    </div>
  </div>

</div>
</section>



</div>
