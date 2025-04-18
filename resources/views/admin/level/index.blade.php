<x-admin-layout :breadcrumb="[
    [
        'name' => 'Dashboard',
        'url' => '#',

    ],
    [
        'name' => 'Nivele Básico',
        'url' => '#',
    ],

]">


<!-- https://gist.github.com/goodreds/5b8a4a2bf11ff67557d38c5e727ea86c -->


<div class="flex flex-wrap justify-center">
@foreach ($niveles->where('slug', '!=', 'bachillerato') as $nivel )
    <div
            class="max-w-2xl mx-4 sm:max-w-sm md:max-w-sm lg:max-w-sm xl:max-w-sm sm:mx-auto md:mx-auto lg:mx-auto xl:mx-auto mt-16 bg-white shadow-xl rounded-lg text-gray-900">
            <div class="rounded-t-lg h-32 overflow-hidden">
                <img class="object-cover object-top w-full" src='{{ asset('storage/banner.jpg') }}' alt='banner'>
            </div>
            <div class="mx-auto w-32 h-32 relative -mt-16 border-4 border-white rounded-full overflow-hidden">
                @if ($nivel->imagen)
                <img class="object-cover object-center w-full h-full" src="{{ asset('storage/levels/'.$nivel->imagen) }}" alt="{{ $nivel->level }}">
                @else
                <img class="object-cover object-center w-full h-full" src="{{ asset('storage/user.png') }}" alt="user">
                @endif
            </div>
            <div class="text-center mt-2">
                <h2 class="font-semibold">{{$nivel->level}}</h2>
                @if ($nivel->cct)
                    <p class="text-gray-500">C.C.T. {{$nivel->cct}}</p>
                @endif
                @if ($nivel->director)
                    <p class="text-gray-500">Director: {{$nivel->director->nombre}} {{$nivel->director->apellido_paterno}} {{$nivel->director->apellido_materno}}</p>
                @endif
                @if ($nivel->supervisor)
                    <p class="text-gray-500">Supervisor: {{$nivel->supervisor->nombre}} {{$nivel->supervisor->apellido_paterno}} {{$nivel->supervisor->apellido_materno}}</p>
                    <p class="text-gray-500">Zona: {{$nivel->supervisor->zona}}</p>
                    <p class="text-gray-500">Sector: {{$nivel->supervisor->sector}}</p>
                @endif
            </div>
            <ul class="py-4 mt-2 text-gray-700 flex items-center justify-around">
                <li class="flex flex-col items-center justify-around">
                    MUJERES
                    <div>{{ $nivel->students->where('genero', 'M')->where('status', 1)->count() }}</div>
                </li>
                <li class="flex flex-col items-center justify-between">
                    TOTAL
                    <div>{{ $nivel->students->where('status', 1)->count() }}</div>
                </li>
                <li class="flex flex-col items-center justify-around">
                    HOMBRES
                    <div>{{ $nivel->students->where('genero', 'H')->where('status', 1)->count() }}</div>
                </li>
            </ul>
            <div class="p-4 border-t mx-8 mt-2">
                <a href="{{route('admin.level.action', ['nivel' => $nivel->slug, 'action' => "matricula-escolar", 'grade' => "1"])}}" class="w-1/2 block mx-auto rounded-full bg-gray-900 hover:shadow-lg font-semibold text-white px-6 py-2 text-center"><i class="fa-solid fa-right-to-bracket"></i> Entrar</a>
            </div>
        </div>
@endforeach
</div>

</x-admin-layout>

