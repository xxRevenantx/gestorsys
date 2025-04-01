<div>


    @include('admin.partials.loader')

    <nav
        class="flex items-center justify-center flex-wrap bg-white py-2 mb-4 lg:px-12 shadow border-solid border-t-2 border-blue-700">
        <div class="menu w-full lg:block lg:flex lg:items-center lg:w-auto lg:px-3 px-8 justify-center">
            <div class="text-md font-bold text-blue-700 lg: justify-center">
                @foreach ($grados as $grado)
                    <a href="{{ route('admin.level.grados', ["nivel" => $level, "action" => $action, "grado" => $grado->grado]) }}"
                       class=" @if ($grado->grado == $grade->grado) text-white bg-blue-700 @else text-blue-700 @endif block mt-4 lg:inline-block lg:mt-0   hover:text-white px-4 py-2 rounded hover:bg-blue-700 mr-2">
                        {{ $grado->grado }}° GRADO
                    </a>
                @endforeach
            </div>
        </div>

    </nav>


    <form wire:submit.prevent="guardarHora" class="mb-4">
        <div class="flex items-center">
            <label for="hora" class="mr-2 font-bold text-gray-700">Agregar Hora:</label>
            <input type="text" id="hora" wire:model.live="hora"
                   class="form-control border-gray-300 rounded-md px-4 py-2 text-sm"
                   placeholder="08:00am - 09:00am">

            <select wire:model.live="group_id" class="form-control w-1/2 border-gray-300 rounded-md">
                <option value="">----Seleccione una materia-- el grupo--</option>
                @foreach($grupos as $grupo)
                    <option value="{{ $grupo->id }}">{{ $grupo->grupo }}</option>
                @endforeach
            </select>

            <button type="submit"
                    class="ml-2 bg-indigo-700 text-white px-4 py-2 rounded hover:bg-indigo-800">
                Guardar
            </button>
        </div>
        <div class="flex items-center">
            @error('hora')
            <span class="text-red-500">* {{ $message }}</span>
            @enderror
            <br>
            @error('group_id')
            <span class="text-red-500">* {{ $message }}</span>
            @enderror
        </div>

    </form>



    <div id="accordion-open" data-accordion="open">
        @foreach ($grupos as $grupo )
        <h2 id="accordion-open-heading-{{$grupo->id}}">
          <button type="button" class="flex items-center justify-between w-full p-5 font-medium rtl:text-right text-gray-500 border border-b-0 border-gray-200 rounded-t-xl focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-800 dark:border-gray-700 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 gap-3" data-accordion-target="#accordion-open-body-1" aria-expanded="true" aria-controls="accordion-open-body-1">
            <span class="flex items-center"><svg class="w-5 h-5 me-2 shrink-0" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2eee/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zm0 8a1 1 0 100-2 1 1 0 eee 2z" clip-rule="evenodd"></path></svg>
                GRUPO: {{ $grupo->grupo }}
            </span>
            <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2eee/svg" fill="none" viewBox="0 0 10 6">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5"/>
            </svg>
          </button>
        </h2>

        <div id="accordion-open-body-{{$grupo->id}}"  aria-labelledby="accordion-open-heading-{{$grupo->id}}">
          <div class="p-5 border border-b-0 border-gray-200 dark:border-gray-700 dark:bg-gray-900">
            <a target="_blank" href="{{route('admin.horario', ["level" => $level_id, "grade" => $grade, "group" => $grupo->id] )}}" class="inline-block px-4 py-2 bg-blue-500 text-white font-bold rounded hover:bg-blue-600">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                </svg>
                Descargar horario
            </a>




            <table class="table-auto w-full border-collapse border border-gray-300 mt-4">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="border border-gray-300 px-4 py-2">Hora</th>
                        <th class="border border-gray-300 px-4 py-2">Lunes</th>
                        <th class="border border-gray-300 px-4 py-2">Martes</th>
                        <th class="border border-gray-300 px-4 py-2">Miércoles</th>
                        <th class="border border-gray-300 px-4 py-2">Jueves</th>
                        <th class="border border-gray-300 px-4 py-2">Viernes</th>
                    </tr>
                </thead>
                <tbody>

                    @php
                        $materiasGrupo = $materias->filter(function($materia) use ($grupo) { // Filtrar materias por grupo
                            return $materia->group_id == $grupo->id;
                        });
                    @endphp

                    @foreach($horarios as $horario)
                    @if($horario['group_id'] == $grupo->id)



                        <tr class="hover:bg-gray-50">
                            <td class="border border-gray-300 px-4 py-2 text-center">
                                <input type="text" wire:model="horarios.{{ $horario['id'] }}.hora"
                                    class="form-control border-gray-300 rounded-md px-3 py-3 text-sm text-center"
                                    wire:change="actualizarHora({{ $horario['id'] }}, $event.target.value)">
                                @error('horarios.' . $horario['id'] . '.hora')
                                    <span class="text-red-500">{{ $message }}</span>
                                @enderror
                            </td>

                            <td class="border border-gray-300 px-4 py-2" style="background-color:  {{ $horarios[$horario['id']]['lunes'] ? ($materias->firstWhere('id', $horarios[$horario['id']]['lunes'])->teacher->color ?? '#eee') : '#eee' }} ">
                                <select wire:model="horarios.{{ $horario['id'] }}.lunes"
                                    class="form-control w-full border-gray-300 rounded-md"
                                    wire:change="actualizarMateria({{ $horario['id'] }}, 'lunes', $event.target.value)">
                                    <option value="">--Seleccione una materia--</option>
                                    @foreach($materiasGrupo as $materia)
                                        <option value="{{ $materia['id'] }}">
                                            {{ $materia->materia }}
                                        </option>
                                    @endforeach
                                </select>
                                <div class="text-sm text-gray-600 mt-1">
                                    Profesor: {{ $horarios[$horario['id']]['lunes'] ? ($materias->firstWhere('id', $horarios[$horario['id']]['lunes'])->teacher->personnel->nombre ?? 'Sin Profesor') . ' ' . ($materias->firstWhere('id', $horarios[$horario['id']]['lunes'])->teacher->personnel->apellido_paterno ?? '') . ' ' . ($materias->firstWhere('id', $horarios[$horario['id']]['lunes'])->teacher->personnel->apellido_materno ?? '') : 'Sin Profesor' }}
                                </div>
                            </td>

                            <td class="border border-gray-300 px-4 py-2" style="background-color:  {{ $horarios[$horario['id']]['martes'] ? ($materias->firstWhere('id', $horarios[$horario['id']]['martes'])->teacher->color ?? '#eee') : '#eee' }} ">
                                <select wire:model="horarios.{{ $horario['id'] }}.martes"
                                    class="form-control w-full border-gray-300 rounded-md"
                                    wire:change="actualizarMateria({{ $horario['id'] }}, 'martes', $event.target.value)">
                                    <option value="">--Seleccione una materia--</option>
                                    @foreach($materiasGrupo as $materia)
                                        <option value="{{ $materia['id'] }}">{{ $materia->materia }}</option>
                                    @endforeach
                                </select>
                                <div class="text-sm text-gray-600 mt-1">
                                    Profesor: {{ $horarios[$horario['id']]['martes'] ? ($materias->firstWhere('id', $horarios[$horario['id']]['martes'])->teacher->personnel->nombre ?? 'Sin Profesor') . ' ' . ($materias->firstWhere('id', $horarios[$horario['id']]['martes'])->teacher->personnel->apellido_paterno ?? '') . ' ' . ($materias->firstWhere('id', $horarios[$horario['id']]['martes'])->teacher->personnel->apellido_materno ?? '') : 'Sin Profesor' }}
                                </div>
                            </td>

                            <td class="border border-gray-300 px-4 py-2" style="background-color: {{ $horarios[$horario['id']]['miercoles'] ? ($materias->firstWhere('id', $horarios[$horario['id']]['miercoles'])->teacher->color ?? '#eee') : '#eee' }} ">
                                <select wire:model="horarios.{{ $horario['id'] }}.miercoles"
                                    class="form-control w-full border-gray-300 rounded-md"
                                    wire:change="actualizarMateria({{ $horario['id'] }}, 'miercoles', $event.target.value)">
                                    <option value="">--Seleccione una materia--</option>
                                    @foreach($materiasGrupo as $materia)
                                        <option value="{{ $materia['id'] }}">{{ $materia->materia }}</option>
                                    @endforeach
                                </select>
                                <div class="text-sm text-gray-600 mt-1">
                                    Profesor: {{ $horarios[$horario['id']]['miercoles'] ? ($materias->firstWhere('id', $horarios[$horario['id']]['miercoles'])->teacher->personnel->nombre ?? 'Sin Profesor') . ' ' . ($materias->firstWhere('id', $horarios[$horario['id']]['miercoles'])->teacher->personnel->apellido_paterno ?? '') . ' ' . ($materias->firstWhere('id', $horarios[$horario['id']]['miercoles'])->teacher->personnel->apellido_materno ?? '') : 'Sin Profesor' }}
                                </div>
                            </td>

                            <td class="border border-gray-300 px-4 py-2" style="background-color: {{ $horarios[$horario['id']]['jueves'] ? ($materias->firstWhere('id', $horarios[$horario['id']]['jueves'])->teacher->color ?? '#eee') : '#eee' }} ">
                                <select wire:model="horarios.{{ $horario['id'] }}.jueves"
                                    class="form-control w-full border-gray-300 rounded-md"
                                    wire:change="actualizarMateria({{ $horario['id'] }}, 'jueves', $event.target.value)">
                                    <option value="">--Seleccione una materia--</option>
                                    @foreach($materiasGrupo as $materia)
                                        <option value="{{ $materia['id'] }}">{{ $materia->materia }}</option>
                                    @endforeach
                                </select>
                                <div class="text-sm text-gray-600 mt-1">
                                    Profesor: {{ $horarios[$horario['id']]['jueves'] ? ($materias->firstWhere('id', $horarios[$horario['id']]['jueves'])->teacher->personnel->nombre ?? 'Sin Profesor') . ' ' . ($materias->firstWhere('id', $horarios[$horario['id']]['jueves'])->teacher->personnel->apellido_paterno ?? '') . ' ' . ($materias->firstWhere('id', $horarios[$horario['id']]['jueves'])->teacher->personnel->apellido_materno ?? '') : 'Sin Profesor' }}
                                </div>
                            </td>

                            <td class="border border-gray-300 px-4 py-2" style="background-color: {{ $horarios[$horario['id']]['viernes'] ? ($materias->firstWhere('id', $horarios[$horario['id']]['viernes'])->teacher->color ?? '#eee') : '#eee' }} ">
                                <select wire:model="horarios.{{ $horario['id'] }}.viernes"
                                    class="form-control w-full border-gray-300 rounded-md"
                                    wire:change="actualizarMateria({{ $horario['id'] }}, 'viernes', $event.target.value)">
                                    <option value="">--Seleccione una materia--</option>
                                    @foreach($materiasGrupo as $materia)
                                        <option value="{{ $materia['id'] }}">{{ $materia->materia }}</option>
                                    @endforeach
                                </select>
                                <div class="text-sm text-gray-600 mt-1">
                                    Profesor: {{ $horarios[$horario['id']]['viernes'] ? ($materias->firstWhere('id', $horarios[$horario['id']]['viernes'])->teacher->personnel->nombre ?? 'Sin Profesor') . ' ' . ($materias->firstWhere('id', $horarios[$horario['id']]['viernes'])->teacher->personnel->apellido_paterno ?? '') . ' ' . ($materias->firstWhere('id', $horarios[$horario['id']]['viernes'])->teacher->personnel->apellido_materno ?? '') : 'Sin Profesor' }}
                                </div>
                            </td>
                        </tr>
                    @endif
                @endforeach

                </tbody>
            </table>



            <div class="mt-4">
                <h3 class="text-lg font-bold text-gray-700">Horas Totales del Profesor</h3>


                @php
                $profesores = $materiasGrupo->map(function($materia) {
                    return $materia->teacher->personnel ?? null;
                })->unique()->filter();
            @endphp

            <div class="overflow-x-auto">
                <table class="table-auto w-full border-collapse border border-gray-300 mt-4">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="border border-gray-300 px-4 py-2">#</th>
                        <th class="border border-gray-300 px-4 py-2">Profesor</th>
                        @foreach($materiasGrupo as $materia)
                            <th class="border border-gray-300 px-4 py-2">{{ $materia->materia }}</th>
                        @endforeach
                        <th class="border border-gray-300 px-4 py-2 bg-yellow-100">Total</th>
                    </tr>
                </thead
                <tbody>
                    @foreach($profesores as $key => $profesor)

                        @php
                            $totalHorasProfesor = 0;
                        @endphp

                        <tr class="hover:bg-gray-400">
                            <td class="border border-gray-300 px-4 py-2 text-center font-bold">
                                {{ $key + 1 }}
                            </td>
                            <td class="border border-gray-300 px-4 py-2 text-center font-bold text-sm">
                                {{ $profesor->nombre }} {{ $profesor->apellido_paterno }} {{ $profesor->apellido_materno }}
                            </td>

                            @foreach($materiasGrupo as $materia)

                            @php
                            $esProfesorDeLaMateria = ($materia->teacher->personnel->id ?? null) === $profesor->id;
                            $horasAsignadas = 0;

                            if ($esProfesorDeLaMateria) {
                                $horasAsignadas = collect($horarios)->reduce(function($carry, $horario) use ($materia, $profesor, $materias, $grupo) {
                                    // Solo horarios del grupo actual
                                    if ($horario['group_id'] != $grupo->id) {
                                        return $carry;
                                    }

                                    $dias = ['lunes', 'martes', 'miercoles', 'jueves', 'viernes'];
                                    foreach ($dias as $dia) {
                                        $materiaId = $horario[$dia] ?? null;
                                        $materiaAsignada = $materias->firstWhere('id', $materiaId);

                                        // Contar solo si el profesor es el mismo y el nombre de la materia también
                                        if (
                                            $materiaAsignada &&
                                            ($materiaAsignada->teacher->personnel->id ?? null) === $profesor->id &&
                                            $materiaAsignada->materia === $materia->materia
                                        ) {
                                            $carry++;
                                        }
                                    }
                                    return $carry;
                                }, 0);

                                $totalHorasProfesor += $horasAsignadas;
                            }
                        @endphp



                                <td class="border text-sm border-gray-300 px-4 py-2 text-center"
                                    style="background-color: {{ $esProfesorDeLaMateria && $horasAsignadas > 0 ? ($materia->teacher->color ?? '#eee') : '#fff' }}">
                                    @if($esProfesorDeLaMateria && $horasAsignadas > 0)
                                        {{ $horasAsignadas }} horas
                                    @else
                                        -
                                    @endif
                                </td>
                            @endforeach

                            {{-- Total general real de horas por coincidencia de profesor en TODO el horario --}}
                            @php

                                $totalReales = collect($horarios)->reduce(function($carry, $horario) use ($materias, $profesor, $grupo) {
                                    // Asegurar que solo se sumen las horas del grupo actual
                                    if ($horario['group_id'] != $grupo->id) {
                                        return $carry;
                                    }

                                    $dias = ['lunes', 'martes', 'miercoles', 'jueves', 'viernes'];
                                    foreach ($dias as $dia) {
                                        $materiaId = $horario[$dia] ?? null;
                                        $materia = $materias->firstWhere('id', $materiaId);
                                        if ($materia && ($materia->teacher->personnel->id ?? null) === $profesor->id) {
                                            $carry++;
                                        }
                                    }

                                    return $carry;
                                }, 0);
                            @endphp



                            <td class="border font-bold text-sm border-gray-300 px-4 py-2 text-center bg-yellow-100">
                                {{ $totalReales }} horas
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            </div>
          </div>
        </div>
        @endforeach
      </div>




    </div>



