<x-admin-layout :breadcrumb="[
    [
        'name' => 'Dashboard',
        'url' => '#',

    ],
    [
        'name' => 'Supervisores',
        'url' => 'admin.supervisores.index',
    ],
    [
        'name' => 'Editar',
        'url' => '#',
    ],

]">



<livewire:supervisor.editar-supervisor :supervisor="$supervisor" />


</x-admin-layout>

