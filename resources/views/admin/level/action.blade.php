<x-admin-layout :breadcrumb="[
    [
        'name' => 'Dashboard',
        'url' => '#',

    ],
    [
        'name' => 'Acciones',
        'url' => '#',
    ],

]">

<div class="p-1">
    <figure class="md:flex  bg-slate-100 rounded-xl  md:p-0 dark:bg-slate-800 shadow-lg">
      <div class="pt-6 md:px-5 md:py-2 text-center md:text-left space-y-4">

          <p class="text-lg font-medium dark:text-slate-100">
                <span class="font-bold"> Nivel: </span> {{ $nivel->level }} <br>
                <span class="font-bold"> C.C.T.: </span> {{ $nivel->cct }} <br>

          </p>

        <figcaption class="font-medium">
          <div class="text-sky-800 dark:text-sky-400">
               <span class="font-bold">Director: </span> <a class="underline" href="{{route('admin.directores.edit', $nivel->director->id)}}">{{ $nivel->director->nombre }} {{ $nivel->director->apellido_paterno }} {{ $nivel->director->apellido_materno }}</a>
          </div>
          <div class="text-sky-800 dark:text-sky-400">
            <span class="font-bold">Supervisor: </span> <a class="underline"  href="{{route('admin.supervisores.edit', $nivel->supervisor->id)}}">{{ $nivel->supervisor->nombre }} {{ $nivel->supervisor->apellido_paterno }} {{ $nivel->supervisor->apellido_materno }}</a>
          </div>
        </figcaption>
      </div>
    </figure>
  </div>

<style>
@import url(https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/5.3.45/css/materialdesignicons.min.css);

.inset-l-full {
    left: 100%;
}
</style>

<div class="min-w-screen mt-5">
    <div class="py-3 px-5 w-full m-auto  rounded shadow-xl text-white mb-5"  style="background-color: #1c232f" >
        <div class="-mx-1">
            <ul class="flex w-full flex-wrap items-center h-10">
                @foreach ($acciones as $accion )
                <li class="block relative">
                    <a  href="{{ route('admin.level.action', ['nivel' => $nivel->slug, 'action' => $accion->slug]) }}" class="flex items-center h-10 leading-10 px-4 rounded cursor-pointer no-underline hover:no-underline transition-colors duration-100 mx-1 @if($action->slug == $accion->slug) bg-indigo-500 @endif hover:bg-gray-500">
                        <span class="mr-3 text-xl"> <i class="mdi mdi-widgets-outline"></i> </span>
                        <span>{{ $accion->accion }}</span>
                    </a>
                @endforeach

            </ul>
        </div>
    </div>

        @if($action->slug == 'matricula-escolar')
             <livewire:action.matricula-escolar :level_id="$level_id" />
        @else
            {{$action->slug}}
        @endif
</div>


</x-admin-layout>

