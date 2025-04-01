<div class="rounded-lg shadow-lg px-4 py-4 bg-white dark:bg-gray-800">


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




        <div id="accordion-collapse" data-accordion="collapse">
            @foreach ($periodos as $index => $periodo)
                @php
                    $headingId = "accordion-heading-$index";
                    $bodyId = "accordion-body-$index";

                    // Estilos por defecto
                    $buttonClasses = "flex items-center justify-between w-full p-5 font-medium rtl:text-right border border-gray-200 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-800 dark:border-gray-700 hover:bg-gray-100 dark:hover:bg-gray-800 gap-3";

                    // Estilo especial por posición
                    if ($index == 0) {
                        // Primer botón (activo o destacado)
                        $buttonClasses .= " bg-indigo-500 text-white rounded-t-xl hover:bg-indigo-600";
                    } elseif ($index == 1) {
                        $buttonClasses .= " bg-indigo-500 text-white hover:bg-indigo-300";
                    } elseif ($index == 2) {
                        $buttonClasses .= "  bg-indigo-500 text-white hover:bg-indigo-300";
                    } else {
                        $buttonClasses .= " text-gray-500 dark:text-gray-400";
                    }
                @endphp

                <h2 id="{{ $headingId }}">
                    <button type="button" class="{{ $buttonClasses }}"
                        data-accordion-target="#{{ $bodyId }}" aria-expanded="false" aria-controls="{{ $bodyId }}">
                        <span>{{ $periodo->num_periodo }}° PERIODO</span>
                        <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5"/>
                        </svg>
                    </button>
                </h2>
                <div id="{{ $bodyId }}" class="hidden" aria-labelledby="{{ $headingId }}">
                    <div class="p-5 border border-b-0 border-gray-200 dark:border-gray-700 dark:bg-gray-900">
                        <p class="mb-2 text-gray-500 dark:text-gray-400">Contenido para el período: {{ $periodo->num_periodo }}</p>
                        <p>{{  $level->level  }}  {{ $materias }}  </p>

                        {{-- {{ $materias }} --}}


                    </div>
                </div>
            @endforeach
        </div>





</div>
