<div>
    <div class="w-fullmx-auto px-4 sm:px-6">

            <div class="md:grid md:grid-cols-3 gap-5">
                <div class="mb-5">
                    <label class="block mb-1 text-sm text-gray-700 uppercase font-bold">Nivel</label>
                    <x-input class="bg-gray-200 w-full" disabled  value="{{$level_nombre}}" />
                </div>
                <div class="mb-5">
                    <label class="block mb-1 text-sm text-gray-700 uppercase font-bold">Grado</label>
                    <select wire:model.live="grade_id"  class="block w-full mt-1 bg-gray-200 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        <option value="">--Selecciona un grado--</option>
                        @foreach ($grados as $grado)
                            <option value="{{$grado->id}}">{{$grado->grado}}°</option>
                        @endforeach
                    </select>

                </div>

                <div class="mb-5">
                    <label class="block mb-1 text-sm text-gray-700 uppercase font-bold">Grupo</label>
                    <select wire:model.live="group_id"  class="block w-full mt-1 bg-gray-200 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        <option value="">--Selecciona un grupo--</option>
                        @foreach ($grupos as $grupo)
                            <option value="{{$grupo->id}}">{{$grupo->grupo}}°</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="mb-5">
                <label
                    class="block mb-1 text-sm text-gray-700 uppercase font-bold "
                    for="termino">Término de Búsqueda
                </label>
                <input
                    wire:model.live="termino"
                    id="termino"
                    type="text"
                    placeholder="Buscar por Nombre, CURP o Matrícula"
                    class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 w-full"
                />
            </div>



    </div>

    <div class="relative flex flex-col w-full h-full overflow-scroll text-gray-700 bg-white shadow-md rounded-lg bg-clip-border">

        <div class="flex items-center justify-between p-4 border-b border-indigo-300 bg-indigo-50">

            <h3 class="text-lg font-semibold text-slate-800">Listado de Alumnos</h3>

            <h3 class="text-lg font-semibold text-slate-800">
               Total:  {{ $contarAlumnos }} {{ $contarAlumnos == 1 ? 'Alumno' : 'Alumnos' }}
            </h3>


          <div class="flex items-center space-x-2" >
            <button  wire:click="$dispatch('refreshAlumnos');" class="text-lg w-10 h-10 text-white bg-indigo-500 rounded-full hover:bg-indigo-700">
              <i class="mdi mdi-sync text-white "></i>
            </button>
          </div>

        </div>


        <!-- LOADER  -->
        <div v wire:loading class="h-screen fixed inset-0 flex items-center justify-center bg-gray-100 bg-opacity-75 z-50">
            <div class="flex justify-center items-center h-full">
            <svg class="h-60 w-60" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 200"><path fill="#4338CA" stroke="#4338CA" stroke-width="2" transform-origin="center" d="m148 84.7 13.8-8-10-17.3-13.8 8a50 50 0 0 0-27.4-15.9v-16h-20v16A50 50 0 0 0 63 67.4l-13.8-8-10 17.3 13.8 8a50 50 0 0 0 0 31.7l-13.8 8 10 17.3 13.8-8a50 50 0 0 0 27.5 15.9v16h20v-16a50 50 0 0 0 27.4-15.9l13.8 8 10-17.3-13.8-8a50 50 0 0 0 0-31.7Zm-47.5 50.8a35 35 0 1 1 0-70 35 35 0 0 1 0 70Z"><animateTransform type="rotate" attributeName="transform" calcMode="spline" dur="2" values="0;120" keyTimes="0;1" keySplines="0 0 1 1" repeatCount="indefinite"></animateTransform></path></svg>
            </div>
            </div>


        <table class="w-full text-left table-auto min-w-max">
          <thead class="bg-slate-100 text-slate-800">
            <tr>
              <th class="p-4 border-b border-slate-300 bg-slate-50">
                <p class="block text-sm font-normal leading-none text-slate-500">
                  #
                </p>
              </th>
              <th class="p-4 border-b border-slate-300 bg-slate-50">
                <p class="block text-sm font-normal leading-none text-slate-500">
                  CURP
                </p>
              </th>
              <th class="p-4 border-b border-slate-300 bg-slate-50">
                <p class="block text-sm font-normal leading-none text-slate-500">
                  Nombre completo
                </p>
              </th>
              <th class="p-4 border-b border-slate-300 bg-slate-50">
                <p class="block text-sm font-normal leading-none text-slate-500">
                 Nivel
                </p>
              </th>
              <th class="p-4 border-b border-slate-300 bg-slate-50">
                <p class="block text-sm font-normal leading-none text-slate-500">
                 Grado
                </p>
              </th>
              <th class="p-4 border-b border-slate-300 bg-slate-50">
                <p class="block text-sm font-normal leading-none text-slate-500">
                 Grupo
                </p>
              </th>
              <th class="p-4 border-b border-slate-300 bg-slate-50">
                <p class="block text-sm font-normal leading-none text-slate-500">
                 Fecha de Nacimiento
                </p>
              </th>
              <th class="p-4 border-b border-slate-300 bg-slate-50">
                <p class="block text-sm font-normal leading-none text-slate-500">
                 Edad
                </p>
              </th>



            </tr>
          </thead>
          <tbody>

            @if ($alumnos->isEmpty())
            <tr class="hover:bg-slate-50">
              <td class="p-4 border-b border-slate-200" colspan="8">
                <h3 class="text-center text-lg font-semibold text-slate-800">No se encontraron alumnos</h3>
                </td>
            </tr>

            @else

            @foreach ($alumnos as $key => $alumno )
            <tr class="hover:bg-slate-50">
              <td class="p-4 border-b border-slate-200">
                <p class="block text-sm text-slate-800">
                    {{ $key+1 }}
                </p>
              </td>
              <td class="p-4 border-b border-slate-200">
                <p class="block text-sm text-slate-800">
                    {{ $alumno->CURP }}
                </p>
              </td>
              <td class="p-4 border-b border-slate-200">
                <p class="block text-sm text-slate-800">
                    {{ $alumno->nombre }} {{ $alumno->apellido_paterno }} {{ $alumno->apellido_materno }}
                </p>
              </td>
              <td class="p-4 border-b border-slate-200">
                <p class="block text-sm text-slate-800">
                    {{ $alumno->level->level }}
                </p>
              </td>
                <td class="p-4 border-b border-slate-200">
                    <p class="block text
                    -sm text-slate-800">
                        {{ $alumno->grade->grado }}°
                    </p>
                </td>
                <td class="p-4 border-b border-slate-200">
                    <p class="block text
                    -sm text-slate-800">
                        {{ $alumno->group->grupo }}
                    </p>
                </td>
                <td class="p-4 border-b border-slate-200">
                    <p class="block text
                    -sm text-slate-800">
                        {{ \Carbon\Carbon::parse($alumno->fecha_nacimiento)->format('d-m-Y') }}
                    </p>
                </td>
                <td class="p-4 border-b border-slate-200">
                    <p class="block text
                    -sm text-slate-800">
                        {{ $alumno->edad }}
                    </p>
                </td>

            </tr>
            @endforeach
            @endif


          </tbody>
        </table>


      </div>
    <div class="my-6">
        {{$alumnos->links()}}
    </div>
</div>
