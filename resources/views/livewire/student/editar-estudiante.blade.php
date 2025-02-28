<div>

    @if (session('error'))
        <div class="bg-red-100 border-t-4 border-red-500 rounded-b text-red-900 px-4 py-2 my-2 shadow-md" role="alert">
            <div class="flex justify-between items-center">
                <div>
                    <p class="font-bold">¡Advertencia!</p>
                    <p class="text-sm">{{ session('error') }}</p>
                </div>
                <button type="button" class="text-red-900"
                    onclick="this.parentElement.parentElement.style.display='none';">
                    <span class="text-xl">&times;</span>
                </button>
            </div>
        </div>
    @endif


    <div class="flow-root">


        <!-- component -->
        <style>
            :root {
                --main-color: #2e3b51;
            }

            .bg-main-color {
                background-color: var(--main-color);
            }

            .text-main-color {
                color: var(--main-color);
            }

            .border-main-color {
                border-color: var(--main-color);
            }
        </style>


        <div class="bg-gray-100">
            <div class="w-full text-white bg-main-color">

                <div class="p-4 flex flex-row items-center">

                    <p class="font-bold"><i class="fas fa-user"></i> Editar estudiante</p>


                </div>


            </div>
            <!-- End of Navbar -->


            <form wire:submit.prevent="actualizarEstudiante" enctype="multipart/form-data">
            <div class="container mx-auto my-5 p-5">
                <div class="md:flex no-wrap md:-mx-2 ">
                    <!-- Left Side -->
                    <div class="w-full md:w-5/12 md:mx-2">
                        <!-- Profile Card -->
                        <div class="bg-white p-3 border-t-4 border-green-400">
                            <div>
                            <div class="image overflow-hidden" >

                                <div>
                                    <div class="my-2 m-auto flex flex-col items-center">
                                        <div>
                                    @if($imagen)
                                        <img src="{{ asset('storage/students/'.$imagen) }}" alt="Vista previa" style="max-width: 100px;">
                                    @else
                                        <img src="https://cdn-icons-png.flaticon.com/512/3237/3237472.png" alt="Vista previa" style="max-width: 100px;">
                                    @endif
                                </div>

                                <div class="my-4">

                                        <label for="fileInput" class="btn bg-blue-700 me-2 mb-4 text-white p-3" tabindex="0">
                                            <span class="d-none d-sm-block my-3">Subir nueva foto</span>
                                            <i class="bx bx-upload d-block d-sm-none"></i>
                                            <input type="file" wire:model="imagen_nueva" id="fileInput"
                                             accept="image/png, image/jpeg" hidden="hidden"></label>
                                            </div>
                                    </div>


                                    <div class="my-5  flex justify-center items-center flex-col">
                                        @if($imagen_nueva)
                                            <p class="text-sm">Imagen Nueva:</p>
                                            <img src="{{ $imagen_nueva->temporaryUrl() }}" alt="Vista previa" style="max-width: 100px;">


                                        @endif

                                        <div wire:loading wire:target="imagen_nueva" class="text-sm text-gray-500 italic">
                                            <div class="p-3" style="display: flex; justify-content: center; align-items: center; height: 100%;">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 200" width="100" height="100">
                                                    <circle fill="none" stroke-opacity="1" stroke="#1E40AF" stroke-width=".5" cx="100" cy="100" r="0">
                                                        <animate attributeName="r" calcMode="spline" dur="1.4" values="1;80" keyTimes="0;1" keySplines="0 .2 .5 1" repeatCount="indefinite"></animate>
                                                        <animate attributeName="stroke-width" calcMode="spline" dur="1.4" values="0;25" keyTimes="0;1" keySplines="0 .2 .5 1" repeatCount="indefinite"></animate>
                                                        <animate attributeName="stroke-opacity" calcMode="spline" dur="1.4" values="1;0" keyTimes="0;1" keySplines="0 .2 .5 1" repeatCount="indefinite"></animate>
                                                    </circle>
                                                </svg>
                                            </div>
                                        </div>


                                        @error('imagen')
                                        <div class="text-red-500">{{ $message }}</div>

                                        @enderror
                                    </div>


                                </div>

                            </div>

                            </div>
                            <ul
                                class="bg-gray-100 text-gray-600 hover:text-gray-700 hover:shadow py-2 px-3 mt-3 divide-y rounded shadow-sm">
                                <li class="flex items-center py-3">
                                    <span>CURP:</span>
                                    <span class="ml-auto">{{ $CURP }}</span>
                                </li>
                                <li class="flex items-center py-3">
                                    <span>Alumno: </span>
                                    <span class="ml-auto">{{ $nombre }} {{ $apellido_paterno }} {{ $apellido_materno }} </span>
                                </li>

                                <li class="flex items-center py-3">
                                    <span>Fecha de Nacimiento: </span>
                                    <span class="ml-auto">{{ \Carbon\Carbon::parse($fecha_nacimiento)->format('d, m, Y') }}</span>
                                </li>
                                <li class="flex items-center py-3">
                                    <span>Edad: </span>
                                    <span class="ml-auto">{{ $edad }}</span>
                                </li>
                                <li class="flex items-center py-3">
                                    <span>Género: </span>
                                    <span class="ml-auto">{{ $genero }}</span>
                                </li>
                                <li class="flex items-center py-3">
                                    <span>Nivel: </span>
                                    <span class="ml-auto">{{ $nivel_nombre }}</span>
                                </li>
                                <li class="flex items-center py-3">
                                    <span>Grado: </span>
                                    <span class="ml-auto">{{ $grado_nombre }}</span>
                                </li>
                                <li class="flex items-center py-3">
                                    <span>Grupo: </span>
                                    <span class="ml-auto">{{ $grupo_name}}</span>
                                </li>
                                <li class="flex items-center py-3">
                                    <span>Generación: </span>
                                    <span class="ml-auto">{{ $generacion_nombre ?? 'N/A' }}</span>
                                </li>

                                <li class="flex items-center py-3">
                                    <span>Tutor : </span>
                                    <span class="ml-auto">{{ $tutor_nombre}}</span>
                                </li>

                                <li class="flex items-center py-3">
                                    <span>Estatus: </span>
                                    <span class="ml-auto">
                                        <span class="py-1 px-2 rounded text-white text-sm {{ $status === null ? 'bg-gray-500' : ($status == 1 ? 'bg-green-500' : 'bg-red-500') }}">
                                            {{ $status === null ? 'No seleccionado' : ($status == 1 ? 'Activo' : 'Inactivo') }}
                                        </span>
                                    </span>
                                </li>

                            </ul>
                        </div>
                        <!-- End of profile card -->
                        <div class="my-4"></div>
                        <!-- Friends card -->
                        <div class="bg-white p-3 hover:shadow">
                            <div class="flex items-center space-x-3 font-semibold text-gray-900 text-xl leading-8">
                                <span class="text-green-500">
                                    <svg class="h-5 fill-current" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                    </svg>
                                </span>
                                <span>Tutor</span>
                            </div>
                            <div class="grid grid-cols-3">
                                <div class="text-center my-2">
                                    @isset($tutor_id)
                                    <img class="h-16 w-16 rounded-full mx-auto"
                                        src="https://cdn-icons-png.flaticon.com/512/3237/3237472.png"
                                        alt="">

                                        <a target="_blank" href="{{ route('admin.tutors.show', $tutor_id) }}" class="text-main-color">{{ $tutor_nombre }}</a>
                                        <p class="text-gray-600">{{ $tutor_estudiantes }}</p>
                                    @endisset
                                </div>

                            </div>
                        </div>
                        <!-- End of friends card -->
                    </div>
                    <!-- Right Side -->
                    <div class="w-full md:w-7/12 mx-2 ">
                        <!-- Profile tab -->
                        <!-- About Section -->
                        <div class="bg-white p-3 shadow-sm rounded-sm">
                            <div class="flex items-center justify-between space-x-2 font-semibold text-gray-900 leading-8 pb-4">
                               <div>
                                <span class="tracking-wide"> <i class="fas fa-user"></i> EDITAR ESTUDIANTE</span>
                                </div>
                                <div>
                                    <a href="{{ route('admin.tutors.index') }}" target="_blank" class="text-white font-bold bg-blue-600 p-2 rounded-lg hover:bg-blue-800">
                                        <i class="fas fa-user"></i>  Nuevo tutor
                                    </a>
                                </div>

                            </div>
                            <div class="text-gray-700">



                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                        <div>

                                            <div class="mb-5">
                                                <label for="CURP"
                                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">CURP</label>
                                                <input type="text" id="CURP" wire:model.live="CURP"
                                                    placeholder="Ingrese el CURP"
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                                                @error('CURP')
                                                    <div class="text-red-500">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="mb-5">
                                                <label for="nombre"
                                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nombre</label>
                                                <input type="text" id="nombre" wire:model.live="nombre"
                                                    placeholder="Ingrese el nombre"
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                                                @error('nombre')
                                                    <div class="text-red-500">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="mb-5">
                                                <label for="apellido_paterno"
                                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Apellido
                                                    Paterno</label>
                                                <input type="text" id="apellido_paterno"
                                                    wire:model.live="apellido_paterno"
                                                    placeholder="Ingrese el apellido paterno"
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                                                @error('apellido_paterno')
                                                    <div class="text-red-500">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="mb-5">
                                                <label for="apellido_materno"
                                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Apellido
                                                    Materno</label>
                                                <input type="text" id="apellido_materno"
                                                    wire:model.live="apellido_materno"
                                                    placeholder="Ingrese el apellido materno"
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                                                @error('apellido_materno')
                                                    <div class="text-red-500">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="mb-5">
                                                <label for="fecha_nacimiento"
                                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Fecha
                                                    de Nacimiento</label>
                                                <input type="date" id="fecha_nacimiento"
                                                    wire:model.live="fecha_nacimiento"
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                                                @error('fecha_nacimiento')
                                                    <div class="text-red-500">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="mb-5">
                                                <label for="edad"
                                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Edad</label>
                                                <input type="number" id="edad" wire:model.live="edad"
                                                    placeholder="Ingrese la edad"
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                                                @error('edad')
                                                    <div class="text-red-500">{{ $message }}</div>
                                                @enderror
                                            </div>



                                            <div class="mb-5">
                                                <label for="genero"
                                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Género</label>
                                                <div class="flex items-center">
                                                    <label class="inline-flex items-center">
                                                        <input type="radio" id="genero_h" wire:model.live="genero"
                                                            value="H" class="form-radio text-blue-600"
                                                            name="genero">
                                                        <span class="ml-2 text-gray-700 dark:text-white">Hombre</span>
                                                    </label>
                                                    <label class="inline-flex items-center ml-6">
                                                        <input type="radio" id="genero_m" wire:model.live="genero"
                                                            value="M" class="form-radio text-blue-600"
                                                            name="genero">
                                                        <span class="ml-2 text-gray-700 dark:text-white">Mujer</span>
                                                    </label>
                                                </div>
                                                @error('genero')
                                                    <div class="text-red-500">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div>



                                            <div class="mb-5">
                                                <label for="level_id"
                                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nivel</label>
                                                <select id="level_id" wire:model.live="level_id"
                                                    class=" bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                                    <option value="">--Seleccione un nivel--</option>
                                                    @foreach ($niveles as $nivel)
                                                        <option value="{{ $nivel->id }}">{{ $nivel->level }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('level_id')
                                                    <div class="text-red-500">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="mb-5">
                                                <label for="generation_id"
                                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Generación</label>
                                                <select id="generation_id" wire:model.live="generation_id"
                                                class=" bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                                    <option value="">--Seleccione una generación--</option>
                                                    @foreach ($generaciones as $generacion)
                                                        <option value="{{ $generacion->id }}">{{ $generacion->anio_inicio }} - {{$generacion->anio_termino}} </option>
                                                    @endforeach
                                                </select>
                                                @error('generation_id')
                                                    <div class="text-red-500">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="mb-5">
                                                <label for="grade_id"
                                                    class=" block mb-2 text-sm font-medium text-gray-900 dark:text-white">Grado</label>
                                                <select id="grade_id" wire:model.live="grade_id"
                                                    class=" bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                                    <option value="">--Seleccione un grado--</option>
                                                    @foreach ($grados as $grado)
                                                        <option value="{{ $grado->id }}">

                                                            {{ $grado->grado }}°
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @error('grade_id')
                                                    <div class="text-red-500">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="mb-5">



                                                    <div class="mb-5">
                                                        <label for="group_id"
                                                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Grupo</label>
                                                        <select id="group_id" wire:model.live="group_id"
                                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                                            <option value="">--Seleccione un grupo--</option>
                                                            @foreach ($grupos as $grupo)
                                                                <option value="{{ $grupo->id }}">{{ $grupo->grupo }}</option>
                                                            @endforeach
                                                        </select>
                                                        @error('group_id')
                                                            <div class="text-red-500">{{ $message }}</div>
                                                        @enderror
                                                    </div>

                                            </div>



                                            <div class="mb-5" >
                                                <label for="tutor_id"
                                                    class="block mb-3 text-sm font-medium text-gray-900 dark:text-white">Tutor</label>
                                                <select id="tutor_id" wire:model.live="tutor_id"
                                                    class="student bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                                    <option value="">--Seleccione un tutor--</option>
                                                    @foreach ($tutores as $tutor)
                                                        <option value="{{ $tutor->id }}">{{ $tutor->nombre }}
                                                            {{ $tutor->apellido_paterno }}
                                                            {{ $tutor->apellido_materno }} => {{ $tutor->CURP }} </option>
                                                    @endforeach
                                                </select>
                                                @error('tutor_id')
                                                    <div class="text-red-500">{{ $message }}</div>
                                                @enderror

                                            </div>

                                            <div>

                                            </div>


                                            <div class="mb-5">
                                                <label for="status"
                                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Status</label>
                                                <select id="status" wire:model.live="status"
                                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500">
                                                    <option value="">--Seleccione un status--</option>
                                                    <option value="1">Activo</option>
                                                    <option value="0">Inactivo</option>
                                                </select>
                                                @error('status')
                                                    <div class="text-red-500">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="flex justify-start items-center mb-5">
                                                <button type="submit"
                                                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none
                                focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center
                                dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                                    Actualizar Estudiante
                                                    <svg wire:loading
                                                        style="width: 30px; height: 40px; margin-left: 5px;"
                                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 200">
                                                        <path fill="#FFFFFF" stroke="#FFFFFF" stroke-width="6"
                                                            transform-origin="center"
                                                            d="m148 84.7 13.8-8-10-17.3-13.8 8a50 50 0 0 0-27.4-15.9v-16h-20v16A50 50 0 0 0 63 67.4l-13.8-8-10 17.3 13.8 8a50 50 0 0 0 0 31.7l-13.8 8 10 17.3 13.8-8a50 50 0 0 0 27.5 15.9v16h20v-16a50 50 0 0 0 27.4-15.9l13.8 8 10-17.3-13.8-8a50 50 0 0 0 0-31.7Zm-47.5 50.8a35 35 0 1 1 0-70 35 35 0 0 1 0 70Z">
                                                            <animateTransform type="rotate" attributeName="transform"
                                                                calcMode="spline" dur="2" values="0;120"
                                                                keyTimes="0;1" keySplines="0 0 1 1"
                                                                repeatCount="indefinite"></animateTransform>
                                                        </path>
                                                    </svg>
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                </form>


                            </div>

                        </div>


                        <div class="my-4"></div>


                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

{{-- @push('scripts')
    <script>
        $(document).ready(function() {
            $('.student').select2({
                theme: 'tailwindcss-3',
            });

            // $('.student').on('change', function(){
            //    @this.set('tutor_id', this.value);
            // })
        });
    </script>
@endpush --}}
@push('scripts')

<script>
   document.addEventListener('livewire:initialized', () => {
    const preview = document.getElementById("preview");
            const fileInput = document.getElementById("fileInput");

        fileInput.addEventListener("change", () => {
            const file = fileInput.files[0];
            if (file) {
                showPreview(file);
            }
        });

        function showPreview(file) {
            const reader = new FileReader();
            reader.onload = (e) => {
                preview.src = e.target.result;
                preview.classList.remove("d-none");
            };
            reader.readAsDataURL(file);
        }
    })

</script>

<script>
Livewire.on('resetImagePreview', () => {

    let imagenPreview = document.getElementById('preview');
    imagenPreview.src = 'https://cdn-icons-png.flaticon.com/512/3237/3237472.png';
})


</script>

@endpush
