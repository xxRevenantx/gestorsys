@php
    $links = [

        [
            'name' => 'Dashboard',
            'icon' => 'fa-solid fa-house',
            'route' =>  route('admin.dashboard'),
            'active' => request()->routeIs('admin.dashboard')
        ],

        [
            'name' => 'Perfil',
            'icon' => 'fa-solid fa-user',
            'route' =>  route('profile.show'),
            'active' => request()->routeIs('profile.show')
        ],


        [
            'header' => 'Autoridades',
            'color' => '#7267EF'
        ],

        [
            'name' => 'Autoridades',
            'icon' => 'fa-regular fa-user',
           'active' => request()->routeIs(
                'admin.supervisores.index',
                'admin.supervisores.create',
                'admin.supervisores.edit',
                'admin.directores.index',
                'admin.directores.create',
                'admin.directores.edit'
            ),
            'submenu' => [
                [
                    'name' => 'Supervisores',
                    'icon' => 'fa-regular fa-circle',
                    'route' => route('admin.supervisores.index'),
                     'active' => request()->routeIs(
                        'admin.supervisores.index',
                        'admin.supervisores.create',
                        'admin.supervisores.edit'
                    ),
                ],
                [
                    'name' => 'Directores',
                    'icon' => 'fa-regular fa-circle',
                    'route' => route('admin.directores.index'),
                    'active' => request()->routeIs('admin.directores.index'),
                ],
             ]
        ],

        [
            'header' => 'ESTRUCTURA ACADÉMICA',
            'color' => '#7267EF'
        ],

        [
            'name' => 'Administrar niveles',
            'icon' => 'fas fa-layer-group',
            'route' =>  route('admin.levels.index'),
            'active' =>  request()->routeIs('admin.levels.index'),
        ],
        [
            'name' => 'Grupos',
            'icon' => 'fas fa-layer-group',
            'route' =>  route('admin.groups.index'),
            'active' =>  request()->routeIs('admin.groups.index'),
        ],
        [
            'name' => 'Generaciones',
            'icon' => 'fas fa-layer-group',
            'route' =>  route('admin.generations.index'),
            'active' =>  request()->routeIs('admin.generations.index'),
        ],

    ];


    $colorOscuro = "#161c25"
@endphp

<aside id="logo-sidebar" style="background-color: #1c232f" class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full   sm:translate-x-0 " aria-label="Sidebar">
    <div class="h-full  pb-4 overflow-y-auto " style="background-color: #1c232f;">
       <ul class="font-medium">

        @foreach ( $links as $link )
        <li>
            @isset ($link["header"])
            <div class="px-3 py-2 text-xs uppercase" style="color: {{ $link["color"] }}">{{ $link["header"] }}</div>
            @else

            @isset($link["submenu"])
                    <button type="button" class="flex items-center w-full p-2 pr-6 text-base text-white  group hover:bg-[{{ $colorOscuro }}] " aria-controls="dropdown-example" data-collapse-toggle="dropdown-example">
                        <i class=" {{  $link["icon"] }} " style="color:#778290"></i>
                        <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">{{$link["name"]}}</span>
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                        </svg>
                </button>
                <ul id="dropdown-example" class="py-2 space-y-1 transition-all  duration-300 ease-in-out {{ $link['submenu'] && collect($link['submenu'])->contains('active', true) }}">
                    @foreach ($link["submenu"] as $sublink)
                    <li class="{{ $link['submenu'] && collect($link['submenu'])->contains('active', true)}}">
                        <a href="{{$sublink["route"]}}" class="flex items-center w-full p-2 pl-11 group hover:bg-[{{ $colorOscuro }}] text-white
                        {{ $sublink["active"] ? 'bg-[#161c25]' : '' }} hover:bg-[#161c25] ">
                        <i class=" {{  $sublink["icon"] }} mr-2" style="color:#778290"></i>
                        {{$sublink["name"]}}
                        </a>
                    </li>
                    @endforeach
                </ul>

            @else
            <a href="{{ $link["route"] }}" class="flex items-center p-2 text-white dark:text-white hover:bg-[{{ $colorOscuro }}] dark:hover:bg-[{{ $colorOscuro }}] group
            {{ $link["active"] ? 'bg-[#161c25]' : '' }} hover:bg-[#161c25] ">
               <i class=" {{  $link["icon"] }} " style="color:#778290"></i>
               <span class="ms-3">{{ $link["name"] }}</span>
            </a>

            @endisset


            @endisset
         </li>

        @endforeach



       </ul>
    </div>
 </aside>


