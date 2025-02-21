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
                            <p class="text-gray-700">Ocupación: {{ $tutor->ocupacion }}</p>
                            <div class="mt-6 flex flex-wrap gap-4 justify-center">
                                <a href="https://api.whatsapp.com/send?phone={{ $tutor->celular }}" target="_blank" class="bg-green-500 hover:bg-green-600 text-white py-2 px-4 rounded">WhatsApp</a>
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
                                <li class="py-2"><span class="font-bold">Código Postal: </span>{{ $tutor->cp }}</li>
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

                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-span-4 sm:col-span-6">
                    <div class="bg-white shadow rounded-lg p-6">
                        <h2 class="text-xl font-bold pb-2">Estudiantes relacionados al Tutor</h2> <hr>


                        {{ $tutor->students->count() }}

                        <div class="mb-6">
                            <div class="flex justify-between flex-wrap gap-2 w-full">
                                <span class="text-gray-700 font-bold">Web Developer</span>
                                <p>
                                    <span class="text-gray-700 mr-2">at ABC Company</span>
                                    <span class="text-gray-700">2017 - 2019</span>
                                </p>
                            </div>
                            <p class="mt-2">
                                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed finibus est vitae
                                tortor ullamcorper, ut vestibulum velit convallis. Aenean posuere risus non velit egestas
                                suscipit.
                            </p>
                        </div>
                        <hr>


                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
