<x-admin-layout>
<style>
@import url(https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/5.3.45/css/materialdesignicons.min.css);

.inset-l-full {
    left: 100%;
}
</style>

<div class="min-w-screen">
    <div class="py-3 px-5 w-full m-auto">


    <div class="-mx-1">
        <p class="text-lg font-medium dark:text-slate-100 mb-2">
            <span class="font-bold"> Nivel: </span> {{ $nivel->level }} <br>

            <span class="font-bold"> C.C.T.: </span> {{ $nivel->cct }} <br>
            <span class="font-bold"> Zona: </span> {{$nivel->supervisor->zona}}<br>


      </p>



    <ul class="flex flex-wrap justify-center text-sm font-medium text-center text-gray-500 border-b border-gray-200 dark:border-gray-700 dark:text-gray-400">
        @foreach ($acciones as $accion)
        <li class="me-2">
            <a href="{{ route('admin.level.action', ['nivel' => $nivel->slug, 'action' => $accion->slug, 'grade' => 1]) }}"
                class="@if($action->slug == $accion->slug) bg-indigo-500 text-white @endif hover:bg-gray-400 hover:text-gray-900 inline-block p-4
                text-indigo-700 bg-gray-100 rounded-t-lg active dark:bg-gray-800 dark:text-blue-500">
                <i class="mdi mdi-widgets-outline"></i>  {{ $accion->accion }}</a>
        </li>
        @endforeach
    </ul>
    </div>


    @if($action->slug == 'matricula-escolar')
        <livewire:action.matricula-escolar :level_id="$level_id" :grade="$grade" lazy />

   @elseif ($action->slug == 'inscribir-alumno')
       <livewire:action.inscribir-alumno :level_id="$level_id" lazy />
   @elseif ($action->slug == 'datos-del-alumno')
       <livewire:action.datos-alumno :level_id="$level_id" lazy />
   @elseif ($action->slug == 'pago-inscripcion')
       <livewire:action.pago-inscripcion :level_id="$level_id" lazy />
    @elseif ($action->slug == 'pago-de-colegiaturas')
       <livewire:action.colegiatura :level_id="$level_id" lazy />
    @elseif ($action->slug == 'materias')
         <livewire:action.materia.mostrar-materias :level_id="$level_id"  :grade="$grade" lazy />

    @elseif ($action->slug == 'horarios')
        <livewire:action.horario-clase  :level_id="$level_id"  :grade="$grade" lazy  />
    @elseif ($action->slug == 'calificaciones')
        <livewire:action.calificacion :level_id="$level_id"  :grade="$grade"  />

   @endif

    </div>


</div>


</x-admin-layout>

