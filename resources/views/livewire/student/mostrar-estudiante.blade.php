<div>
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

            <p class="font-bold"><i class="fas fa-user"></i> Estudiante {{ $nombre}} {{$apellido_paterno}} {{$apellido_materno}} | {{$CURP}} | {{$matricula}} </p>


        </div>


    </div>

    <div class="container mx-auto my-5 p-5">
        <div class="md:flex no-wrap md:-mx-2 ">
            <!-- Left Side -->
            <div class="w-full md:w-3/12 md:mx-2">
                <!-- Profile Card -->
                <div class="bg-white p-3 border-t-4 border-green-400">
                    <div class="image overflow-hidden">
                        @if ($imagen)
                        <img class=" mx-auto" width="200px"
                            src="{{ asset('storage/students/'.$imagen) }}"
                            alt="">
                        @else
                        <img class=" mx-auto" width="150px"
                            src="https://cdn-icons-png.flaticon.com/512/3237/3237472.png"
                            alt="{{ $nombre }} {{ $apellido_paterno }} {{ $apellido_materno }}">

                        @endif
                    </div>
                    <h1 class="text-gray-900 font-bold text-xl text-center leading-8 my-1">{{ $nombre }} {{ $apellido_paterno }} {{ $apellido_materno }}</h1>
                    <ul
                        class="bg-gray-100 text-gray-600 hover:text-gray-700 hover:shadow py-2 px-3 mt-3 divide-y rounded shadow-sm">

                        <li class="flex items-center py-3">
                            <span>Matrícula</span>
                            <span class="ml-auto"> {{$matricula}} </span>
                        </li>
                        <li class="flex items-center py-3">
                            <span>CURP</span>
                            <span class="ml-auto"> {{$CURP}} </span>
                        </li>
                        <li class="flex items-center py-3">
                            <span>Inscrito el:</span>
                            <span class="ml-auto"> {{ \Carbon\Carbon::parse($created_at)->format('d/m/Y') }} </span>
                        </li>
                        <li class="flex items-center py-3">
                            <span>Status</span>
                            <span class="ml-auto">
                                <span class="py-1 px-2 rounded text-white text-sm {{ $status === null ? 'bg-gray-500' : ($status == 1 ? 'bg-green-500' : 'bg-red-500') }}">
                                    {{ $status === null ? 'No seleccionado' : ($status == 1 ? 'Activo' : 'Inactivo') }}
                                </span>

                            </span>
                        </li>
                        <li class="flex justify-center items-center py-3">

                                <a target="_blank" href="{{route('admin.expediente.alumno', $student->id)}}"  class="flex items-center px-4 py-2 text-white bg-red-500 rounded-lg hover:bg-red-700">
                                    <i class="fa-solid fa-file-pdf"></i>  Expediente
                                </a>

                        </li>
                    </ul>
                </div>
                <!-- End of profile card -->
                <div class="my-4"></div>

            </div>
            <!-- Right Side -->
            <div class="w-full md:w-9/12 mx-2 ">
                <!-- Profile tab -->
                <!-- About Section -->
                <div class="bg-white p-3 shadow-sm rounded-sm">
                    <div class="flex items-center space-x-2 font-semibold text-gray-900 leading-8">

                      <div class="flex justify-between w-full items-center mb-2">
                        <div>
                            <span class="tracking-wide"> <i class="fas fa-user"></i> DATOS ACADÉMICOS DEL ALUMNO</span>
                        </div>
                        <a href="{{route('admin.students.edit',$student->id)}}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            <i class="fas fa-edit"></i> Moficiar datos acádemicos
                        </a>
                      </div>
                    </div>
                    <div class="text-gray-700">
                        <div class="grid md:grid-cols-3 text-sm mb-3">
                            <div class="grid grid-cols-2  mb-2">
                                <div class="px-4 py-2 font-semibold">Nombre(s)</div>
                                <div class="px-4 py-2 bg-gray-200 rounded-lg">{{$student->nombre}}</div>
                            </div>
                            <div class="grid grid-cols-2 mb-2">
                                <div class="px-4 py-2 font-semibold">Apellido Paterno</div>
                                <div class="px-4 py-2 bg-gray-200 rounded-lg">{{$student->apellido_paterno}}</div>
                            </div>
                            <div class="grid grid-cols-2 mb-2">
                                <div class="px-4 py-2 font-semibold">Apellido Materno</div>
                                <div class="px-4 py-2 bg-gray-200 rounded-lg">{{$student->apellido_materno}}</div>
                            </div>


                            <div class="grid grid-cols-2 mb-2">
                                <div class="px-4 py-2 font-semibold">Nivel</div>
                                <div class="px-4 py-2 bg-gray-200 rounded-lg">{{$student->level->level}}</div>
                            </div>
                            <div class="grid grid-cols-2 mb-2">
                                <div class="px-4 py-2 font-semibold">Grado</div>
                                <div class="px-4 py-2 bg-gray-200 rounded-lg">{{$student->grade->grado}}°</div>
                            </div>

                            <div class="grid grid-cols-2 mb-2">
                                <div class="px-4 py-2 font-semibold">Grupo</div>
                                <div class="px-4 py-2 bg-gray-200 rounded-lg">{{$student->group->grupo}}</div>
                            </div>

                            <div class="grid grid-cols-2 mb-2">
                                <div class="px-4 py-2 font-semibold">Generación</div>
                                <div class="px-4 py-2 bg-gray-200 rounded-lg">{{$student->generation->anio_inicio}} - {{$student->generation->anio_termino}} </div>

                            </div>
                            <div class="grid grid-cols-2 mb-2">
                                <div class="px-4 py-2 font-semibold">Género</div>
                                <div class="px-4 py-2 bg-gray-200 rounded-lg">
                                    @if($student->genero == 'H')
                                        Hombre
                                    @elseif($student->genero == 'M')
                                        Mujer
                                    @else
                                        No especificado
                                    @endif
                                </div>
                            </div>
                            <div class="grid grid-cols-2 mb-2">
                                <div class="px-4 py-2 font-semibold">Fecha de Nacimiento</div>
                                <div class="px-4 py-2 bg-gray-200 rounded-lg">
                                    {{ \Carbon\Carbon::parse($student->fecha_nacimiento)->format('d/m/Y') }}
                                    @if ($fecha_nacimiento)
                                        <i class="fas fa-birthday-cake text-red-500 ml-2"></i>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                        <div id="accordion-collapse" data-accordion="collapse">
                            <h2 id="accordion-collapse-heading-1">
                              <button type="button" class="flex text-blue-800 items-center justify-between w-full p-5 font-medium rtl:text-right border border-b-1 border-gray-200 rounded-t-xl focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-800 dark:border-gray-700 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 gap-3" data-accordion-target="#accordion-collapse-body-1" aria-expanded="true" aria-controls="accordion-collapse-body-1">
                                <span class="text-blue-800 text-center">Mostrar información de contacto</span>
                                <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5 5 1 1 5"/>
                                </svg>
                              </button>
                            </h2>
                            <div id="accordion-collapse-body-1" class="hidden" aria-labelledby="accordion-collapse-heading-1">
                              <div class="p-5 border border border-gray-200 dark:border-gray-700 dark:bg-gray-900">
                                <div class="mb-3 flex justify-between items-center">
                                    <div>
                                        <span class="tracking-wide font-semibold"> <i class="fas fa-user"></i> DATOS DE CONTACTO DEL ALUMNO</span>
                                    </div>
                                    <a  href="{{route('admin.level.action', ['nivel' => $student->level->slug, 'action' => "datos-del-alumno"]) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-3  px-4 mb-3 rounded">
                                        <i class="fas fa-edit"></i> Modificar datos del alumno
                                    </a>
                                </div>
                                <div class="text-gray-700">
                                    <div class="grid md:grid-cols-3 text-sm mb-3">
                                        <div class="grid grid-cols-2 mb-2 ">
                                            <div class="px-4 py-2 font-semibold">País de Nac.</div>
                                            <div class="px-4 py-2 bg-gray-200 rounded-lg">{{$student->pais_nacimiento}}</div>
                                        </div>
                                        <div class="grid grid-cols-2 mb-2">
                                            <div class="px-4 py-2 font-semibold">Estado de Nac.</div>
                                            <div class="px-4 py-2 bg-gray-200 rounded-lg">{{$student->estado_nacimiento}}</div>
                                        </div>
                                        <div class="grid grid-cols-2 mb-2">
                                            <div class="px-4 py-2 font-semibold">Municipio Nac.</div>
                                            <div class="px-4 py-2 bg-gray-200 rounded-lg">{{$student->municipio_nacimiento}}</div>
                                        </div>


                                        <div class="grid grid-cols-2 mb-2">
                                            <div class="px-4 py-2 font-semibold">Estado donde vive</div>
                                            <div class="px-4 py-2 bg-gray-200 rounded-lg">{{$student->estado_vive}}</div>
                                        </div>

                                        <div class="grid grid-cols-2 mb-2">
                                            <div class="px-4 py-2 font-semibold">Municipio donde vive</div>
                                            <div class="px-4 py-2 bg-gray-200 rounded-lg">{{$student->municipio_vive}}</div>
                                        </div>

                                        <div class="grid grid-cols-2 mb-2">
                                            <div class="px-4 py-2 font-semibold">Colonia</div>
                                            <div class="px-4 py-2 bg-gray-200 rounded-lg">{{$student->colonia}}</div>

                                        </div>
                                        <div class="grid grid-cols-2 mb-2">
                                            <div class="px-4 py-2 font-semibold">Calle</div>
                                            <div class="px-4 py-2 bg-gray-200 rounded-lg">{{$student->calle}}</div>
                                        </div>
                                        <div class="grid grid-cols-2 mb-2">
                                            <div class="px-4 py-2 font-semibold">Número</div>
                                            <div class="px-4 py-2 bg-gray-200 rounded-lg">{{$student->numero}}</div>
                                        </div>
                                        <div class="grid grid-cols-2 mb-2">
                                            <div class="px-4 py-2 font-semibold">Código Postal</div>
                                            <div class="px-4 py-2 bg-gray-200 rounded-lg">{{$student->CP}}</div>
                                        </div>


                                    </div>
                                </div>
                              </div>
                            </div>




                          </div>
                </div>
                <!-- End of about section -->

                <div class="my-4"></div>

                <!-- Experience and education -->
                <div class="bg-white hover:shadow ">
                    <div class="w-full  dark:bg-gray-900">

                        <!-- Author card -->
                        <div
                            class="relative w-full my-8 md:my-8 flex flex-col items-start space-y-4 sm:flex-row sm:space-y-0 sm:space-x-6 px-4 py-8 border-2 border-dashed border-gray-400 dark:border-gray-400 shadow-lg rounded-lg">

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
                <!-- End of profile tab -->
            </div>
        </div>
    </div>
</div>

    <div class="flow-root">





        <div class="bg-gray-100">
            <div class="w-full text-white bg-main-color">

                <div class="p-4 flex flex-row items-center">

                    <p class="font-bold"><i class="fas fa-user"></i> Estudiante {{ $student->nombre}} {{$student->apellido_paterno}} {{$student->apellido_materno}} | {{$student->CURP}} | {{$student->matricula}} </p>


                </div>


            </div>



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



                        <!-- End of friends card -->
                    </div>

                </div>
            </div>
        </div>

    </div>
</div>
