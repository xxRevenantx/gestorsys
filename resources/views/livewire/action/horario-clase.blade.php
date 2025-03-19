<div>
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
                    <td class="border border-gray-300 px-4 py-2 text-center">{{ $horario->hora }}</td>
                    <td class="border border-gray-300 px-4 py-2">
                        <select wire:model="horarios.{{ $horario->id }}.lunes"
                            class="form-control w-full border-gray-300 rounded-md"
                            wire:change="actualizarMateria({{ $horario->id }}, 'lunes', $event.target.value)">
                            <option value="">Seleccione</option>
                            @foreach($materias as $materia)
                                <option value="{{ $horario->id }}">
                                    {{ $materia->materia }}
                                </option>
                            @endforeach
                        </select>
                    </td>
                    <td class="border border-gray-300 px-4 py-2">
                        <select wire:model="horarios.{{ $horario->id }}.martes"
                            class="form-control w-full border-gray-300 rounded-md"
                            wire:change="actualizarMateria({{ $horario->id }}, 'martes', $event.target.value)">
                            <option value="">Seleccione</option>
                            @foreach($materias as $materia)
                                <option value="{{ $materia->id }}">
                                    {{ $materia->materia }}
                                </option>
                            @endforeach
                        </select>
                    </td>
                    <td class="border border-gray-300 px-4 py-2">
                        <select wire:model="horarios.{{ $horario->id }}.miercoles"
                            class="form-control w-full border-gray-300 rounded-md"
                            wire:change="actualizarMateria({{ $horario->id }}, 'miercoles', $event.target.value)">
                            <option value="">Seleccione</option>
                            @foreach($materias as $materia)
                                <option value="{{ $materia->id }}">
                                    {{ $materia->materia }}
                                </option>
                            @endforeach
                        </select>
                    </td>
                    <td class="border border-gray-300 px-4 py-2">
                        <select wire:model="horarios.{{ $horario->id }}.jueves"
                            class="form-control w-full border-gray-300 rounded-md"
                            wire:change="actualizarMateria({{ $horario->id }}, 'jueves', $event.target.value)">
                            <option value="">Seleccione</option>
                            @foreach($materias as $materia)
                                <option value="{{ $materia->id }}">
                                    {{ $materia->materia }}
                                </option>
                            @endforeach
                        </select>
                    </td>
                    <td class="border border-gray-300 px-4 py-2">
                        <select wire:model="horarios.{{ $horario->id }}.viernes"
                            class="form-control w-full border-gray-300 rounded-md"
                            wire:change="actualizarMateria({{ $horario->id }}, 'viernes', $event.target.value)">
                            <option value="">Seleccione</option>
                            @foreach($materias as $materia)
                                <option value="{{ $materia->id }}">
                                    {{ $materia->materia }}
                                </option>
                            @endforeach
                        </select>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
