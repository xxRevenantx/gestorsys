<div class="w-full mt-15 p-4 bg-white border border-gray-200 rounded-lg shadow-sm sm:p-8 dark:bg-gray-800 dark:border-gray-700">

    <div class="flex items-center justify-between mb-4">

        <div class="bg-indigo-100 border-l-4 border-indigo-500 text-indigo-700 p-4 w-full" role="alert">
            <p class="font-bold"><i class="fas fa-layer-group"></i> Nueva Acción</p>
          </div>

   </div>
   <div class="flow-root my-7">


<form wire:submit.prevent="guardarAccion">

    <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
        <div class="mb-5">
            <label for="accion" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">accion</label>
            <input type="text"  id="accion" wire:model.live="accion" placeholder="Ingrese el accion" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
            @error('accion')
            <div class="text-red-500">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-5">
            <label for="slug" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">slug</label>
            <input type="text" readonly  id="slug" wire:model.live="slug" placeholder="Ingrese el slug" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
            @error('slug')
            <div class="text-red-500">{{ $message }}</div>
            @enderror
        </div>

    </div>

    <div class="flex justify-start items-center mb-5">
        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none
        focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center
        dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
            Agregar Acción
            <svg wire:loading style="width: 30px; height: 40px; margin-left: 5px;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 200"><path fill="#FFFFFF" stroke="#FFFFFF" stroke-width="6" transform-origin="center" d="m148 84.7 13.8-8-10-17.3-13.8 8a50 50 0 0 0-27.4-15.9v-16h-20v16A50 50 0 0 0 63 67.4l-13.8-8-10 17.3 13.8 8a50 50 0 0 0 0 31.7l-13.8 8 10 17.3 13.8-8a50 50 0 0 0 27.5 15.9v16h20v-16a50 50 0 0 0 27.4-15.9l13.8 8 10-17.3-13.8-8a50 50 0 0 0 0-31.7Zm-47.5 50.8a35 35 0 1 1 0-70 35 35 0 0 1 0 70Z"><animateTransform type="rotate" attributeName="transform" calcMode="spline" dur="2" values="0;120" keyTimes="0;1" keySplines="0 0 1 1" repeatCount="indefinite"></animateTransform></path></svg>
        </button>
    </div>


  </form>

   </div>
</div>


