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
   Desde calificaciones
</div>
