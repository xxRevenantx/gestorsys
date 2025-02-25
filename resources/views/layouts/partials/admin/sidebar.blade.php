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
                    'active' => request()->routeIs(
                        'admin.directores.index',
                        'admin.directores.create',
                        'admin.directores.edit'
                    ),
                ],
            ]
        ],
        [
            'header' => 'ESTRUCTURA ACADÉMICA',
            'color' => '#7267EF'
        ],
        [
            'name' => 'Estructura Académica',
            'icon' => 'fa fa-layer-group',
            'active' => request()->routeIs(
                'admin.levels.index',
                'admin.levels.create',
                'admin.levels.edit',
                'admin.groups.index',
                'admin.groups.create',
                'admin.groups.edit',
                'admin.generations.index',
                'admin.generations.create',
                'admin.generations.edit',
                'admin.grades.index',
                'admin.grades.create',
                'admin.grades.edit'
            ),
            'submenu' => [
                [
                    'name' => 'Administrar niveles',
                    'icon' => 'fas fa-layer-group',
                    'route' =>  route('admin.levels.index'),
                    'active' =>  request()->routeIs(
                        'admin.levels.index',
                        'admin.levels.create',
                        'admin.levels.edit'
                    ),
                ],
                [
                    'name' => 'Grupos',
                    'icon' => 'fas fa-layer-group',
                    'route' =>  route('admin.groups.index'),
                    'active' =>  request()->routeIs(
                        'admin.groups.index',
                        'admin.groups.create',
                        'admin.groups.edit'
                    ),
                ],
                [
                    'name' => 'Generaciones',
                    'icon' => 'fas fa-layer-group',
                    'route' =>  route('admin.generations.index'),
                    'active' =>  request()->routeIs(
                        'admin.generations.index',
                        'admin.generations.create',
                        'admin.generations.edit'
                    ),
                ],
                [
                    'name' => 'Grados',
                    'icon' => 'fas fa-layer-group',
                    'route' =>  route('admin.grades.index'),
                    'active' =>  request()->routeIs(
                        'admin.grades.index',
                        'admin.grades.create',
                        'admin.grades.edit'
                    ),
                ],
            ]
        ],

        [
            'header' => 'GESTIÓN ESCOLAR',
            'color' => '#7267EF'
        ],

        [
            'name' => 'Gestión escolar',
            'icon' => 'fa-regular fa-user',
            'active' => request()->routeIs(
                    'admin.students.index',
                    'admin.students.create',
                    'admin.students.edit',
                    'admin.students.show',
                      'admin.tutors.index',
                      'admin.tutors.create',
                      'admin.tutors.edit',
                      'admin.tutors.show',
            ),
            'submenu' => [
                [
                    'name' => 'Inscripción',
                    'icon' => 'fa-regular fa-circle',
                    'route' => route('admin.students.index'),
                    'active' => request()->routeIs(
                        'admin.students.index',
                        'admin.students.create',
                        'admin.students.edit',
                        'admin.students.show',


                    ),
                ],
                [
                    'name' => 'Niveles',
                    'icon' => 'fa-regular fa-circle',
                    'route' => route('admin.level.index'),
                    'active' => request()->routeIs(
                        'admin.level.index',
                        'admin.level.action',



                    ),
                ],
                [
                    'name' => 'Tutores',
                    'icon' => 'fa-regular fa-circle',
                    'route' => route('admin.tutors.index'),
                    'active' => request()->routeIs(
                        'admin.tutors.index',
                        'admin.tutors.create',
                        'admin.tutors.edit',
                        'admin.tutors.show',
                    ),
                ],
            ]
        ],

    ];

    $colorOscuro = "#161c25";
@endphp

<aside id="logo-sidebar" style="background-color: #1c232f" class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full sm:translate-x-0" aria-label="Sidebar">
    <div class="h-full pb-4 overflow-y-auto" style="background-color: #1c232f;">
        <ul class="font-medium">
            @foreach ($links as $index => $link)
            <li>
                @isset($link['header'])
                <div class="px-3 py-2 text-xs uppercase" style="color: {{ $link['color'] }}">{{ $link['header'] }}</div>
                @else
                @isset($link['submenu'])
                    <button type="button" class="flex items-center w-full p-2 pr-6 text-base text-white group hover:bg-[#161c25]" aria-controls="dropdown-{{ $index }}" data-collapse-toggle="dropdown-{{ $index }}">
                    <i class="{{ $link['icon'] }}" style="color:#778290"></i>
                    <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">{{ $link['name'] }}</span>
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                    </svg>
                    </button>
                    <ul id="dropdown-{{ $index }}" class="py-2 space-y-1 transition-all duration-300 ease-in-out {{ collect($link['submenu'])->contains('active', true) ? 'block' : 'hidden' }}">
                    @foreach ($link['submenu'] as $sublink)
                        <li class="{{ $sublink['active'] ? 'bg-[#161c25]' : '' }}">
                        <a href="{{ $sublink['route'] }}" class="flex items-center w-full p-2 pl-11 group hover:bg-[#161c25] text-white">
                            <i class="{{ $sublink['icon'] }} mr-2" style="color:#778290"></i>
                            {{ $sublink['name'] }}
                        </a>
                        </li>
                    @endforeach
                    </ul>
                @else
                    <a href="{{ $link['route'] }}" class="flex items-center p-2 text-white dark:text-white hover:bg-[#161c25] dark:hover:bg-[#161c25] group {{ $link['active'] ? 'bg-[#161c25]' : '' }}">
                    <i class="{{ $link['icon'] }}" style="color:#778290"></i>
                    <span class="ms-3">{{ $link['name'] }}</span>
                    </a>
                @endisset
                @endisset
            </li>
            @endforeach
        </ul>
    </div>
</aside>
