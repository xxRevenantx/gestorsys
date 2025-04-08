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

                                                <a href="{{ route('admin.exportar.calificaciones')}}"
                                                <a href="#"
                                                    class="inline-flex my-3 items-center justify-end px-4 py-2 bg-green-600 text-white text-sm font-medium rounded hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500">
                                                     <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                                          <path d="M19 2H5c-1.1 0-2 .9-2 2v16c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2zm-7 14h-2v-2H8v2H6v-2H4v-2h2v-2H4V8h2V6h2v2h2V6h2v2h2v2h-2v2h2v2h-2v2zm4-2h-2v-2h2v2zm0-4h-2V8h2v2z"/>
                                                     </svg>
                                                     Exportar
                                                </a>

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
                                                        @if (!empty($studentsByGroup[$grupo->id]) && count($studentsByGroup[$grupo->id]) > 0)
                                                              @foreach ($studentsByGroup[$grupo->id] as $index => $student)
                                                            @php
                                                                $notas = collect($inputs[$periodo->id][$student->id] ?? [])
                                                                    ->filter(fn($n, $key) => is_numeric($n) && ($materias->where('id', $key)->first()->calificacion ?? 0) == 1)
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
                                                                            type="text"
                                                                            class="w-16 text-center bg-gray-100 dark:bg-gray-700 text-sm rounded border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500"
                                                                            wire:model.lazy="inputs.{{ $periodo->id }}.{{ $student->id }}.{{ $materia->id }}"
                                                                        >
                                                                    </td>
                                                                @endforeach
                                                                <td class="px-4 py-2 font-bold text-indigo-600">{{ $promedio }}</td>
                                                            </tr>
                                                        @endforeach

                                                        @else
                                                        <tr>
                                                            <td colspan="{{ count($materias) + 3 }}">
                                                                <div class="flex items-center justify-center bg-yellow-50 text-yellow-800 text-sm px-4 py-3 rounded-md">
                                                                    <svg class="w-5 h-5 mr-2 text-yellow-500" fill="none" stroke="currentColor" stroke-width="2"
                                                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                                              d="M12 9v2m0 4h.01M4.93 4.93l1.414 1.414M1 12h2m16.97-7.07l-1.414 1.414M21 12h2m-4.93 4.93l1.414 1.414M12 1v2m0 18v2M7.05 19.07l-1.414-1.414M12 5a7 7 0 110 14a7 7 0 010-14z" />
                                                                    </svg>
                                                                    <span>No hay alumnos registrados en este grupo.</span>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        @endif



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

@push('scripts')
<script>
    function enableKeyboardNavigation(containerSelector = 'table') {
        const table = document.querySelector(containerSelector);
        if (!table) return;

        const inputs = Array.from(table.querySelectorAll('input[type="text"]'));

        inputs.forEach((input) => {
            input.removeEventListener('keydown', handleKeyNav);
            input.addEventListener('keydown', handleKeyNav);
        });
    }

    function handleKeyNav(event) {
        const currentInput = event.target;
        const currentCell = currentInput.closest('td');
        const currentRow = currentInput.closest('tr');
        const table = currentRow.closest('table');

        const rows = Array.from(table.querySelectorAll('tbody tr'));
        const currentRowIndex = rows.indexOf(currentRow);
        const currentColIndex = currentCell.cellIndex;

        let nextInput = null;

        switch (event.key) {
            case 'ArrowDown':
                event.preventDefault();
                if (currentRowIndex + 1 < rows.length) {
                    nextInput = rows[currentRowIndex + 1].cells[currentColIndex]?.querySelector('input');
                }
                break;

            case 'ArrowUp':
                event.preventDefault();
                if (currentRowIndex > 0) {
                    nextInput = rows[currentRowIndex - 1].cells[currentColIndex]?.querySelector('input');
                }
                break;

            case 'ArrowRight':
                event.preventDefault();
                if (currentColIndex + 1 < currentRow.cells.length - 1) { // -1 para evitar promedio
                    nextInput = currentRow.cells[currentColIndex + 1]?.querySelector('input');
                }
                break;

            case 'ArrowLeft':
                event.preventDefault();
                if (currentColIndex > 1) { // >1 para no pasar a columna de nombre
                    nextInput = currentRow.cells[currentColIndex - 1]?.querySelector('input');
                }
                break;

            case 'Enter':
                event.preventDefault();
                if (currentRowIndex + 1 < rows.length) {
                    nextInput = rows[currentRowIndex + 1].cells[currentColIndex]?.querySelector('input');
                } else {
                    const firstRow = rows[0];
                    const nextColIndex = currentColIndex + 1;
                    if (nextColIndex < firstRow.cells.length - 1) {
                        nextInput = firstRow.cells[nextColIndex]?.querySelector('input');
                    }
                }
                break;
        }

        if (nextInput) {
            nextInput.focus();
            nextInput.select();
        }
    }

    // Reaplicar el script cuando Livewire modifica el DOM
    const observer = new MutationObserver(() => {
        enableKeyboardNavigation();
    });

    document.addEventListener('DOMContentLoaded', () => {
        const target = document.body;
        observer.observe(target, { childList: true, subtree: true });
        enableKeyboardNavigation();
    });
</script>




@endpush
