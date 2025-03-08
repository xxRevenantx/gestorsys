<x-admin-layout>
<style>
@import url(https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/5.3.45/css/materialdesignicons.min.css);

.inset-l-full {
    left: 100%;
}
</style>

<div class="min-w-screen">
    <div class="py-3 px-5 w-full m-auto rounded shadow-xl" style="background: #f1f1f1" >
        <div class="-mx-1">
            <p class="text-lg font-medium dark:text-slate-100 mb-2">
                <span class="font-bold"> Nivel: </span> {{ $nivel->level }} <br>
                <span class="font-bold"> C.C.T.: </span> {{ $nivel->cct }} <br>
                <span class="font-bold"> Zona: </span> {{$nivel->supervisor->zona}}<br>

          </p>
            <hr>


        <ul class="flex flex-wrap justify-center text-sm font-medium text-center text-gray-500 border-b border-gray-200 dark:border-gray-700 dark:text-gray-400">
            @foreach ($acciones as $accion)
            <li class="me-2">
                <a href="{{ route('admin.level.action', ['nivel' => $nivel->slug, 'action' => $accion->slug]) }}"
                    class="@if($action->slug == $accion->slug) bg-indigo-500 text-white @endif hover:bg-gray-400 hover:text-gray-900 inline-block p-4
                    text-indigo-700 bg-gray-100 rounded-t-lg active dark:bg-gray-800 dark:text-blue-500">
                    <i class="mdi mdi-widgets-outline"></i>  {{ $accion->accion }}</a>
            </li>
            @endforeach
        </ul>


            {{-- <ul class="flex flex-wrap items-center mt-3">
                @foreach ($acciones as $accion)
                <li class="block relative">
                    <a href="{{ route('admin.level.action', ['nivel' => $nivel->slug, 'action' => $accion->slug]) }}" class="flex items-center h-10 leading-10 px-4 rounded cursor-pointer no-underline hover:no-underline transition-colors duration-100 mx-1 @if($action->slug == $accion->slug) bg-indigo-500 text-white @endif hover:bg-indigo-700">
                        <span class="mr-3 text-xl"> <i class="mdi mdi-widgets-outline"></i> </span>
                        <span>{{ $accion->accion }}</span>
                    </a>
                </li>
                @endforeach
            </ul> --}}
        </div>

        @if($action->slug == 'matricula-escolar')
        <livewire:action.matricula-escolar :level_id="$level_id" lazy />

   @elseif ($action->slug == 'inscribir-alumno')
       <livewire:action.inscribir-alumno :level_id="$level_id" lazy />
   @elseif ($action->slug == 'datos-del-alumno')
       <livewire:action.datos-alumno :level_id="$level_id" lazy />
   @elseif ($action->slug == 'pago-inscripcion')
       <livewire:action.pago-inscripcion :level_id="$level_id" lazy />
    @elseif ($action->slug == 'pago-de-colegiaturas')
       <livewire:action.colegiatura :level_id="$level_id" lazy />
    @elseif ($action->slug == 'materias')
         <livewire:action.materia.mostrar-materias :level_id="$level_id" lazy />

   @endif

    </div>


</div>


</x-admin-layout>

