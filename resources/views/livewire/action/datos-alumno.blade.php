<div>
    <!-- component -->
<!-- This is an example component -->
<div class="w-full mx-auto bg-white rounded">

    <div class="mb-5">
        <label
            class="block mb-1 text-sm text-gray-700 uppercase font-bold "
            for="termino">Buscar por nombre, matrícula o CURP alumnos:
        </label>
        <input
            wire:model.live="termino"
            id="termino"
            type="text"
            placeholder="Buscar por nombre, matrícula o CURP alumnos:"
            class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 w-full"
        />
    </div>

	<div id="accordion-collapse" data-accordion="collapse">
		<h2 id="accordion-collapse-heading-1" class="font-bold">
			<button type="button" class="flex items-center focus:ring-4 focus:ring-indigo-200 dark:focus:ring-indigo-800 justify-between p-5 w-full font-medium text-left border border-indigo-200 dark:border-indigo-700 border-b-0 text-indigo-900 dark:text-white bg-indigo-100 dark:bg-indigo-800 hover:bg-indigo-100 dark:hover:bg-indigo-800 rounded-t-xl" data-accordion-target="#accordion-collapse-body-1" aria-expanded="true" aria-controls="accordion-collapse-body-1">
      <span class="font-bold">Datos del alumnos</span>
      <svg data-accordion-icon class="w-6 h-6 shrink-0 rotate-180" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
    </button>
		</h2>

		<div id="accordion-collapse-body-1" aria-labelledby="accordion-collapse-heading-1">
			<div class="p-5 border border-gray-200 dark:border-gray-700 dark:bg-gray-900 border-b-0">

                <div class="w-full mx-auto bg-white p-6 rounded-lg shadow-lg">
                    <form class="grid grid-cols-2 gap-4">
                        <!-- Primera columna -->
                        <div>
                            <label class="block text-gray-700">Matrícula:</label>
                            <input type="text" class="w-full border-gray-300 rounded-md shadow-sm p-2">
                        </div>
                        <div>
                            <label class="block text-gray-700">Primer Apellido:</label>
                            <input type="text" class="w-full border-gray-300 rounded-md shadow-sm p-2">
                        </div>
                        <div>
                            <label class="block text-gray-700">Segundo Apellido:</label>
                            <input type="text" class="w-full border-gray-300 rounded-md shadow-sm p-2">
                        </div>
                        <div>
                            <label class="block text-gray-700">Nombres:</label>
                            <input type="text" class="w-full border-gray-300 rounded-md shadow-sm p-2">
                        </div>
                        <div>
                            <label class="block text-gray-700">CURP:</label>
                            <input type="text" class="w-full border-gray-300 rounded-md shadow-sm p-2">
                        </div>
                        <div>
                            <label class="block text-gray-700">Género:</label>
                            <select class="w-full border-gray-300 rounded-md shadow-sm p-2">
                                <option>--Seleccione--</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-gray-700">Fecha de Nacimiento:</label>
                            <input type="date" class="w-full border-gray-300 rounded-md shadow-sm p-2">
                        </div>
                        <div>
                            <label class="block text-gray-700">País de Nacimiento:</label>
                            <input type="text" class="w-full border-gray-300 rounded-md shadow-sm p-2" value="NO ASIGNADO" disabled>
                        </div>
                        <div>
                            <label class="block text-gray-700">Estado de Nacimiento:</label>
                            <select class="w-full border-gray-300 rounded-md shadow-sm p-2">
                                <option>--Seleccione--</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-gray-700">Municipio de Nacimiento:</label>
                            <select class="w-full border-gray-300 rounded-md shadow-sm p-2">
                                <option>--Seleccione--</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-gray-700">Estado Donde Vive:</label>
                            <select class="w-full border-gray-300 rounded-md shadow-sm p-2">
                                <option>--Seleccione--</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-gray-700">Municipio Donde Vive:</label>
                            <select class="w-full border-gray-300 rounded-md shadow-sm p-2">
                                <option>--Seleccione--</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-gray-700">Colonia:</label>
                            <select class="w-full border-gray-300 rounded-md shadow-sm p-2">
                                <option>--Seleccione--</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-gray-700">Calle:</label>
                            <input type="text" class="w-full border-gray-300 rounded-md shadow-sm p-2">
                        </div>
                        <div>
                            <label class="block text-gray-700">Número:</label>
                            <input type="text" class="w-full border-gray-300 rounded-md shadow-sm p-2">
                        </div>
                        <div>
                            <label class="block text-gray-700">Código Postal:</label>
                            <input type="text" class="w-full border-gray-300 rounded-md shadow-sm p-2">
                        </div>
                    </form>
                </div>

			</div>
		</div>

	</div>

</div>

</div>
