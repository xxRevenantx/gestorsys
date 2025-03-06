<div>
    <!-- LOADER  -->
    @include('admin.partials.loader')

<section class="bg-white antialiased dark:bg-gray-900 md:py-4">
   <div class="mx-auto max-w-screen-xl px-4 2xl:px-0">
     <div class="mx-auto ">

       <div class="flex justify-between items-center ">
           <h2 class="text-xl font-semibold text-gray-900 dark:text-white sm:text-2xl">Pago de <span class="text-indigo-700">Colegiaturas</span></h2>

               <button type="button" data-modal-target="default-modal" data-modal-toggle="default-modal" class="text-white bg-indigo-500 hover:bg-indigo-100 border border-indigo-200 focus:ring-4 focus:outline-none focus:ring-indigo-100 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:focus:ring-indigo-600 dark:bg-indigo-800 dark:border-indigo-700 dark:text-white dark:hover:bg-indigo-700">
                   <svg aria-hidden="true" class="w-4 h-4 me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path></svg>
                   <i class="mdi mdi-file-pdf-outline mr-2"></i> Ver todos los recibos
                   </button>



                   <!-- Main modal -->
                   <div id="default-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                       <div class="relative p-4  w-full max-h-full">
                           <!-- Modal content -->
                           <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700">
                               <!-- Modal header -->
                               <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 border-gray-200">
                                   <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                      Recibos de Pago
                                   </h3>

                               </div>
                               <!-- Modal body -->
                               {{-- <livewire:action.pago-inscripcion.mostrar-pagos-inscripcion :level_id="$level_id" /> --}}
                           </div>
                       </div>
                   </div>
       </div>

       <hr class="my-3">


       <div class="mt-6 sm:mt-8 lg:flex lg:items-start lg:gap-12">

         <form  wire:submit.prevent="guardarPago" class="w-full rounded-lg border border-gray-200 bg-white p-4 shadow-sm dark:border-gray-700 dark:bg-gray-800 sm:p-6 lg:max-w-xl lg:p-8">

           <div class="mb-3">
               <label
               class="block mb-1 text-sm text-gray-700 uppercase font-bold "
               for="query">Buscar por alumno nombre, matrícula o CURP:
           </label>
           <input
               wire:model.live.debounce.500ms="query"
               id="query"
               type="text"
               placeholder="Buscar alumno por nombre, matrícula o CURP:"
               class="rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 w-full"

               wire:keydown.arrow-down="selectedIndex = (selectedIndex + 1) % count($alumnos)"
               wire:keydown.arrow-up="selectedIndex = (selectedIndex - 1 + count($alumnos)) % count($alumnos)"
               wire:keydown.enter="selectUser(selectedIndex)"
           />


           @if (!empty($alumnos))
        <ul class="absolute bg-white border mt-1 rounded shadow z-10">
            @forelse ($alumnos as $index => $alumno)
            <li
                class="p-2 cursor-pointer {{ $selectedIndex === $index ? 'bg-blue-200' : '' }}"
                wire:click="selectAlumno({{ $index }})"
            >
            <p class="font-bold text-indigo-600">{{ $alumno->apellido_paterno}} {{ $alumno->apellido_materno }} {{ $alumno->nombre }}</p>
            <p class="text-indigo-700"> {{ $alumno->level->level }} {{ $alumno->grade->grado }}° "{{ $alumno->group->grupo }}" | {{  $alumno->CURP }} </p>
            </li>
            @empty
            <li class="p-2">No se encontraron alumnos.</li>
            @endforelse
        </ul>
       @endif

               @error('query')
               <span class="text-red-500">{{ $message }}</span>

               @enderror
           </div>

           {{-- {{ $meses }} --}}
           <div class="mb-3">
            <label for="month_id" class="mb-2 flex items-center gap-1 text-sm font-medium text-gray-900 dark:text-white">
              Mes de pago

            </label>
         <select  id="month_id" wire:model.live="month_id" class="py-3 px-4 pe-9
         block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500
          disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700
           dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600
           @if ($habilitarInput) bg-gray-50 focus:ring-primary-500 focus:border-primary-500 @else bg-gray-100 @endif"
               @if(!$habilitarInput) disabled  @endif
           >
             <option value="">--Selecciona el mes de pago--</option>
             @foreach ($meses as $mes)
                 <option class="@if ($mes->hasPayment) bg-green-500 text-white @else bg-gray-700 text-white @endif"
                     value="{{ $mes->id }}">{{ $mes->mes }} @if ($mes->hasPayment) -
                      Pagado  @endif
                    </option>
             @endforeach
         </select>
            @error('month_id')
            <span class="text-red-500">{{ $message }}</span>
            @enderror
        </div>



           <div class="mb-6 grid grid-cols-2 gap-4">
             <div class="col-span-2 sm:col-span-1">
               <label for="nombre_pago" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white"> Recibimos de</label>
               <input type="text"

               wire:model.live="nombre_pago" id="nombre_pago"
               class="block w-full rounded-lg border border-gray-300
               p-2.5 text-sm text-gray-900 focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600
                dark:bg-gray-700 dark:text-white dark:placeholder:text-gray-400 dark:focus:border-primary-500
                dark:focus:ring-primary-500
                @if ($habilitarInput) bg-gray-50 focus:ring-primary-500 focus:border-primary-500 @else bg-gray-100 @endif"
               @if(!$habilitarInput) disabled  @endif
               />
               @error('nombre_pago')
               <span class="text-red-500">{{ $message }}</span>
             @enderror
           </div>


             <div class="col-span-2 sm:col-span-1">
               <label for="card-number-input" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white"> Tipo de pago </label>
               <select id="tipo_pago" wire:model.live="tipo_pago"
               class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900 focus:
               border-primary-500 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white
                dark:placeholder:text-gray-400 dark:focus:border-primary-500
                dark:focus:ring-primary-500
                @if ($habilitarInput) bg-gray-50 focus:ring-primary-500 focus:border-primary-500 @else bg-gray-100 @endif"
               @if(!$habilitarInput) disabled  @endif

                >
                   <option value="">--Selecciona el tipo de pago---</option>
                   <option value="Efectivo">Efectivo</option>
                   <option value="Tarjeta">Tarjeta</option>
                   <option value="Transferencia">Transferencia</option>

               </select>
               @error('tipo_pago')
               <span class="text-red-500">{{ $message }}</span>
               @enderror
           </div>


           <div>
               <label for="monto" class="mb-2 flex items-center gap-1 text-sm font-medium text-gray-900 dark:text-white">
                 Monto
               </label>
               <input type="number" wire:model.live='monto' id="monto" aria-describedby="helper-text-explanation"
               class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm
                text-gray-900 focus:border-primary-500 focus:ring-primary-500 dark:border-gray-600
                 dark:bg-gray-700 dark:text-white dark:placeholder:text-gray-400 dark:focus:border-primary-500
                 dark:focus:ring-primary-500
                 @if ($habilitarInput) bg-gray-50 focus:ring-primary-500 focus:border-primary-500 @else bg-gray-100 @endif"
               @if(!$habilitarInput) disabled  @endif
                 />
               @error('monto')
               <span class="text-red-500">{{ $message }}</span>
               @enderror
           </div>
           <div>
               <label for="descuento" class="mb-2 flex items-center gap-1 text-sm font-medium text-gray-900 dark:text-white">
                 descuento
                 <button data-tooltip-target="cvv-desc" data-tooltip-trigger="hover" class="text-gray-400
                  hover:text-gray-900 dark:text-gray-500 dark:hover:text-white
                  @if ($habilitarInput) bg-gray-50 focus:ring-primary-500 focus:border-primary-500 @else bg-gray-100 @endif"
                 @if(!$habilitarInput) disabled  @endif
                  >

                 </button>

               </label>
               <input type="number" min="0" wire:model.live='descuento' id="descuento" aria-describedby="helper-text-explanation"
                class="block w-full rounded-lg border border-gray-300
                  p-2.5 text-sm text-gray-900 focus:border-primary-500
                 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder:text-gray-400
                 dark:focus:border-primary-500 dark:focus:ring-primary-500
                 @if ($habilitarInput) bg-gray-50 focus:ring-primary-500 focus:border-primary-500 @else bg-gray-100 @endif"
               @if(!$habilitarInput) disabled  @endif

                 />
               @error('descuento')
               <span class="text-red-500">{{ $message }}</span>
               @enderror
           </div>

             <div>
               <label for="fecha_pago" class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Fecha de Pago</label>
               <div class="relative">
                 <div class="pointer-events-none absolute inset-y-0 start-0 flex items-center ps-3.5">
                   <svg class="h-4 w-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                     <path
                       fill-rule="evenodd"
                       d="M5 5a1 1 0 0 0 1-1 1 1 0 1 1 2 0 1 1 0 0 0 1 1h1a1 1 0 0 0 1-1 1 1 0 1 1 2 0 1 1 0 0 0 1 1h1a1 1 0 0 0 1-1 1 1 0 1 1 2 0 1 1 0 0 0 1 1 2 2 0 0 1 2 2v1a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V7a2 2 0 0 1 2-2ZM3 19v-7a1 1 0 0 1 1-1h16a1 1 0 0 1 1 1v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2Zm6.01-6a1 1 0 1 0-2 0 1 1 0 0 0 2 0Zm2 0a1 1 0 1 1 2 0 1 1 0 0 1-2 0Zm6 0a1 1 0 1 0-2 0 1 1 0 0 0 2 0Zm-10 4a1 1 0 1 1 2 0 1 1 0 0 1-2 0Zm6 0a1 1 0 1 0-2 0 1 1 0 0 0 2 0Zm2 0a1 1 0 1 1 2 0 1 1 0 0 1-2 0Z"
                       clip-rule="evenodd"
                     />
                   </svg>
                 </div>
                 <input wire:model.live.debounce.500ms='fecha_pago'  id="fecha_pago" type="date" class="block w-full
                  rounded-lg border border-gray-300 p-2.5 ps-9 text-sm text-gray-900 focus:border-blue-500
                   focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder:text-gray-400
                    dark:focus:border-blue-500 dark:focus:ring-blue-500
                    @if ($habilitarInput) bg-gray-50 focus:ring-primary-500 focus:border-primary-500 @else bg-gray-100 @endif"
                     @if(!$habilitarInput) disabled  @endif
                    />
               </div>
               @error('fecha_pago')
               <span class="text-red-500">{{ $message }}</span>
               @enderror
             </div>
           </div>

           <div class="w-full mb-3">
            <label for="observaciones"
            class="mb-2 block text-sm font-medium text-gray-900
             dark:text-white"
            >
                Observaciones</label>
            <div class="relative">
              <textarea wire:model.live='observaciones' id="observaciones"
              class="block w-full rounded-lg border border-gray-300 bg-gray-50 p-2.5 text-sm text-gray-900
              focus:border-blue-500 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700 dark:text-white
               dark:placeholder:text-gray-400 dark:focus:border-blue-500 dark:focus:ring-blue-500
               @if ($habilitarInput) bg-gray-50 focus:ring-primary-500 focus:border-primary-500 @else bg-gray-100 @endif"
               @if(!$habilitarInput) disabled  @endif
               ></textarea>
            </div>
            @error('observaciones')
            <span class="text-red-500">{{ $message }}</span>
            @enderror
          </div>

           <button type="submit" class="
           flex w-full items-center justify-center rounded-lg bg-indigo-500 hover:bg-indigo-600  px-5 py-2.5 text-sm font-medium
           text-white  focus:outline-none focus:ring-4  focus:ring-blue-300 dark:bg-blue-600
           dark:hover:bg-blue-700 dark:focus:ring-blue-800"
           >
               {{$textoPago}}
               <svg wire:loading style="width: 30px; height: 40px; margin-left: 5px;" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 200 200"><path fill="#FFFFFF" stroke="#FFFFFF" stroke-width="6" transform-origin="center" d="m148 84.7 13.8-8-10-17.3-13.8 8a50 50 0 0 0-27.4-15.9v-16h-20v16A50 50 0 0 0 63 67.4l-13.8-8-10 17.3 13.8 8a50 50 0 0 0 0 31.7l-13.8 8 10 17.3 13.8-8a50 50 0 0 0 27.5 15.9v16h20v-16a50 50 0 0 0 27.4-15.9l13.8 8 10-17.3-13.8-8a50 50 0 0 0 0-31.7Zm-47.5 50.8a35 35 0 1 1 0-70 35 35 0 0 1 0 70Z"><animateTransform type="rotate" attributeName="transform" calcMode="spline" dur="2" values="0;120" keyTimes="0;1" keySplines="0 0 1 1" repeatCount="indefinite"></animateTransform></path></svg>

           </button>
         </form>

         <div class="mt-6 grow sm:mt-8 lg:mt-0">
           <div class="space-y-4 rounded-lg border border-gray-100 bg-gray-50 p-6 dark:border-gray-700 dark:bg-gray-800">
             <div class="space-y-2">

              @isset($pagoExistente)
              <dl class="flex items-center justify-end gap-4">
                   <dd class="text-base font-medium text-gray-900 dark:text-white">
                     <a target="_blank" href="{{route('admin.recibo.inscripcion', $alumnoSeleccionadoId)}}" class="flex items-center justify-end mt-2 rounded-lg bg-red-600 px-4 py-2 text-sm font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-4 focus:ring-red-300 dark:bg-red-500 dark:hover:bg-red-600 dark:focus:ring-red-800">
                         <i class="mdi mdi-file-pdf-outline mr-2"></i>
                         Descargar Recibo
                     </a>
                 </dd>
                 </dl>
              @endisset
               <dl class="flex items-center justify-between gap-4">
                 <dt class="text-base font-normal text-gray-500 dark:text-gray-400">Padre O Tutor de: </dt>
                 <dd class="text-base font-medium text-gray-900 dark:text-white">
                   @isset($alumnoSeleccionadoId)
                   {{ $nombre }} {{ $apellido_paterno }} {{ $apellido_materno }}
                   @else
                   ------------

                   @endisset

               </dd>
               </dl>

               <dl class="flex items-center justify-between gap-4">
                 <dt class="text-base font-normal text-gray-500 dark:text-gray-400">Recibimos de:</dt>
                 <dd class="text-base font-medium text-green-500">{{$nombre_pago}}</dd>
               </dl>

               <dl class="flex items-center justify-between gap-4">
                 <dt class="text-base font-normal text-gray-500 dark:text-gray-400">Tipo de pago:</dt>
                 <dd class="text-base font-medium text-gray-900 dark:text-white">{{$tipo_pago}}</dd>
               </dl>

               <dl class="flex items-center justify-between gap-4">
                   <dt class="text-base font-normal text-gray-500 dark:text-gray-400">La cantidad de:</dt>
                   <dd class="text-base font-medium text-green-500 dark:text-white">${{$monto}}</dd>
                 </dl>

               <dl class="flex items-center justify-between gap-4">
                 <dt class="text-base font-normal text-gray-500 dark:text-gray-400">Descuento</dt>
                 <dd class="text-base font-medium text-blue-500 dark:text-white">-${{$descuento}}</dd>
               </dl>
             </div>

             <dl class="flex items-center justify-between gap-4 border-t border-gray-200 pt-2 dark:border-gray-700">
               <dt class="text-base font-bold text-gray-900 dark:text-white">Total</dt>
               @isset($descuento)
               <dd class="text-base font-bold text-gray-900 dark:text-white">${{$monto-$descuento}}</dd>
               @else
               <dd class="text-base font-bold text-gray-900 dark:text-white">${{$monto}}</dd>
               @endisset

             </dl>
           </div>

           <div class="mt-6 flex items-center justify-center gap-8">

             <img class="h-8 w-auto dark:hidden" src="https://flowbite.s3.amazonaws.com/blocks/e-commerce/brand-logos/visa.svg" alt="" />
             <img class="hidden h-8 w-auto dark:flex" src="https://flowbite.s3.amazonaws.com/blocks/e-commerce/brand-logos/visa-dark.svg" alt="" />
             <img class="h-8 w-auto dark:hidden" src="https://flowbite.s3.amazonaws.com/blocks/e-commerce/brand-logos/mastercard.svg" alt="" />
             <img class="hidden h-8 w-auto dark:flex" src="https://flowbite.s3.amazonaws.com/blocks/e-commerce/brand-logos/mastercard-dark.svg" alt="" />
           </div>
         </div>
       </div>

     </div>
   </div>
 </section>






</div>
