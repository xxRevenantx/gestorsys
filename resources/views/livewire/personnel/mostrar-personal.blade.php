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

              <p class="font-bold"><i class="fas fa-user"></i> Personal {{ $nombre}} {{$apellido_paterno}} {{$apellido_materno}} | CURP: {{$CURP}} | RFC: {{$RFC}} </p>


          </div>


      </div>

      <div class="container mx-auto my-5 p-5">
          <div class="md:flex no-wrap md:-mx-2 ">
              <!-- Left Side -->
              <div class="w-full md:w-3/12 md:mx-2">
                  <!-- Profile Card -->
                  <div class="bg-white p-3 border-t-4 border-green-400">
                      <div class="image overflow-hidden">

                          <img class=" mx-auto" width="150px"
                              src="https://cdn-icons-png.flaticon.com/512/3237/3237472.png"
                              alt="{{ $nombre }} {{ $apellido_paterno }} {{ $apellido_materno }}">


                      </div>
                      <h1 class="text-gray-900 font-bold text-xl text-center leading-8 my-1">{{ $nombre }} {{ $apellido_paterno }} {{ $apellido_materno }}</h1>
                      <ul
                          class="bg-gray-100 text-gray-600 hover:text-gray-700 hover:shadow py-2 px-3 mt-3 divide-y rounded shadow-sm">

                          <li class="flex items-center py-3">
                              <span>RFC:</span>
                              <span class="ml-auto"> {{$RFC}} </span>
                          </li>
                          <li class="flex items-center py-3">
                              <span>CURP:</span>
                              <span class="ml-auto"> {{$CURP}} </span>
                          </li>
                          <li class="flex items-center py-3">
                              <span>ADSCRITO EL:</span>
                              <span class="ml-auto"> {{ \Carbon\Carbon::parse($personnel->created_at)->format('d/m/Y') }} </span>
                          </li>
                          {{-- <li class="flex items-center py-3">
                              <span>Status</span>
                              <span class="ml-auto">
                                  <span class="py-1 px-2 rounded text-white text-sm {{ $status === null ? 'bg-gray-500' : ($status == 1 ? 'bg-green-500' : 'bg-red-500') }}">
                                      {{ $status === null ? 'No seleccionado' : ($status == 1 ? 'Activo' : 'Inactivo') }}
                                  </span>

                              </span>
                          </li> --}}
                          {{-- <li class="flex justify-center items-center py-3">

                                  <a target="_blank" href="{{route('admin.expediente.alumno', $student->id)}}"  class="flex items-center px-4 py-2 text-white bg-red-500 rounded-lg hover:bg-red-700">
                                      <i class="fa-solid fa-file-pdf"></i>  Expediente
                                  </a>

                          </li> --}}
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
                              <span class="tracking-wide"> <i class="fas fa-user"></i> DATOS</span>
                          </div>
                          <a href="{{route('admin.personnels.edit',$personnel->id)}}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                              <i class="fas fa-edit"></i> Moficiar datos
                          </a>
                        </div>
                      </div>
                      <div class="text-gray-700">
                          <div class="grid md:grid-cols-3 text-sm mb-3">
                              <div class="grid grid-cols-2  mb-2">
                                  <div class="px-4 py-2 font-semibold">Nombre(s)</div>
                                  <div class="px-4 py-2 bg-gray-200 rounded-lg">{{$nombre}}</div>
                              </div>
                              <div class="grid grid-cols-2 mb-2">
                                  <div class="px-4 py-2 font-semibold">Apellido Paterno</div>
                                  <div class="px-4 py-2 bg-gray-200 rounded-lg">{{$apellido_paterno}}</div>
                              </div>
                              <div class="grid grid-cols-2 mb-2">
                                  <div class="px-4 py-2 font-semibold">Apellido Materno</div>
                                  <div class="px-4 py-2 bg-gray-200 rounded-lg">{{$apellido_materno}}</div>
                              </div>

                              <div class="grid grid-cols-2 mb-2">
                                  <div class="px-4 py-2 font-semibold">Género</div>
                                  <div class="px-4 py-2 bg-gray-200 rounded-lg">
                                      @if($genero == 'H')
                                          Hombre
                                      @elseif($genero == 'M')
                                          Mujer
                                      @else
                                          No especificado
                                      @endif
                                  </div>
                              </div>
                              <div class="grid grid-cols-2 mb-2">
                                <div class="px-4 py-2 font-semibold">CURP</div>
                                <div class="px-2 py-2 bg-gray-200 rounded-lg">{{$CURP}}</div>
                            </div>
                            <div class="grid grid-cols-2 mb-2">
                                <div class="px-4 py-2 font-semibold">RFC</div>
                                <div class="px-4 py-2 bg-gray-200 rounded-lg">{{$RFC}}</div>
                            </div>
                            <div class="grid grid-cols-2 mb-2">
                                <div class="px-4 py-2 font-semibold">Email</div>
                                <div class="px-4 py-2 bg-gray-200 rounded-lg">{{ $email }}</div>
                            </div>
                            <div class="grid grid-cols-2 mb-2">
                                <div class="px-4 py-2 font-semibold">Teléfono</div>
                                <div class="px-4 py-2 bg-gray-200 rounded-lg">{{ $telefono }}</div>
                            </div>

                            <div class="grid grid-cols-2 mb-2">
                                <div class="px-4 py-2 font-semibold">Perfil</div>
                                <div class="px-4 py-2 bg-gray-200 rounded-lg">{{ $perfil }}</div>
                            </div>
                            <div class="grid grid-cols-1 mb-2">
                                <div class="px-4 py-2 font-semibold">Dirección</div>
                                <div class="px-4 py-2 bg-gray-200 rounded-lg">{{ $direccion }}</div>
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

