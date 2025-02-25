<x-admin-layout :breadcrumb="[
    [
        'name' => 'Dashboard',
        'url' => '#',

    ],
    [
        'name' => 'Niveles',
        'url' => '#',
    ],

]">


<!-- https://gist.github.com/goodreds/5b8a4a2bf11ff67557d38c5e727ea86c -->


<div class="flex flex-wrap justify-center">
@foreach ($niveles as $nivel )
    <div
    class="max-w-2xl mx-4 sm:max-w-sm md:max-w-sm lg:max-w-sm xl:max-w-sm sm:mx-auto md:mx-auto lg:mx-auto xl:mx-auto mt-16 bg-white shadow-xl rounded-lg text-gray-900">
    <div class="rounded-t-lg h-32 overflow-hidden">
        <img class="object-cover object-top w-full" src='https://images.unsplash.com/photo-1549880338-65ddcdfd017b?ixlib=rb-1.2.1&q=80&fm=jpg&crop=entropy&cs=tinysrgb&w=400&fit=max&ixid=eyJhcHBfaWQiOjE0NTg5fQ' alt='Mountain'>
    </div>
    <div class="mx-auto w-32 h-32 relative -mt-16 border-4 border-white rounded-full overflow-hidden">
        @if ($nivel->imagen)
        <img class="object-cover object-center w-full h-full" src="{{ Storage::url($nivel->imagen) }}" alt="Profile image">
        @else
        <img class="object-cover object-center w-full h-full" src="https://cdn-icons-png.flaticon.com/512/3237/3237472.png" alt="Profile image">
        @endif
    </div>
    <div class="text-center mt-2">
        <h2 class="font-semibold">{{$nivel->level}}</h2>
        <p class="text-gray-500 ">C.C.T. {{$nivel->cct}} </p>
        <p class="text-gray-500 ">Director: {{$nivel->director->nombre}} {{$nivel->director->apellido_paterno}} {{$nivel->director->apellido_materno}} </p>
        <p class="text-gray-500 ">Supervisor: {{$nivel->supervisor->nombre}} {{$nivel->supervisor->apellido_paterno}} {{$nivel->supervisor->apellido_materno}} </p>
        <p class="text-gray-500 ">Zona: {{$nivel->supervisor->zona}}</p>
        <p class="text-gray-500 ">Zona: {{$nivel->supervisor->sector}}</p>
    </div>
    <ul class="py-4 mt-2 text-gray-700 flex items-center justify-around">
        <li class="flex flex-col items-center justify-around">
            MUJERES
            <div>{{ $nivel->students->where('sexo', 'M')->count() }}</div>
        </li>
        <li class="flex flex-col items-center justify-between">
            TOTAL
            <div>{{ $nivel->students->count() }}</div>
        </li>
        <li class="flex flex-col items-center justify-around">
            HOMBRES
            <div>{{ $nivel->students->where('sexo', 'H')->count() }}</div>
        </li>
    </ul>
    <div class="p-4 border-t mx-8 mt-2">
        <a href="{{route('admin.level.action', $nivel)}}" class="w-1/2 block mx-auto rounded-full bg-gray-900 hover:shadow-lg font-semibold text-white px-6 py-2 text-center"><i class="fa-solid fa-right-to-bracket"></i> Entrar</a>
    </div>
</div>
@endforeach
</div>

</x-admin-layout>

