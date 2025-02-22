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
                                <a href="https://api.whatsapp.com/send?phone={{ $tutor->celular }}" target="_blank" class="bg-green-500 hover:bg-green-600 text-white py-2 px-4 rounded">WhatsApp</a>
                                <a href="{{ route('admin.tutors.edit', $tutor) }}" target="_blank" class="bg-indigo-500 hover:bg-indigo-600 text-white py-2 px-4 rounded">Modificar tutor</a>
                            </div>
                        </div>
                        <hr class="my-6 border-t border-gray-300">
                        <div class="flex flex-col">
                            <ul>
                                <li class="py-2"><span class="font-bold">Dirección: </span>{{ $tutor->calle }}</li>
                                <hr>
                                <li class="py-2"><span class="font-bold">Número Exterior: </span>{{ $tutor->num_ext }}</li>
                                <hr>
                                <li class="py-2"><span class="font-bold">Número Interior: </span>{{ $tutor->num_int }}</li>
                                <hr>
                                <li class="py-2"><span class="font-bold">Código Postal: </span>{{ $tutor->CP }}</li>
                                <hr>
                                <li class="py-2"><span class="font-bold">Colonia: </span>{{ $tutor->colonia }}</li>
                                <hr>
                                <li class="py-2"><span class="font-bold">Localidad: </span>{{ $tutor->localidad }}</li>
                                <hr>
                                <li class="py-2"><span class="font-bold">Municipio: </span>{{ $tutor->municipio }}</li>
                                <hr>
                                <li class="py-2"><span class="font-bold">Estado: </span>{{ $tutor->estado }}</li>
                                <hr>
                                <li class="py-2"><span class="font-bold">Teléfono: </span>{{ $tutor->telefono }}</li>
                                <hr>
                                <li class="py-2"><span class="font-bold">Celular: </span>{{ $tutor->celular }}</li>
                                <hr>
                                <li class="py-2"><span class="font-bold">Email: </span>{{ $tutor->email }}</li>
                                <hr>
                                <li class="py-2"><span class="font-bold">Parentesco: </span>{{ $tutor->parentesco }}</li>
                                <hr>
                                <li class="py-2"><span class="font-bold">Ocupación: </span>{{ $tutor->ocupacion }}</li>
                                <hr>
                                <li class="py-2"><span class="font-bold">Último Grado de estudios: </span>{{ $tutor->ultimo_grado }}</li>
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
                                <div class="flex justify-between flex-wrap gap-2 w-full p-1">
                                    <a href="#" class="text-white font-bold bg-indigo-700 p-2 rounded-lg hover:bg-indigo-800">Alumno: {{ $student->nombre }} {{ $student->apellido_paterno }} {{ $student->apellido_materno }}</a>
                                    <p  class="text-white font-bold bg-indigo-700 p-2 rounded-lg">CURP: {{ $student->CURP }}</p>
                                    <p>
                                        <span class="text-gray-700 mr-2 font-bold">Fecha de inscripción:</span>
                                        <span class="text-gray-700">{{ $student->created_at->format('d-m-Y') }}</span>
                                    </p>
                                </div>
                                <p class="p-1" >
                                    <span class="text-gray-700 font-bold">Nivel:</span>
                                    <span class="text-gray-700">{{ $student->level->level }} </span>
                                </p>
                                <p class="p-1" >
                                    <span class="text-gray-700 font-bold">Grado:</span>
                                    <span class="text-gray-700">{{ $student->grade->grado_numero }}° Grado </span>
                                </p>
                                <p class="p-1">
                                    <span class="text-gray-700 font-bold">Grupo:</span>
                                    <span class="text-gray-700">"{{ $student->group->grupo }}" </span>

                                </p>
                                <p class="p-1">
                                    <span class="text-gray-700 font-bold">Generación:</span>
                                    <span class="text-gray-700">{{ $student->generation->anio_inicio }} - {{ $student->generation->anio_termino }} </span>
                                </p>

                                <hr>
                            @endforeach
                        </div>



                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
