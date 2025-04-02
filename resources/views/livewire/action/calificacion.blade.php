<div class="rounded-lg shadow-lg px-4 py-4 bg-white dark:bg-gray-800">
    @include('admin.partials.loader')
    <nav
        class="flex items-center justify-center flex-wrap bg-white py-2 mb-4 lg:px-12 shadow border-solid border-t-2 border-blue-700">
        <div class="menu w-full lg:block lg:flex lg:items-center lg:w-auto lg:px-3 px-8 justify-center">
            <div class="text-md font-bold text-blue-700 lg: justify-center">
                @foreach ($grados as $grado)
                    <a href="{{ route('admin.level.grados', ["nivel" => $level, "action" => $action, "grado" => $grado->grado]) }}"
                       class=" @if ($grado->grado == $grade->grado) text-white bg-blue-700 @else text-blue-700 @endif block mt-4 lg:inline-block lg:mt-0 hover:text-white px-4 py-2 rounded hover:bg-blue-700 mr-2">
                        {{ $grado->grado }}° GRADO
                    </a>
                @endforeach
            </div>
        </div>
    </nav>




    <div x-data="{
        openGroupId: localStorage.getItem('grupo_abierto') || null,
        openPeriodos: JSON.parse(localStorage.getItem('periodos_abiertos')) || {},
        setGroup(id) {
            this.openGroupId = this.openGroupId === id ? null : id;
            localStorage.setItem('grupo_abierto', this.openGroupId);
        },
        togglePeriodo(id) {
            this.openPeriodos[id] = !this.openPeriodos[id];
            localStorage.setItem('periodos_abiertos', JSON.stringify(this.openPeriodos));
        }
    }">
        @foreach ($grupos as $grupo)
            <div class="mb-6 border rounded-lg">
                <h2>
                    <button
                        @click="setGroup('{{ $grupo->id }}')"
                        type="button"
                        class="flex items-center justify-between w-full p-5 font-medium rtl:text-right text-white bg-blue-700 border border-b-0 border-gray-200 rounded-t-xl focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-800 dark:border-gray-700 hover:bg-blue-800 gap-3">
                        <span>GRUPO: "{{ $grupo->grupo }}"</span>
                        <svg x-bind:class="{ 'rotate-180': openGroupId == '{{ $grupo->id }}' }"
                             class="w-4 h-4 transition-transform duration-200"
                             xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M9 5 5 1 1 5" />
                        </svg>
                    </button>
                </h2>
                <div x-show="openGroupId == '{{ $grupo->id }}'" x-transition>
                    <div class="p-5 border border-t-0 border-gray-200 dark:border-gray-700 dark:bg-gray-900">

                        <div class="space-y-4">
                            @foreach ($periodos as $index => $periodo)
                                @php
                                    $accordionId = 'periodo_' . $grupo->id . '_' . $periodo->id;
                                @endphp

                                <div>
                                    <h2>
                                        <button @click="togglePeriodo('{{ $accordionId }}')"
                                                type="button"
                                                class="w-full p-4 font-semibold text-left rounded-t-lg transition bg-indigo-500 text-white hover:bg-indigo-600">
                                            {{ $periodo->num_periodo }}° PERIODO
                                        </button>
                                    </h2>

                                    <div x-show="openPeriodos['{{ $accordionId }}']" x-transition class="border border-t-0 border-gray-300 dark:border-gray-700 rounded-b-lg">
                                        <div class="p-4 bg-white dark:bg-gray-800">
                                            <div class="overflow-x-auto shadow rounded">
                                                <table class="min-w-full bg-white dark:bg-gray-800 border border-gray-200">
                                                    <thead class="bg-gray-100 dark:bg-gray-700">
                                                        <tr>
                                                            <th class="px-4 py-2 text-left font-semibold">#</th>
                                                            <th class="px-4 py-2 text-left font-semibold">Nombre</th>
                                                            @foreach ($materias as $materia)
                                                                <th class="px-4 py-2 text-left font-semibold">{{ $materia->materia }}</th>
                                                            @endforeach
                                                            <th class="px-4 py-2 text-left font-semibold">Promedio</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                                                        @foreach ($students as $index => $student)
                                                            @php
                                                                $notas = collect($inputs[$periodo->id][$student->id] ?? [])
                                                                    ->filter(fn($n) => is_numeric($n))
                                                                    ->values();
                                                                $promedio = $notas->count() ? number_format($notas->avg(), 1) : '-';
                                                            @endphp
                                                            <tr>
                                                                <td class="px-4 py-2">{{ $index + 1 }}</td>
                                                                <td class="px-4 py-2">
                                                                    {{ $student->nombre }} {{ $student->apellido_paterno }} {{ $student->apellido_materno }}
                                                                </td>
                                                                @foreach ($materias as $materia)
                                                                    <td class="px-2 py-1 text-center">
                                                                        <input
                                                                            type="number"
                                                                            min="5" max="10" step="1"
                                                                            class="w-16 text-center bg-gray-100 dark:bg-gray-700 text-sm rounded border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                                                            wire:model.lazy="inputs.{{ $periodo->id }}.{{ $student->id }}.{{ $materia->id }}"
                                                                        >
                                                                    </td>
                                                                @endforeach
                                                                <td class="px-4 py-2 font-bold text-indigo-600">{{ $promedio }}</td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                    </div>
                </div>
            </div>
        @endforeach
    </div>


</div>
