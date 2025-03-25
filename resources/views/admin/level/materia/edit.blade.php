<x-admin-layout :breadcrumb="[
    [
        'name' => 'Dashboard',
        'url' => '#',

    ],

    [
        'name' => 'Editar',
        'url' => '#',
    ],

]">



<livewire:action.materia.editar-materia :materia="$materia"  />


</x-admin-layout>

