<div class="rounded-lg shadow-lg px-4 py-4">

    {{-- <div  class="relative items-center block max-w-sm p-6 bg-white border border-gray-100 rounded-lg shadow-md dark:bg-gray-800 dark:border-gray-800 dark:hover:bg-gray-700">
        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white opacity-20">Noteworthy technology acquisitions 2021</h5>
        <p class="font-normal text-gray-700 dark:text-gray-400 opacity-20">Here are the biggest enterprise technology acquisitions of 2021 so far, in reverse chronological order.</p>

    </div> --}}


    <div class="w-full mx-auto px-4 sm:px-6 ">

            <div class="md:grid md:grid-cols-4 gap-5">
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
                <div class="mb-5">
                    <label class="block mb-1 text-sm text-gray-700 uppercase font-bold">Género</label>
                    <select wire:model.live="genero"  class="block w-full mt-1 bg-gray-200 border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        <option value="">--Selecciona el Género--</option>
                        <option value="H">Hombre</option>
                        <option value="M">Mujer</option>
                    </select>
                </div>
            </div>

            <div class="mb-5">

                        <label
                            class="block mb-1 text-sm text-gray-700 uppercase font-bold "
                            for="termino">Término de Búsqueda
                        </label>

                        <div class="flex justify-between items-center">
                            <input
                            wire:model.live="termino"
                            id="termino"
                            type="text"
                            placeholder="Buscar por Nombre, CURP o Matrícula"
                            class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 w-full"
                        />


                </div>



            </div>



    </div>

    <div class="relative flex flex-col w-full h-full overflow-scroll text-gray-700 bg-white shadow-md rounded-lg bg-clip-border">
            <div class="flex justify-end p-4">
                <a target="_blank" href="{{ route('admin.lista.alumnos', $level_id) }}" class="flex items-center px-4 py-2 text-white bg-red-500 rounded-lg hover:bg-red-700">
                    <i class="mdi mdi-file-pdf-outline mr-2"></i> Descargar lista
                </a>
            </div>




        <div class="flex items-center justify-between p-4 border-b border-indigo-300 bg-indigo-50">

            <h3 class="text-lg font-semibold text-slate-800">Listado de Alumnos</h3>

            <h3 class="text-lg font-semibold text-slate-800">
               Total:  {{ $totalAlumnos }} {{ $totalAlumnos == 1 ? 'Alumno' : 'Alumnos' }} |
                <span class="text-indigo-700"> Alumnos filtrados: {{ $contarAlumnos }} {{ $contarAlumnos == 1 ? 'Alumno' : 'Alumnos' }}</span>
            </h3>


          <div class="flex items-center space-x-2" >
            <button  wire:click="$dispatch('refreshAlumnos');" class="text-lg w-10 h-10 text-white bg-indigo-500 rounded-full hover:bg-indigo-700">
              <i class="mdi mdi-sync text-white "></i>
            </button>
          </div>

        </div>


        <!-- LOADER  -->
        @include('admin.partials.loader')


        <table class="w-full text-left table-auto min-w-max">
          <thead class="bg-slate-100 text-slate-800">
            <tr>
                @foreach ($headers as $header)
                <th class="p-4 border
                -b border-slate-300 bg-slate-50">
                    <p class="block text
                    -sm font-normal leading-none text-slate-500">
                        {{ $header }}
                    </p>
                </th>
                @endforeach

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
                    {{ $alumno->apellido_paterno }} {{ $alumno->apellido_materno }} {{ $alumno->nombre }}
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
                        {{ $alumno->genero }}
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
