<div>
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
                <tr class="hover:bg-gray-50">
                    <td class="border border-gray-300 px-4 py-2 text-center">{{ $horario["hora"] }}</td>
                    <td class="border border-gray-300 px-4 py-2">
                        <select wire:model="horarios.{{ $horario['id'] }}.lunes"
                            class="form-control w-full border-gray-300 rounded-md"
                            wire:change="actualizarMateria({{ $horario['id'] }}, 'lunes', $event.target.value)">
                        <option value="">Seleccione</option>
                        @foreach($materias as $materia)
                            <option value="{{ $materia['id'] }}">{{ $materia->materia }}</option>
                        @endforeach
                    </select>
                    </td>
                    <td class="border border-gray-300 px-4 py-2">
                        <select wire:model="horarios.{{ $horario['id'] }}.martes"
                            class="form-control w-full border-gray-300 rounded-md"
                            wire:change="actualizarMateria({{ $horario['id'] }}, 'martes', $event.target.value)">
                            <option value="">Seleccione</option>
                            @foreach($materias as $materia)
                            <option value="{{ $materia['id'] }}">{{ $materia->materia }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td class="border border-gray-300 px-4 py-2">
                        <select wire:model="horarios.{{ $horario['id'] }}.miercoles"
                            class="form-control w-full border-gray-300 rounded-md"
                            wire:change="actualizarMateria({{ $horario['id'] }}, 'miercoles', $event.target.value)">
                            <option value="">Seleccione</option>
                            @foreach($materias as $materia)
                            <option value="{{ $materia['id'] }}">{{ $materia->materia }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td class="border border-gray-300 px-4 py-2">
                        <select wire:model="horarios.{{ $horario['id'] }}.jueves"
                            class="form-control w-full border-gray-300 rounded-md"
                            wire:change="actualizarMateria({{ $horario['id'] }}, 'jueves', $event.target.value)">
                            <option value="">Seleccione</option>
                            @foreach($materias as $materia)
                            <option value="{{ $materia['id'] }}">{{ $materia->materia }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td class="border border-gray-300 px-4 py-2">
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
            @endforeach
        </tbody>
    </table>
</div>
