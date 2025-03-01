<div>


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

                    <p class="font-bold"><i class="fas fa-user"></i> Estudiante {{ $student->nombre}} {{$student->apellido_paterno}} {{$student->apellido_materno}} | {{$student->CURP}} | {{$student->matricula}} </p>


                </div>


            </div>
            <!-- End of Navbar -->



            <div class="container mx-auto my-5 p-5">
                <div class="md:flex no-wrap md:-mx-2 ">
                    <!-- Left Side -->
                    <div class="w-full md:w-6/12 md:mx-auto">
                        <!-- Profile Card -->
                        <div class="bg-white p-3 border-t-4 border-green-400">
                            <div wire:ignore>
                            <div class="image overflow-hidden" >
                                <img id="preview" class="h-auto mx-auto" style="width: 150px"
                                    src="https://cdn-icons-png.flaticon.com/512/3237/3237472.png"
                                    alt="">
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


                        <div class="bg-white hover:shadow ">
                            <div class="w-full flex items-center justify-center dark:bg-gray-900">

                                <!-- Author card -->
                                <div
                                    class="relative w-full max-w-2xl my-8 md:my-8 flex flex-col items-start space-y-4 sm:flex-row sm:space-y-0 sm:space-x-6 px-4 py-8 border-2 border-dashed border-gray-400 dark:border-gray-400 shadow-lg rounded-lg">

                                    <span class="absolute text-md font-medium top-0 left-0 rounded-br-lg rounded-tl-lg px-4 py-1 bg-primary-100 dark:bg-gray-900 dark:text-gray-300 border-gray-400 dark:border-gray-400 border-b-2 border-r-2 border-dashed ">
                                         Tutor
                                    </span>

                                    <div class="w-full flex justify-center sm:justify-start sm:w-auto">
                                        <img class="object-cover w-20 h-20 mt-3 mr-3 rounded-full" src="https://cdn-icons-png.flaticon.com/512/3237/3237472.png">
                                    </div>

                                    <div class="w-full sm:w-auto flex flex-col items-center sm:items-start">

                                        <p class="font-display mb-2 text-2xl font-semibold dark:text-gray-200" itemprop="author">
                                            <a target="_blank" href="{{ route('admin.tutors.show', $tutor_id) }}" class="text-main-color">{{ $tutor_nombre }}</a>

                                        </p>

                                        <div class="mb-4 md:text-lg text-gray-400">
                                            <p>{{$tutor_ocupacion}}</p>
                                        </div>

                                        <div class="mb-4 md:text-lg text-gray-800 font-semibold">
                                            <p>{{ count($tutor_estudiantes) }} alumnos a cargo: </p>
                                        </div>

                                        <div class="flex gap-4">

                                            @foreach ($tutor_estudiantes as $student)
                                            <div class="flex items-center gap-3 px-2 py-3 bg-white rounded border w-full ">
                                                <a class="text-sm text-slate-500 self-start"  href="{{route('admin.students.show', $student->id)}}">{{ $student->nombre }} {{$student->apellido_paterno}} {{$student->apellido_materno}} </a>

                                            </div>

                                            @endforeach


                                        </div>
                                    </div>

                                </div>

                            </div>


                            </div>
                        </div>
                        <!-- End of friends card -->
                    </div>

                </div>
            </div>
        </div>

    </div>
</div>
