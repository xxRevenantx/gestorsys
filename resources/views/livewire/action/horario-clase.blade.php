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
                <option value="">--Seleccione el grupo--</option>
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
            <span class="flex items-center"><svg class="w-5 h-5 me-2 shrink-0" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zm0 8a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd"></path></svg>
                GRUPO: {{ $grupo->grupo }}
            </span>
            <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5"/>
            </svg>
          </button>
        </h2>
        <div id="accordion-open-body-{{$grupo->id}}"  aria-labelledby="accordion-open-heading-{{$grupo->id}}">
          <div class="p-5 border border-b-0 border-gray-200 dark:border-gray-700 dark:bg-gray-900">
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

                    @foreach($horarios as $horario)
                    @if($horario['group_id'] == $grupo->id)

                        @php
                            $colorLunes = !empty($horarios[$horario['id']]['lunes']) ? 'bg-indigo-300' : '';
                            $colorMartes = !empty($horarios[$horario['id']]['martes']) ? 'bg-green-300' : '';
                            $colorMiercoles = !empty($horarios[$horario['id']]['miercoles']) ? 'bg-yellow-300' : '';
                            $colorJueves = !empty($horarios[$horario['id']]['jueves']) ? 'bg-pink-300' : '';
                            $colorViernes = !empty($horarios[$horario['id']]['viernes']) ? 'bg-orange-300' : '';
                        @endphp

                        <tr class="hover:bg-gray-50">
                            <td class="border border-gray-300 px-4 py-2 text-center">
                                <input type="text" wire:model="horarios.{{ $horario['id'] }}.hora"
                                    class="form-control border-gray-300 rounded-md px-3 py-3 text-sm text-center"
                                    wire:change="actualizarHora({{ $horario['id'] }}, $event.target.value)">
                                @error('horarios.' . $horario['id'] . '.hora')
                                    <span class="text-red-500">{{ $message }}</span>
                                @enderror
                            </td>

                            <td class="border border-gray-300 px-4 py-2 {{ $colorLunes }}">
                                <select wire:model="horarios.{{ $horario['id'] }}.lunes"
                                    class="form-control w-full border-gray-300 rounded-md"
                                    wire:change="actualizarMateria({{ $horario['id'] }}, 'lunes', $event.target.value)">
                                    <option value="">Seleccione</option>
                                    @foreach($materias as $materia)
                                        <option value="{{ $materia['id'] }}">{{ $materia->materia }}</option>
                                    @endforeach
                                </select>
                            </td>

                            <td class="border border-gray-300 px-4 py-2 {{ $colorMartes }}">
                                <select wire:model="horarios.{{ $horario['id'] }}.martes"
                                    class="form-control w-full border-gray-300 rounded-md"
                                    wire:change="actualizarMateria({{ $horario['id'] }}, 'martes', $event.target.value)">
                                    <option value="">Seleccione</option>
                                    @foreach($materias as $materia)
                                        <option value="{{ $materia['id'] }}">{{ $materia->materia }}</option>
                                    @endforeach
                                </select>
                            </td>

                            <td class="border border-gray-300 px-4 py-2 {{ $colorMiercoles }}">
                                <select wire:model="horarios.{{ $horario['id'] }}.miercoles"
                                    class="form-control w-full border-gray-300 rounded-md"
                                    wire:change="actualizarMateria({{ $horario['id'] }}, 'miercoles', $event.target.value)">
                                    <option value="">Seleccione</option>
                                    @foreach($materias as $materia)
                                        <option value="{{ $materia['id'] }}">{{ $materia->materia }}</option>
                                    @endforeach
                                </select>
                            </td>

                            <td class="border border-gray-300 px-4 py-2 {{ $colorJueves }}">
                                <select wire:model="horarios.{{ $horario['id'] }}.jueves"
                                    class="form-control w-full border-gray-300 rounded-md"
                                    wire:change="actualizarMateria({{ $horario['id'] }}, 'jueves', $event.target.value)">
                                    <option value="">Seleccione</option>
                                    @foreach($materias as $materia)
                                        <option value="{{ $materia['id'] }}">{{ $materia->materia }}</option>
                                    @endforeach
                                </select>
                            </td>

                            <td class="border border-gray-300 px-4 py-2 {{ $colorViernes }}">
                                <select wire:model="horarios.{{ $horario['id'] }}.viernes"
                                    class="form-control w-full border-gray-300 rounded-md"
                                    wire:change="actualizarMateria({{ $horario['id'] }}, 'viernes', $event.target.value)">
                                    <option value="">Seleccione</option>
                                    @foreach($materias as $materia)
                                        <option value="{{ $materia['id'] }}">{{ $materia->materia }}</option>
                                    @endforeach
                                </select>
                            </td>
                        </tr>
                    @endif
                @endforeach

                </tbody>
            </table>
          </div>
        </div>
        @endforeach
      </div>




    </div>



