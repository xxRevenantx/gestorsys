<x-admin-layout :breadcrumb="[
    [
        'name' => 'Dashboard',
        'url' => '#',

    ],
    [
        'name' => 'Niveles',
        'url' => 'admin.levels.index',
    ],
    [
        'name' => 'Editar',
        'url' => '#',
    ],

]">



<livewire:level.editar-nivel :level="$level" />


</x-admin-layout>

