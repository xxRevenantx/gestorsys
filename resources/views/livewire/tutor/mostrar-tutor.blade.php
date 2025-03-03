<div>
    <div class="bg-gray-100">
        <div class="container mx-auto py-8">
            <div class="grid grid-cols-4 sm:grid-cols-12 gap-6 px-4">
                <div class="col-span-4 sm:col-span-6">
                    <div class="bg-white shadow rounded-lg p-6">
                        <div class="flex flex-col items-center">
                            <img src="https://cdn-icons-png.flaticon.com/512/3237/3237472.png" class="w-32 h-32 bg-gray-300 rounded-full mb-4 shrink-0">

                            </img>
                            <h1 class="text-xl font-bold">{{ $tutor->nombre }} {{ $tutor->apellido_paterno }} {{ $tutor->apellido_materno }} </h1>
                            <p class="text-gray-700"><span class="font-bold"> CURP:</span> {{ $tutor->CURP }}</p>
                            <p class="text-gray-700"><span class="font-bold">Ocupación:</span> {{ $tutor->ocupacion }}</p>
                            <div class="mt-6 flex flex-wrap gap-4 justify-center">
                                <a href="https://api.whatsapp.com/send?phone={{ $tutor->celular }}" target="_blank" class="bg-green-500 hover:bg-green-600 text-white py-2 px-4 rounded"><i class="fab fa-whatsapp"></i> WhatsApp</a>
                                <a href="{{ route('admin.tutors.edit', $tutor) }}" target="_blank" class="bg-indigo-500 hover:bg-indigo-600 text-white py-2 px-4 rounded"><i class="fa-solid fa-user-pen"></i> Modificar tutor</a>
                            </div>
                        </div>
                        <hr class="my-6 border-t border-gray-300">
                        <div class="flex flex-col">
                            <ul>
                                <li class="py-2"><span class="font-bold"><i class="fa-solid fa-location-dot"></i> Dirección: </span>{{ $tutor->calle }}</li>
                                <hr>
                                <li class="py-2"><span class="font-bold"><i class="fa-solid fa-hashtag"></i> Número Exterior: </span>{{ $tutor->num_ext }}</li>
                                <hr>
                                <li class="py-2"><span class="font-bold"><i class="fa-solid fa-hashtag"></i> Número Interior: </span>{{ $tutor->num_int }}</li>
                                <hr>
                                <li class="py-2"><span class="font-bold"><i class="fa-brands fa-usps"></i> Código Postal: </span>{{ $tutor->CP }}</li>
                                <hr>
                                <li class="py-2"><span class="font-bold"><i class="fa-solid fa-location-dot"></i> Colonia: </span>{{ $tutor->colonia }}</li>
                                <hr>
                                <li class="py-2"><span class="font-bold"><i class="fa-solid fa-location-dot"></i> Localidad: </span>{{ $tutor->localidad }}</li>
                                <hr>
                                <li class="py-2"><span class="font-bold"><i class="fa-solid fa-location-dot"></i> Municipio: </span>{{ $tutor->municipio }}</li>
                                <hr>
                                <li class="py-2"><span class="font-bold"><i class="fa-solid fa-location-dot"></i> Estado: </span>{{ $tutor->estado }}</li>
                                <hr>
                                <li class="py-2"><span class="font-bold"><i class="fa-solid fa-phone"></i> Teléfono: </span>{{ $tutor->telefono }}</li>
                                <hr>
                                <li class="py-2"><span class="font-bold"><i class="fa-solid fa-mobile"></i> Celular: </span>{{ $tutor->celular }}</li>
                                <hr>
                                <li class="py-2"><span class="font-bold"><i class="fa-solid fa-inbox"></i> Email: </span>{{ $tutor->email }}</li>
                                <hr>
                                <li class="py-2"><span class="font-bold"><i class="fa-solid fa-user"></i> Parentesco: </span>{{ $tutor->parentesco }}</li>
                                <hr>
                                <li class="py-2"><span class="font-bold"><i class="fa-solid fa-briefcase"></i> Ocupación: </span>{{ $tutor->ocupacion }}</li>
                                <hr>
                                <li class="py-2"><span class="font-bold"><i class="fa-solid fa-graduation-cap"></i> Último Grado de estudios: </span>{{ $tutor->ultimo_grado }}</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-span-4 sm:col-span-6">
                    <div class="bg-white shadow rounded-lg p-6">

                        <div class="flex justify-between align-center">
                            <h2 class="text-xl font-bold pb-2">Alumnos relacionados al Tutor</h2>
                            <p class="font-bold text-2xl">{{ $tutor->students->count() }} {{ $tutor->students->count() == 1 ? 'Alumno' : 'Alumnos' }}</p>
                        </div>
                        <hr>




                        <div class="mb-6">

                            @foreach ($tutor->students as $student )
                                <div class="flex justify-between p-3 align-center">

                                    <div class="p-3">
                                    <img src="{{ $student->imagen ? asset('storage/students/'.$student->imagen) : 'https://cdn-icons-png.flaticon.com/512/3237/3237472.png' }}" alt="{{$student->nombre}}" class="w-16 h-16 bg-gray-300 rounded-full mb-4 shrink-0">
                                </div>

                                    <div class="flex-1">
                                    <a href="{{route('admin.students.show', $student->id)}}" class="text-white font-bold bg-indigo-700 p-2 rounded-lg hover:bg-indigo-800 mb-3 mt-3">Alumno: {{ $student->nombre }} {{ $student->apellido_paterno }} {{ $student->apellido_materno }}</a>


                                    <p class="p-1 mt-2">
                                        <span class="text-gray-700 font-bold">CURP:</span>
                                        <span class="text-gray-700">{{ $student->CURP }}</span>
                                    </p>
                                    <p class="p-1" >
                                        <span class="text-gray-700  font-bold">Fecha de inscripción:</span>
                                        <span class="text-gray-700">{{ $student->created_at->format('d-m-Y') }}</span>
                                    </p>

                                <p class="p-1" >
                                    <span class="text-gray-700 font-bold">Nivel:</span>
                                    <span class="text-gray-700">{{ $student->level->level }} </span>
                                </p>
                                <p class="p-1" >
                                    <span class="text-gray-700 font-bold">Grado:</span>
                                    <span class="text-gray-700">{{ $student->grade->grado }}° Grado </span>
                                </p>
                                <p class="p-1">
                                    <span class="text-gray-700 font-bold">Grupo:</span>
                                    <span class="text-gray-700">"{{ $student->group->grupo }}" </span>

                                </p>
                                <p class="p-1">
                                    <span class="text-gray-700 font-bold">Generación:</span>
                                    <span class="text-gray-700">{{ $student->generation->anio_inicio }} - {{ $student->generation->anio_termino }} </span>
                                </p>
                                    </div>
                                </div>

                                <hr>
                            @endforeach
                        </div>



                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
