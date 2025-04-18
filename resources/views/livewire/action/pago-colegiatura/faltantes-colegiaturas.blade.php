<div>
    <div class="p-4 md:p-5">
        <h3 class="text-lg font-semibold text-gray-700 mb-2">Filtrar</h3>

        <div class="mb-4 flex justify-start items-center">
            <div class="mr-3">
                <select  wire:model.live="grade_id" class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    <option value="">Seleccione un grado</option>
                    @foreach ($grades as $grade)
                        <option value="{{ $grade->id }}">{{ $grade->grado }}° grado</option>
                    @endforeach
                </select>
            </div>

            <div class="flex justify-end items-center">
            <button
                wire:click="exportToExcel"
                class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M3 3a2 2 0 012-2h10a2 2 0 012 2v14a2 2 0 01-2 2H5a2 2 0 01-2-2V3zm4.5 3.5a.5.5 0 00-.5.5v1H6a.5.5 0 000 1h1v1a.5.5 0 001 0v-1h1a.5.5 0 000-1H8v-1a.5.5 0 00-.5-.5zM7 12a.5.5 0 00-.5.5v1H6a.5.5 0 000 1h1v1a.5.5 0 001 0v-1h1a.5.5 0 000-1H8v-1a.5.5 0 00-.5-.5z" />
                </svg>
                Exportar a Excel
            </button>

            @isset($grade_id)
            <a href="{{ route('admin.colegiaturas.faltantes', ['level' => $level_id, 'grade' => $grade_id] ) }}"
            target="_blank"
             class="bg-orange-500 hover:bg-orange-600 text-white font-bold py-2 px-4 rounded flex items-center">
             <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                 <path d="M6 2a2 2 0 00-2 2v12a2 2 0 002 2h8a2 2 0 002-2V4a2 2 0 00-2-2H6zm3 4a1 1 0 112 0v4a1 1 0 11-2 0V6zm-1 8a1 1 0 112 0 1 1 0 11-2 0z" />
             </svg>
             Exportar a PDF
              </a>
            @endisset



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
                placeholder="Buscar por Nombre, CURP, Matrícula, Folio, Tipo de pago, Fecha de pago, Mes de pago"
                class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 w-full"
            />


    </div>



    </div>

        <div class="overflow-x-auto">
            <table class="min-w-full border-collapse border border-gray-300">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="px-4 py-2 border border-gray-300">#</th>
                        <th class="px-4 py-2 border border-gray-300">Nombre</th>
                        <th class="px-4 py-2 border border-gray-300">Nivel</th>
                        <th class="px-4 py-2 border border-gray-300">Grado</th>
                        <th class="px-4 py-2 border border-gray-300">Grupo</th>
                        @foreach ($months as $month)
                            <th class="px-4 py-2 border border-gray-300">{{ $month->mes }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach ($alumnosAgrupados as $gradoGrupo => $grupoDeAlumnos)
                        <tr class="bg-blue-100">
                            <td colspan="{{ 5 + $months->count() }}" class="px-4 py-2 font-semibold text-blue-800">
                                Grado: {{ $gradoGrupo }}
                            </td>
                        </tr>

                        @foreach ($grupoDeAlumnos as $key => $alumno)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-2 border border-gray-300">{{ $key + 1 }}</td>
                                <td class="px-4 py-2 border border-gray-300">{{ $alumno->nombre }} {{ $alumno->apellido_paterno }} {{ $alumno->apellido_materno }}</td>
                                <td class="px-4 py-2 border border-gray-300">{{ $alumno->level->level }}</td>
                                <td class="px-4 py-2 border border-gray-300">{{ $alumno->grade->grado }}</td>
                                <td class="px-4 py-2 border border-gray-300">{{ $alumno->group->grupo }}</td>

                                @foreach ($months as $month)
                                    @php
                                        $pago = $alumno->colegiaturas->firstWhere('month_id', $month->id);
                                    @endphp
                                    <td
                                        x-data="{ open: false }"
                                        @click="open = !open"
                                        class="relative px-4 py-2 border border-gray-300 text-gray-800 cursor-pointer {{ $pago ? 'bg-green-200' : '' }}"
                                    >
                                        {!! $pago ? '<span class="text-green-700 font-bold">✔</span>' : '' !!}

                                        @if($pago)
                                            {{-- Triángulo --}}
                                            <div class="absolute top-0 right-0 w-0 h-0 border-t-[12px] border-l-[12px] border-t-green-500 border-l-transparent"></div>

                                            {{-- Modal --}}
                                            <div
                                                x-show="open"
                                                @click.outside="open = false"
                                                class="absolute z-50 top-full mt-1 right-0 w-64 bg-white border border-gray-300 shadow-lg rounded-md p-3 text-sm"
                                                x-transition
                                            >
                                                <p><strong>Mes:</strong> {{ $pago->month->mes }}</p>
                                                <p><strong>Monto:</strong> ${{ number_format($pago->monto, 2) }}</p>
                                                <p><strong>Descuento:</strong> ${{ number_format($pago->descuento, 2) }}</p>
                                                <p><strong>Total:</strong> ${{ number_format($pago->total, 2) }}</p>
                                                <p><strong>Tipo:</strong> {{ $pago->tipo_pago }}</p>
                                                <p><strong>Folio:</strong> {{ $pago->folio }}</p>
                                                <p><strong>Fecha:</strong> {{ \Carbon\Carbon::parse($pago->fecha_pago)->format('d-m-Y') }}</p>
                                                <p><strong>Observaciones:</strong> {{ $pago->observaciones ?? 'N/A' }}</p>

                                                <a target="_blank" href="{{route('admin.recibo.colegiatura', ['alumno' => $pago->student_id, 'mes' => $pago->month_id])}}" class="flex items-center  mt-2 rounded-lg bg-blue-600 px-4 py-2 text-sm font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-4 focus:ring-blue-300 dark:bg-blue-500 dark:hover:bg-blue-600 dark:focus:ring-blue-800">
                                                    <i class="mdi mdi-file-pdf-outline mr-2"></i>
                                                    Descargar Recibo
                                                </a>


                                            </div>
                                        @endif
                                    </td>
                                @endforeach
                            </tr>
                        @endforeach
                    @endforeach
                </tbody>
            </table>
        </div>



</div>
</div>
