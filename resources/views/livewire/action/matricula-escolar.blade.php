<div>
    <div class="w-fullmx-auto px-4 sm:px-6">

        {{$grados}}
            <div class="md:grid md:grid-cols-3 gap-5">
                <div class="mb-5">
                    <label class="block mb-1 text-sm text-gray-700 uppercase font-bold">Nivel</label>
                    <x-input class="bg-gray-200" disabled  value="{{$level_nombre}}" />
                </div>
                <div class="mb-5">
                    <label class="block mb-1 text-sm text-gray-700 uppercase font-bold">Grado</label>
                    <select name="" id="">
                        <option value="">--Selecciona un grado--</option>
                        @foreach ($grados as $grado)
                            <option value="{{$grado->id}}">{{$grado->grado_numero}}°</option>
                        @endforeach
                    </select>

                </div>

                <div class="mb-5">
                    <label class="block mb-1 text-sm text-gray-700 uppercase font-bold">Salario Mensual</label>

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
                        {{ $alumno->grade->grado_numero }}°
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



          </tbody>
        </table>


      </div>
    <div class="my-6">
        {{$alumnos->links()}}
    </div>
</div>
