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
    <figure class="md:flex  bg-slate-100 rounded-xl  md:p-0 dark:bg-slate-800">
        @if($nivel->imagen)
        <img class="w-24 h-24 md:w-48 md:h-auto md:rounded-none rounded-full  object-cover" src="{{ asset('storage/levels/'.$nivel->imagen) }}" alt="" width="384" height="512">
        @else
        <img class="w-24 h-24 md:w-48 md:h-auto md:rounded-none rounded-full  object-cover" src="https://images.unsplash.com/photo-1495716868937-273203d5bb0c?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w0NzEyNjZ8MHwxfHNlYXJjaHw4fHxsYWR5fGVufDB8MHx8fDE2OTQxNzI4MTV8MA&ixlib=rb-4.0.3&q=80&w=1080" alt="" width="384" height="512">
        @endif
      <div class="pt-6 md:p-8 text-center md:text-left space-y-4">

          <p class="text-lg font-medium dark:text-slate-100">
                <span class="font-bold"> Nivel: </span> {{ $nivel->level }} <br>
                <span class="font-bold"> C.C.T.: </span> {{ $nivel->cct }} <br>

          </p>

        <figcaption class="font-medium">
          <div class="text-sky-800 dark:text-sky-400">
               <span class="font-bold">Director: </span> Sarah Dayan
          </div>
          <div class="text-sky-800 dark:text-sky-400">
            <span class="font-bold">Supervisor: </span> Sarah Dayan
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

<div class="min-w-screen ">
    <div class="py-3 px-5 max-w-7xl m-auto  rounded shadow-xl text-white"  style="background-color: #1c232f" >
        <div class="-mx-1">
            <ul class="flex w-full flex-wrap items-center h-10">
                @foreach ($acciones as $accion )
                <li class="block relative">
                    <a href="{{ route('admin.level.action', ['nivel' => $nivel->slug, 'action' => $accion->slug]) }}" class="flex items-center h-10 leading-10 px-4 rounded cursor-pointer no-underline hover:no-underline transition-colors duration-100 mx-1 hover:bg-gray-500">
                        <span class="mr-3 text-xl"> <i class="mdi mdi-widgets-outline"></i> </span>
                        <span>{{ $accion->accion }}</span>
                    </a>
                @endforeach

            </ul>
        </div>
    </div>

        Contenido
</div>


</x-admin-layout>

